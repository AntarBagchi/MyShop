<?php
session_start();
include("Includes/db.php");

if (isset($_POST['login'])) {

    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {

        $row = mysqli_fetch_assoc($result);

        if (password_verify($password, $row['password'])) {

            // User Session
            $_SESSION['user'] = $row['id'];
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['fullname'] = $row['fullname'];

            header("Location: index.php");
            exit();

        } else {

            $error = "Invalid Password!";

        }

    } else {

        $error = "Email Not Found!";

    }

}
?>

<!DOCTYPE html>
<html>

<head>

<title>User Login</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="bg-light">

<div class="container mt-5">

<div class="row justify-content-center">

<div class="col-md-5">

<div class="card shadow">

<div class="card-header bg-dark text-white">

<h3 class="text-center">User Login</h3>

</div>

<div class="card-body">

<?php
if(isset($error)){
?>

<div class="alert alert-danger">
<?php echo $error; ?>
</div>

<?php
}
?>

<form method="POST">

<div class="mb-3">

<label>Email</label>

<input
type="email"
name="email"
class="form-control"
required>

</div>

<div class="mb-3">

<label>Password</label>

<input
type="password"
name="password"
class="form-control"
required>

</div>

<button
type="submit"
name="login"
class="btn btn-primary w-100">

Login

</button>

</form>

<hr>

<p class="text-center">

Don't have an account?

<a href="register.php">

Register Here

</a>

</p>

</div>

</div>

</div>

</div>

</div>

</body>

</html>