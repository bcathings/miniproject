<?php
include("../../stuff/all.php");
include("../../headers/admin.php");
check_login();
check_role_else_redirect("admin");

if(!isset($_GET['id'])){
    redirect('/admin/customer/view.php');
}
if(empty($_GET['id'])){
    redirect('/admin/customer/view.php');
}
if(!is_numeric($_GET['id'])){
    redirect('/admin/customer/view.php');
}

$id = $_GET['id'];

$sql = "SELECT * FROM tbl_customer  INNER JOIN tbl_login ON tbl_customer.email=tbl_login.email WHERE customer_id = '{$id}'";
$customer = $db->query($sql)->fetch_assoc();

$errors = array();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    check_if_empty("lname");
    check_if_empty("fname");
    check_if_empty("house_name","House name cannot be emtpy");
    check_if_empty("phone");
    check_if_empty("city");
    check_if_empty("district");
    check_if_empty("pincode");

    
    if(count($errors) == 0) {
        $sql = "UPDATE tbl_customer SET 
                customer_fname='{$_POST['fname']}',
                customer_lname='{$_POST['lname']}',
                customer_city='{$_POST['city']}',
                customer_district='{$_POST['district']}',
                customer_pincode='{$_POST['pincode']}',
                customer_house_name='{$_POST['house_name']}',
                customer_phone='{$_POST['phone']}'
             WHERE customer_id = $id";
        $db->query($sql);
        redirect('/admin/customer/view.php');
    }
}

?>

<form method="post">
    <h1>Edit Customer</h1>
    
    First name :<br>
    <input type="text" name="fname" value="<?php echo $customer["customer_fname"]; ?>">
    <?php display_errors("fname"); ?>
    <br>

    Last name :<br>
    <input type="text" name="lname" value="<?php echo $customer["customer_fname"] ?>">
    <?php display_errors("lname"); ?>
    <br>

    phone :<br>
    <input type="text" name="phone" value="<?php echo $customer["customer_phone"] ?>">
    <?php display_errors("phone"); ?>
    <br>

    <br>

    house name:<br>
    <input type="text" name="house_name" value="<?php echo $customer["customer_house_name"] ?>">
    <?php display_errors("house_name"); ?>
    <br>

    city :<br>
    <input type="text" name="city" value="<?php echo $customer["customer_city"] ?>">
    <?php display_errors("city"); ?>
    <br>

    district:<br>
    <input type="text" name="district" value="<?php echo $customer["customer_district"] ?>">
    <?php display_errors("district"); ?>
    <br>

    district:<br>
    <input type="text" name="pincode" value="<?php echo $customer["customer_pincode"] ?>">
    <?php display_errors("pincode"); ?>
    <br>

    <input type="submit" value="Submit"> 
</form>


