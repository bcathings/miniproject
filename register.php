<?php
//include the functions and the database stuff
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
    check_if_empty("confirm_password","Confirm Password cannot be empty");
    check_if_empty("lname");
    check_if_empty("fname");
    check_if_empty("house_name","House name cannot be emtpy");
    check_if_empty("phone");
    check_if_empty("city");
    check_if_empty("district");
    check_if_empty("pincode");

    // check if the form value $_POST['given_name'] has minium length of 8 characters. 
    // if it doesnt an error is added to $errors
    min_length_check("password",8);
    // check if the form value $_POST['given_name'] doessnt exceed a length of 50 characters
    // if it does an error is added to $errors
    max_length_check("email",50);
    // check if the given value is a valid email
    // else an error is added to $errors
    is_email_check("email");
    
    if(count($errors) == 0) {
        // to check if a user already exists, we check if that email exists in the database
        $sql = "SELECT * FROM tbl_login WHERE email = '{$_POST["email"]}'";
        $user = $db->query($sql)->fetch_assoc();
        // the sql query didnt return null? add an error to the email input
        if($user){
            add_error("email","User already exists.");
        } else if(($_POST['password'] != $_POST['confirm_password'])){
            // if the passwords dont match, add an error to password input
            add_error("confirm_password","Password's should match.");
            add_error("password","Password's should match.");
        }
        else {
            // insert the user into the database after all the validation.
            $sql = "INSERT INTO tbl_login
                (email,password,type,status) 
                VALUES (
                '{$_POST['email']}',
                '{$_POST['password']}',
                'customer'
                )
                ";
            $db->query($sql);
            $sql = "INSERT INTO tbl_customer
                (
                    email,
                    customer_fname,
                    customer_lname,
                    customer_city,
                    customer_district,
                    customer_pincode,
                    customer_house_name,
                    customer_phone
                ) VALUES (
                '{$_POST['email']}',
                '{$_POST['fname']}',
                '{$_POST['lname']}',
                '{$_POST['city']}',
                '{$_POST['district']}',
                '{$_POST['pincode']}',
                '{$_POST['house_name']}',
                '{$_POST['phone']}' )
                ";
            $db->query($sql);

            $sql = "SELECT * FROM tbl_login WHERE email = '{$_POST["email"]}'";
            $user = $db->query($sql)->fetch_assoc();

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
    <h1>Register</h1>
    email:<br>
    <input type="email" name="email"><br>
    <?php display_errors("email"); ?>

    password:<br>
    <input type="password" name="password">
    <?php display_errors("password"); ?>
    <br>

    confirm password:<br>
    <input type="password" name="confirm_password">
    <?php display_errors("confirm_password"); ?>
    <br>
    
    First name :<br>
    <input type="text" name="fname">
    <?php display_errors("fname"); ?>
    <br>

    Last name :<br>
    <input type="text" name="lname">
    <?php display_errors("lname"); ?>
    <br>

    phone :<br>
    <input type="text" name="phone">
    <?php display_errors("phone"); ?>
    <br>

    <br>

    house name:<br>
    <input type="text" name="house_name">
    <?php display_errors("house_name"); ?>
    <br>

    city :<br>
    <input type="text" name="city">
    <?php display_errors("city"); ?>
    <br>

    district:<br>
    <input type="text" name="district">
    <?php display_errors("district"); ?>
    <br>

    district:<br>
    <input type="text" name="pincode">
    <?php display_errors("pincode"); ?>
    <br>

    <input type="submit" value="Register"> 
</form>


