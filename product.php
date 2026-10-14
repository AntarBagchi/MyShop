<?php
include("Includes/db.php");

$id = $_GET['id'];

$result = mysqli_query($conn,"SELECT * FROM products WHERE id='$id'");
$row = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Product Details</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

<div class="container mt-5">

<div class="row">

<div class="col-md-6">

<img src="images/<?php echo $row['image']; ?>" class="img-fluid">

</div>

<div class="col-md-6">

<h2><?php echo $row['product_name']; ?></h2>

<h3 class="text-success">
₹ <?php echo $row['price']; ?>
</h3>

<p>
<?php echo $row['description']; ?>
</p>

<form action="cart.php" method="GET">

<input type="hidden" name="id" value="<?php echo $row['id']; ?>">

<button class="btn btn-success">
Add To Cart
</button>

</form>

</div>

</div>

</div>

</body>
</html>