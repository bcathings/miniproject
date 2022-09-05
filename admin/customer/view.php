<?php
include("../../stuff/all.php");
include("../../headers/admin.php");

check_login();
check_role_else_redirect("admin");

$sql = "SELECT * FROM tbl_customer INNER JOIN tbl_login ON tbl_customer.email = tbl_login.email";
$customers = $db->query($sql)->fetch_all(MYSQLI_ASSOC);

?>

<h1> View Customer </h1>
<a href="/admin/customer/add_customer.php">Add Customer --- (Click this to add a customer) ((this help text is for the brain dead among us)) (((AMONGUS)))????</a>
<br>
<br>
<br>

<?php
    if(!$customers){
        echo "<p>No customer present. Please add one </p>";
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
    foreach ($customers as $key => $customer) {
        echo "<tr>";
        echo "<td>{$customer['customer_id']}</td>";
        echo "<td>{$customer['email']}</td>";
        echo "<td>{$customer['customer_fname']}</td>";
        echo "<td>{$customer['customer_lname']}</td>";
        echo "<td>{$customer['customer_district']}</td>";
        echo "<td>{$customer['customer_pincode']}</td>";
        echo "<td>{$customer['customer_city']}</td>";
        echo "<td>{$customer['customer_house_name']}</td>";
        echo "<td>{$customer['customer_phone']}</td>";
        echo "<td>{$customer['date_added']}</td>";
        echo "<td>".($customer['status'] == 1 ? "active":"inactive")."</td>";
        echo "<td><a href=\"/admin/customer/edit_customer.php?id={$customer["customer_id"]}\">edit</a></td>";
        echo "<td><a href=\"/admin/users/delete_user.php?id={$customer["email"]}\">change status</a></td>";
        echo "</tr>";
    }
?>
</table>
