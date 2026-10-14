<?php
session_start();
include("Includes/db.php");

if(!isset($_SESSION['user_id']))
{
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

$result = mysqli_query($conn,"SELECT * FROM orders WHERE user_id='$user_id' ORDER BY id DESC");
?>

<!DOCTYPE html>

<html>

<head>

<title>My Orders</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

<div class="container mt-5">

<h2>My Orders</h2>

<table class="table table-bordered table-hover">

<tr class="table-dark">

<th>Order ID</th>
<th>Total</th>
<th>Status</th>
<th>Date</th>
<th>Action</th>

</tr>

<?php

if(mysqli_num_rows($result) > 0)
{
    while($row = mysqli_fetch_assoc($result))
    {

?>

<tr>

<td><?php echo $row['id']; ?></td>

<td>₹ <?php echo $row['total_amount']; ?></td>

<td>
    <span class="badge bg-warning text-dark">
        <?php echo $row['status']; ?>
    </span>
</td>

<td><?php echo $row['order_date']; ?></td>

<td>

```
<a href="order_details.php?order_id=<?php echo $row['id']; ?>"
   class="btn btn-primary btn-sm">

   View Invoice

</a>
```

</td>

</tr>

<?php

    }
}
else
{

?>

<tr>

<td colspan="5" class="text-center text-danger">

No Orders Found

</td>

</tr>

<?php

}

?>

</table>

<a href="index.php" class="btn btn-secondary">
    Back to Home
</a>

</div>

</body>

</html>
