<?php
function add_error($input_name,$error){
    global $errors;
    if(!isset($errors[$input_name])){
        $errors[$input_name] = array($error);
    } else {
        array_push($errors[$input_name],$error);
    }
}

function check_if_empty($input_name,$error=NULL){
    global $errors;
    if(empty(trim($_POST[$input_name]))){
        if(isset($error)){
            add_error($input_name,$error);
        } else {
            add_error($input_name,"{$input_name} is empty");
        }
    }
}
function max_length_check($input_name,$max_length,$error=NULL){
    global $errors;
    if(strlen($_POST[$input_name]) > $max_length){
        if(isset($error)){
            add_error($input_name,$error);
        } else {
            add_error($input_name, "{$input_name} excceds {$max_length} characters");
        }
    }
}

function min_length_check($input_name,$min_length,$error=NULL){
    global $errors;
    if(strlen($_POST[$input_name]) < $min_length){
        if(isset($error)){
            add_error($input_name,$error);
        } else {
            add_error($input_name,"{$input_name} needs to be least {$min_length} characters");
        }
    }
}

function is_email_check($input_name,$error=NULL){
    global $errors;
    if(!filter_var($_POST[$input_name], FILTER_VALIDATE_EMAIL)){
        if(isset($error)){
            add_error($input_name,$error);
        } else {
            add_error($input_name,"Please enter a valid email");
        }
    }
}

function display_errors($input_name){
    global $errors;
    if(isset($errors[$input_name])){
        foreach ($errors[$input_name] as $key => $value) {
            echo "<p style=\"color:red;margin:0\">{$value}</p>";
        }
    }
}

// set the Location header and kill execution so we can change to a diffrent page.
function redirect($url){
    header("Location: {$url}");
    die();
}

// check if there is a user in the $_SESSION
// so that we can know if someone is logged in or not
// if not redirect to login page
function check_login(){
    if(!isset($_SESSION['user'])) {
       redirect("/login.php");
    } 
}
// this does the same as above. 
// but it doesnt redirect.
// just returns a true or fale if the user is logged in or not.
function is_loggedin(){
    if(!isset($_SESSION['user'])) {
        return false;
    } else {
        return true;
    }
}
// checks if the given user type in parameters
// matches with the user type in the session.
// so that we can check if a user has the permissions to access something
// so... if we logged in as "admin"
// and this function is called with check_role("admin","staff"),
// it will return true
// but if we are "customer" the above function call returns a false. 
function check_role(string ...$roles){
    if(!in_array($_SESSION['user']['type'],$roles)){
        return false;
    } else {
        return true;
    }
}

// same as above but redirect if the user isnt among the given roles.
// the function redirects to login.php
function check_role_else_redirect(string ...$roles){
    if(!in_array($_SESSION['user']['type'],$roles)){
       redirect("/login.php");
    }
}

?>
