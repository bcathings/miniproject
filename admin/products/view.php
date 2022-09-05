<?php
include("../../stuff/all.php");
include("../../headers/admin.php");
check_login();
check_role_else_redirect("admin","staff");


?>

<h1> View Products </h1>
