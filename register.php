<?php
include("includes/db.php");

if(isset($_POST['register']))
{
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $phone = $_POST['phone'];
    $address = $_POST['address'];

    $sql = "INSERT INTO users(fullname,email,password,phone,address)
            VALUES('$fullname','$email','$password','$phone','$address')";

    if(mysqli_query($conn,$sql))
    {
        echo "<script>alert('Registration Successful');</script>";
    }
    else
    {
        echo "Error : ".mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

<div class="container mt-5">

<h2 class="text-center">User Registration</h2>

<form method="POST">

<div class="mb-3">
<label>Full Name</label>
<input type="text" name="fullname" class="form-control" required>
</div>

<div class="mb-3">
<label>Email</label>
<input type="email" name="email" class="form-control" required>
</div>

<div class="mb-3">
<label>Password</label>
<input type="password" name="password" class="form-control" required>
</div>

<div class="mb-3">
<label>Phone</label>
<input type="text" name="phone" class="form-control">
</div>

<div class="mb-3">
<label>Address</label>
<textarea name="address" class="form-control"></textarea>
</div>

<button type="submit" name="register" class="btn btn-success">
Register
</button>

</form>

</div>

</body>
</html>