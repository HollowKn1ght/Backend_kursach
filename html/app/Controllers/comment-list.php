<?php
require_once '../Models/DataSource.php';
extract($_POST);
$database = new DataSource();
$sql = "SELECT * FROM comments WHERE upload_id='" . $upload_id . "' ORDER BY comment_id asc";
$result = $database->select($sql);
echo json_encode($result);