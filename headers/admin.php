<ul>
<?php
    if(check_role("admin")){
        echo '<li><a href="/admin/staff/view.php">Staff</a></li>';
    }
    if(check_role("admin","staff")){
        echo '<li><a href="/admin/customer/view.php">Customer</a></li>';
    }
    if(check_role("admin","staff")){
        echo '<li><a href="/admin/products/view.php">products</a></li>';
    }
    if(check_role("admin","staff")){
        echo '<li><a href="/admin/vendors/view.php">Vendors</a></li>';
    }
    echo '<li><a href="/logout.php">Logout</a></li>';
?>
</ul>
