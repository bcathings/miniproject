<?php
include("../../stuff/all.php");
include("../../headers/admin.php");
check_login();
check_role_else_redirect("admin");

if(!isset($_GET['id'])){
    redirect('/admin/staff/view.php');
}
if(empty($_GET['id'])){
    redirect('/admin/staff/view.php');
}
if(!is_numeric($_GET['id'])){
    redirect('/admin/staff/view.php');
}

$id = $_GET['id'];

$sql = "SELECT * FROM tbl_staff  INNER JOIN tbl_login ON tbl_staff.email=tbl_login.email WHERE staff_id = '{$id}'";
$staff = $db->query($sql)->fetch_assoc();

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
        $sql = "UPDATE tbl_staff SET 
                staff_fname='{$_POST['fname']}',
                staff_lname='{$_POST['lname']}',
                staff_city='{$_POST['city']}',
                staff_district='{$_POST['district']}',
                staff_pincode='{$_POST['pincode']}',
                staff_house_name='{$_POST['house_name']}',
                staff_phone='{$_POST['phone']}'
             WHERE staff_id = $id";
        $db->query($sql);
        redirect('/admin/staff/view.php');
    }
}

?>

<form method="post">
    <h1>Edit Staff</h1>
    
    First name :<br>
    <input type="text" name="fname" value="<?php echo $staff["staff_fname"]; ?>">
    <?php display_errors("fname"); ?>
    <br>

    Last name :<br>
    <input type="text" name="lname" value="<?php echo $staff["staff_fname"] ?>">
    <?php display_errors("lname"); ?>
    <br>

    phone :<br>
    <input type="text" name="phone" value="<?php echo $staff["staff_phone"] ?>">
    <?php display_errors("phone"); ?>
    <br>

    <br>

    house name:<br>
    <input type="text" name="house_name" value="<?php echo $staff["staff_house_name"] ?>">
    <?php display_errors("house_name"); ?>
    <br>

    city :<br>
    <input type="text" name="city" value="<?php echo $staff["staff_city"] ?>">
    <?php display_errors("city"); ?>
    <br>

    district:<br>
    <input type="text" name="district" value="<?php echo $staff["staff_district"] ?>">
    <?php display_errors("district"); ?>
    <br>

    district:<br>
    <input type="text" name="pincode" value="<?php echo $staff["staff_pincode"] ?>">
    <?php display_errors("pincode"); ?>
    <br>

    <input type="submit" value="Submit"> 
</form>


