<?php
include("../../stuff/all.php");
include("../../headers/admin.php");
check_login();
check_role_else_redirect("admin");

$errors = array();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
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

    min_length_check("password",8);
    max_length_check("email",50);
    is_email_check("email");
    
    if(count($errors) == 0) {
        $sql = "SELECT * FROM tbl_login WHERE email = '{$_POST["email"]}'";
        $user = $db->query($sql)->fetch_assoc();
        if($user){
            add_error("email","User already exists.");
        } else 
        if(($_POST['password'] != $_POST['confirm_password'])){
            add_error("confirm_password","Password's should match.");
            add_error("password","Password's should match.");
        }
        else {
            $sql = "INSERT INTO tbl_login
                (email,password,type,status) 
                VALUES (
                '{$_POST['email']}',
                '{$_POST['password']}',
                'staff'
                )
                ";
            $db->query($sql);
            $sql = "INSERT INTO tbl_staff
                (
                    email,
                    staff_fname,
                    staff_lname,
                    staff_city,
                    staff_district,
                    staff_pincode,
                    staff_house_name,
                    staff_phone
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

            redirect('/admin/staff/view.php');

        }
        var_dump($user);
    }
}

?>

<form method="post">
    <h1>Add Staff</h1>
    <h2>add em slaves fr</h2>
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

    <input type="submit" value="Add"> 
</form>


