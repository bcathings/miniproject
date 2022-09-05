<?php
include("../../stuff/all.php");
include("../../headers/admin.php");

check_login();
check_role_else_redirect("admin");

$sql = "SELECT * FROM tbl_staff INNER JOIN tbl_login ON tbl_staff.email = tbl_login.email";
$staffs = $db->query($sql)->fetch_all(MYSQLI_ASSOC);

?>

<h1> View Staff </h1>
<a href="/admin/staff/add_staff.php">Add Staff --- (Click this to add a staff) ((this help text is for the brain dead among us)) (((AMONGUS)))????</a>
<br>
<br>
<br>

<?php
    if(!$staffs){
        echo "<p>No staff present. Please add one </p>";
        die();
    }
?>

<table border="1" cellpadding="5px">
    <tr>
        <th>id</th>
        <th>email</th>
        <th>fname</th>
        <th>lname</th>
        <th>district</th>
        <th>pincode</th>
        <th>city</th>
        <th>house_name</th>
        <th>phone</th>
        <th>date added</th>
        <th>Status</th>
        <th>Edit</th>
        <th>Change status</th>

<?php
    foreach ($staffs as $key => $staff) {
        echo "<tr>";
        echo "<td>{$staff['staff_id']}</td>";
        echo "<td>{$staff['email']}</td>";
        echo "<td>{$staff['staff_fname']}</td>";
        echo "<td>{$staff['staff_lname']}</td>";
        echo "<td>{$staff['staff_district']}</td>";
        echo "<td>{$staff['staff_pincode']}</td>";
        echo "<td>{$staff['staff_city']}</td>";
        echo "<td>{$staff['staff_house_name']}</td>";
        echo "<td>{$staff['staff_phone']}</td>";
        echo "<td>{$staff['date_added']}</td>";
        echo "<td>".($staff['status'] == 1 ? "active":"inactive")."</td>";
        echo "<td><a href=\"/admin/staff/edit_staff.php?id={$staff["staff_id"]}\">edit</a></td>";
        echo "<td><a href=\"/admin/users/delete_user.php?id={$staff["email"]}\">change status</a></td>";
        echo "</tr>";
    }
?>
</table>
