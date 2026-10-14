<?php
session_start();
include("Includes/db.php");

// Add Product to Cart
if (isset($_GET['id'])) {

    $id = $_GET['id'];

    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    if (isset($_SESSION['cart'][$id])) {
        $_SESSION['cart'][$id]++;
    } else {
        $_SESSION['cart'][$id] = 1;
    }
}

// Increase Quantity
if (isset($_GET['increase'])) {
    $id = $_GET['increase'];
    $_SESSION['cart'][$id]++;
}

// Decrease Quantity
if (isset($_GET['decrease'])) {
    $id = $_GET['decrease'];

    if ($_SESSION['cart'][$id] > 1) {
        $_SESSION['cart'][$id]--;
    } else {
        unset($_SESSION['cart'][$id]);
    }
}

$total = 0;
?>

<!DOCTYPE html>
<html>
<head>
    <title>Shopping Cart</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

<div class="container mt-5">

<h2 class="mb-4">Shopping Cart</h2>

<table class="table table-bordered table-hover">

<tr class="table-dark">
    <th>Image</th>
    <th>Product</th>
    <th>Price</th>
    <th>Qty</th>
    <th>Subtotal</th>
    <th>Action</th>
</tr>

<?php

if(isset($_SESSION['cart']) && count($_SESSION['cart'])>0){

foreach($_SESSION['cart'] as $pid => $qty){

$result = mysqli_query($conn,"SELECT * FROM products WHERE id='$pid'");
$row = mysqli_fetch_assoc($result);

$subtotal = $row['price'] * $qty;
$total += $subtotal;

?>

<tr>

<td>
<img src="images/<?php echo $row['image']; ?>" width="80">
</td>

<td>
<?php echo $row['product_name']; ?>
</td>

<td>
₹ <?php echo $row['price']; ?>
</td>

<td>

<a href="cart.php?decrease=<?php echo $pid; ?>" class="btn btn-danger btn-sm">-</a>

<b class="mx-2"><?php echo $qty; ?></b>

<a href="cart.php?increase=<?php echo $pid; ?>" class="btn btn-success btn-sm">+</a>

</td>

<td>
₹ <?php echo $subtotal; ?>
</td>

<td>

<a href="remove_cart.php?id=<?php echo $pid; ?>" class="btn btn-warning btn-sm">

Remove

</a>

</td>

</tr>

<?php

}

?>

<tr class="table-success">

<td colspan="4"><b>Total</b></td>

<td colspan="2"><b>₹ <?php echo $total; ?></b></td>

</tr>

<?php

}else{

?>

<tr>

<td colspan="6" class="text-center">

Cart is Empty

</td>

</tr>

<?php } ?>

</table>

<a href="index.php" class="btn btn-primary">
Continue Shopping
</a>

<a href="checkout.php" class="btn btn-success">
Checkout
</a>

</div>

</body>
</html>