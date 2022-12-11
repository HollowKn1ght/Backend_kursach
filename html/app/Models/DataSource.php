<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/vendor/autoload.php";
use App\Models\DataBase;

class DataSource
{
    private $db;

	public function __construct() {

    $this->db = DataBase::connToDB();
	}
	function __destruct() {
	    $this->db->close();
	}

    public function select($query, $paramType = "", $paramArray = array())
    {
        $stmt = $this->db->prepare($query);

        if (! empty($paramType) && ! empty($paramArray)) {
            $this->bindQueryParams($stmt, $paramType, $paramArray);
        }
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $resultset[] = $row;
            }
        }

        if (! empty($resultset)) {
            return $resultset;
        }
    }

    public function insert($query, $paramType, $paramArray)
    {
        $stmt = $this->db->prepare($query);
        $this->bindQueryParams($stmt, $paramType, $paramArray);

        $stmt->execute();
        $insertId = $stmt->insert_id;
        return $insertId;
    }

    public function execute($query, $paramType = "", $paramArray = array())
    {
        $stmt = $this->db->prepare($query);

        if (! empty($paramType) && ! empty($paramArray)) {
            $this->bindQueryParams($stmt, $paramType, $paramArray);
        }
        $stmt->execute();
    }


    public function bindQueryParams($stmt, $paramType, $paramArray = array())
    {
        $paramValueReference[] = & $paramType;
        for ($i = 0; $i < count($paramArray); $i ++) {
            $paramValueReference[] = & $paramArray[$i];
        }
        call_user_func_array(array(
            $stmt,
            'bind_param'
        ), $paramValueReference);
    }
}