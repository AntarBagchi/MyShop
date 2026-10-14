<?php
session_start();
include("Includes/db.php");

// User Login Check
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

// Cart Check
if (!isset($_SESSION['cart']) || count($_SESSION['cart']) == 0) {
    die("Cart is Empty!");
}

$user_id = $_SESSION['user'];
$total = 0;

// Total Calculate
foreach ($_SESSION['cart'] as $pid => $qty) {

    $result = mysqli_query($conn, "SELECT * FROM products WHERE id='$pid'");
    $row = mysqli_fetch_assoc($result);

    $total += ($row['price'] * $qty);
}

// Save Order
mysqli_query($conn, "INSERT INTO orders(user_id,total_amount,status)
VALUES('$user_id','$total','Pending')");

// Last Order ID
$order_id = mysqli_insert_id($conn);

// Save Order Items
foreach ($_SESSION['cart'] as $pid => $qty) {

    $result = mysqli_query($conn, "SELECT * FROM products WHERE id='$pid'");
    $row = mysqli_fetch_assoc($result);

    $price = $row['price'];

    mysqli_query($conn, "INSERT INTO order_items(order_id,product_id,quantity,price)
    VALUES('$order_id','$pid','$qty','$price')");
}

// Empty Cart
unset($_SESSION['cart']);
?>

<!DOCTYPE html>
<html>

<head>

<title>Order Success</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="bg-light">

<div class="container mt-5">

<div class="card shadow">

<div class="card-body text-center">

<h2 class="text-success">✅ Order Placed Successfully!</h2>

<h4>Your Order ID : <?php echo $order_id; ?></h4>

<h5>Total Amount : ₹<?php echo $total; ?></h5>

<br>

<a href="index.php" class="btn btn-primary">
Continue Shopping
</a>

<a href="my_orders.php" class="btn btn-success">
My Orders
</a>

</div>

</div>

</div>

</body>

</html>