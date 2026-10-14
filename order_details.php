<?php
session_start();
include("Includes/db.php");

if(!isset($_SESSION['user_id']))
{
    header("Location: login.php");
    exit();
}

if(!isset($_GET['order_id']))
{
    die("Invalid Order");
}

$order_id = $_GET['order_id'];
$user_id = $_SESSION['user_id'];

// Order Check
$order_result = mysqli_query($conn,
"SELECT * FROM orders WHERE id='$order_id' AND user_id='$user_id'");

$order = mysqli_fetch_assoc($order_result);

if(!$order)
{
    die("Order not found!");
}

// Order Items
$items_result = mysqli_query($conn,
"SELECT oi.*, p.product_name, p.image
FROM order_items oi
JOIN products p ON oi.product_id = p.id
WHERE oi.order_id='$order_id'");

$total = 0;
?>

<!DOCTYPE html>

<html>

<head>

<title>Invoice</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="bg-light">

<div class="container mt-5">

<div class="card shadow">

<div class="card-header bg-dark text-white">

<div class="d-flex justify-content-between">

<h3>Invoice</h3>

<button onclick="window.print()" class="btn btn-warning btn-sm">

🖨 Print

</button>

</div>

</div>

<div class="card-body">

<h5>Order ID: #<?php echo $order['id']; ?></h5>

<p><b>Date:</b> <?php echo $order['order_date']; ?></p>

<p><b>Status:</b> <?php echo $order['status']; ?></p>

<hr>

<table class="table table-bordered">

<tr class="table-secondary">

<th>Image</th>
<th>Product</th>
<th>Price</th>
<th>Qty</th>
<th>Subtotal</th>

</tr>

<?php

while($item = mysqli_fetch_assoc($items_result))
{
    $subtotal = $item['price'] * $item['quantity'];
    $total += $subtotal;
?>

<tr>

<td>
<img src="images/<?php echo $item['image']; ?>" width="80">
</td>

<td><?php echo $item['product_name']; ?></td>

<td>₹ <?php echo $item['price']; ?></td>

<td><?php echo $item['quantity']; ?></td>

<td>₹ <?php echo $subtotal; ?></td>

</tr>

<?php } ?>

<tr class="table-success">

<td colspan="4" class="text-end">

<b>Total</b>

</td>

<td>

<b>₹ <?php echo $total; ?></b>

</td>

</tr>

</table>

<div class="text-center mt-4">

<a href="my_orders.php" class="btn btn-primary">

Back to My Orders

</a>

</div>

</div>

</div>

</div>

</body>

</html>
