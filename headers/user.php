<ul>
<?php
    echo '<li><a href="/">Home</a></li>';
    if(!is_loggedin()){
        echo '<li><a href="/login.php">Login</a></li>';
        echo '<li><a href="/register.php">Register</a></li>';
    }
    if(is_loggedin()){
        echo '<li><a href="/customer/orders.php">Orders</a></li>';
        echo '<li><a href="/customer/cart.php">Cart</a></li>';
        echo '<li><a href="/logout.php">Logout</a></li>';
    }
?>
</ul>
