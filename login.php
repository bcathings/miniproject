<?php
include("./stuff/all.php");
include("./headers/user.php");

// this array will contain all the errors that might occur in the form below 
// to show later the function display_errors() will display the errors 
$errors = array();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // check if the form value $_POST['given_name'] is emtpy
    // if its emtpy an error is added to $errors
    check_if_empty("email");
    check_if_empty("password");

    min_length_check("password",8);
    max_length_check("email",50);
    // check if the given value is a valid email
    // else an error is added to $errors
    is_email_check("email");
    
    if(count($errors) == 0) {
        // fetch the user from the database.
        $sql = "SELECT * FROM tbl_login WHERE email = '{$_POST["email"]}'";
        $user = $db->query($sql)->fetch_assoc();
        // is the fetched value a NULL? 
        // then the user does not exist.
        if(!$user){
            add_error("email","User does not exist");
        } else 
        if($_POST['password'] != $user['password']){
            // check if the password is wrong 
            // by comparing the user sumbitted password and the password
            // in the database
            add_error("password","Password is wrong");
        }
        else {
            // put the user into the session so that 
            // we know if the user is logged in or not in other pages
            $_SESSION['user'] = $user;

            // based on the type of the user redirect to a diffrent page
            if($user['type'] == "admin") {
                redirect('/admin/staff/view.php');
            }
            else if($user['type'] == "staff") {
                redirect('/admin/products/view.php');
            }
            else if($user['type'] == "courier") {
                redirect('/admin/delivery');
            } else {
                redirect('/customer/products');
            }
        }
    }
}

?>



<form method="post">
    <h1>Login</h1>
    email:<br>
    <input type="email" name="email"><br>
    <?php display_errors("email"); ?>

    password:<br>
    <input type="password" name="password">
    <?php display_errors("password"); ?>
    <br>
    <input type="submit"> 
</form>

