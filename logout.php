<?php
include("./stuff/all.php"); 
// remove the values in the session of the current user.
// this logout's the user since we use the session to check whether a user is logged in.
session_destroy();
redirect("/login.php");
?>
