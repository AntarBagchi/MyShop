<?php
session_start();
include("Includes/db.php");

if(!isset($_SESSION['user_id']))
{
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

$result = mysqli_query($conn,"SELECT * FROM users WHERE id='$user_id'");

$row = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>

<html>

<head>

<title>My Profile</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="bg-light">

<div class="container mt-5">

<div class="row justify-content-center">

<div class="col-md-6">

<div class="card shadow">

<div class="card-header bg-dark text-white">

<h3 class="text-center">My Profile</h3>

</div>

<div class="card-body">

<table class="table table-bordered">

<tr>

<th>Full Name</th>

<td><?php echo $row['fullname']; ?></td>

</tr>

<tr>

<th>Email</th>

<td><?php echo $row['email']; ?></td>

</tr>

<tr>

<th>User ID</th>

<td><?php echo $row['id']; ?></td>

</tr>

</table>

<div class="text-center">

<a href="index.php" class="btn btn-primary">
Home
</a>

<a href="my_orders.php" class="btn btn-success">
My Orders
</a>
<a href="change_password.php" class="btn btn-warning">
    Change Password
</a>

<a href="logout.php" class="btn btn-danger">
Logout
</a>

</div>

</div>

</div>

</div>

</div>

</div>

</body>

</html>
