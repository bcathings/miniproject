<?php
session_start();
// show all warnings and erros to fix errors more easily
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// write all output to buffer so that we can redirect() without issues.
// normally the HTTP headers are set before the php starts outputting content.
// so we cant redirect. ( causes some weird warnings ) ( we cant set the Location HTTP header)
// this will make sure to write the output to a diffrent buffer
// so that we can set the http headers at any time during execution.
// and the buffer is finally added to the HTTP response body 
// at the end of processing the request.
ob_start();

$servername = "localhost";

// username of the database 
$username = "root";
// password of the database
$password = "";
// name of the database
$db_name = "test";

// Create connection
// connect to a database
$db = new mysqli($servername, $username, $password,$db_name);

// Check database connection
// this will never probably execute since the mysqli() will kill execution
// if it doesnt connect
// or idk really
if ($db->connect_error) {
    echo("<h1>500 INTERNAL SERVER ERROR </h1> Database connection failed");
    die();
}

?>
