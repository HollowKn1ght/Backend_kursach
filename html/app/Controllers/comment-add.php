<?php
require_once '../Models/DataSource.php';
$database = new DataSource();
$sql = "INSERT INTO comments(upload_id, user_id, comment, comment_sender_name) VALUES (?,?,?,?)";
$paramType = 'iiss';
$paramValue = array(
    $_POST["upload_id"],
    $_POST["user_id"],
    $_POST["comment"],
    $_POST["comment_sender_name"]
);
$result = $database->insert($sql, $paramType, $paramValue);
echo $result;