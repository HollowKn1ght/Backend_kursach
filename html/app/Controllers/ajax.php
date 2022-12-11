<?php
ob_start();
$action = $_GET['action'];
include '../Models/admin_class.php';
$crud = new Action();
if ($action == 'login') {
	$login = $crud->login();
	if ($login)
		echo $login;
}
if ($action == 'logout') {
	$logout = $crud->logout();
	if ($logout)
		header('location: http://' . $_SERVER['HTTP_HOST']);
}
if ($action == 'save_user') {
	$save = $crud->save_user();
	if ($save)
		echo $save;
}
if ($action == 'delete_user'){
	$delete = $crud->delete_user();
	if ($delete)
		echo $delete;
}
if ($action == 'save_upload') {
	$save = $crud->save_upload();
	if ($save)
		echo $save;
}
if ($action == 'delete_upload') {
	$delete = $crud->delete_upload();
	if ($delete)
		echo $delete;
}
if ($action == 'save_like') {
	$save = $crud->save_like();
	if ($save)
		echo $save;
}
if ($action == 'delete_like') {
	$delete = $crud->delete_like();
	if ($delete)
		echo $delete;
}
ob_end_flush();
?>