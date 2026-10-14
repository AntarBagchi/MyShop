<?php
session_start();
include("Includes/db.php");

if(!isset($_SESSION['user_id']))
{
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

if(isset($_POST['change']))
{
    $current = $_POST['current_password'];
    $new = $_POST['new_password'];
    $confirm = $_POST['confirm_password'];

    $result = mysqli_query($conn,"SELECT * FROM users WHERE id='$user_id'");
    $row = mysqli_fetch_assoc($result);

    if(password_verify($current, $row['password']))
    {
        if($new == $confirm)
        {
            $new_hash = password_hash($new, PASSWORD_DEFAULT);

            mysqli_query($conn,"UPDATE users SET password='$new_hash' WHERE id='$user_id'");

            $success = "Password Changed Successfully!";
        }
        else
        {
            $error = "New Password and Confirm Password do not match!";
        }
    }
    else
    {
        $error = "Current Password is incorrect!";
    }
}
?>

<!DOCTYPE html>

<html>

<head>

<title>Change Password</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="bg-light">

<div class="container mt-5">

<div class="row justify-content-center">

<div class="col-md-5">

<div class="card shadow">

<div class="card-header bg-dark text-white">

<h3 class="text-center">Change Password</h3>

</div>

<div class="card-body">

<?php
if(isset($success)){
    echo "<div class='alert alert-success'>$success</div>";
}

if(isset($error)){
    echo "<div class='alert alert-danger'>$error</div>";
}
?>

<form method="POST">

<div class="mb-3">

<label>Current Password</label>

<input type="password" name="current_password" class="form-control" required>

</div>

<div class="mb-3">

<label>New Password</label>

<input type="password" name="new_password" class="form-control" required>

</div>

<div class="mb-3">

<label>Confirm Password</label>

<input type="password" name="confirm_password" class="form-control" required>

</div>

<button class="btn btn-primary w-100" name="change">

Change Password

</button>

</form>

<hr>

<div class="text-center">

<a href="profile.php" class="btn btn-secondary">
Back to Profile
</a>

</div>

</div>

</div>

</div>

</div>

</div>

</body>

</html>
