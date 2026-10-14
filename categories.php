<?php
include("includes/db.php");

$result = mysqli_query($conn, "SELECT * FROM categories");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Categories</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

<div class="container mt-5">

<h2>Product Categories</h2>

<table class="table table-bordered">

<tr>
    <th>ID</th>
    <th>Category Name</th>
</tr>

<?php

while($row = mysqli_fetch_assoc($result))
{

?>

<tr>

<td><?php echo $row['id']; ?></td>

<td><?php echo $row['category_name']; ?></td>

</tr>

<?php

}

?>

</table>

</div>

</body>

</html>