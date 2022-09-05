<?php
include("../../stuff/all.php");
include("../../headers/admin.php");
check_login();
check_role_else_redirect("admin");
if(!isset($_GET['id'])){
    redirect('/admin/users/');
}
if(empty($_GET['id'])){
    redirect('/admin/users/');
}

$id = $_GET['id'];

$sql = "SELECT * FROM tbl_login WHERE email = '{$id}'";
$user = $db->query($sql)->fetch_assoc();

if($user['status'] == 1){
    $sql = "UPDATE tbl_login SET status=0 WHERE email='{$id}'";
} else {
    $sql = "UPDATE tbl_login SET status=1 WHERE email='{$id}'";
}
$db->query($sql);
redirect($_SERVER['HTTP_REFERER']);

?>
