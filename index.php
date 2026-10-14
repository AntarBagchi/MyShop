<?php
session_start();
include("Includes/db.php");
?>

<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

```
<title>MyShop</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
```

</head>

<body class="bg-light">

<!-- Navbar -->

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">

```
    <a class="navbar-brand fw-bold" href="index.php">
        🛒 MyShop
    </a>

    <div class="ms-auto d-flex align-items-center">

        <?php if(isset($_SESSION['user_id'])) { ?>

            <!-- User Dropdown -->
            <div class="dropdown me-2">

                <button class="btn btn-success dropdown-toggle"
                        data-bs-toggle="dropdown">

                    👤 <?php echo $_SESSION['fullname']; ?>

                </button>

                <ul class="dropdown-menu dropdown-menu-end">

                    <li>
                        <a class="dropdown-item" href="profile.php">
                            My Profile
                        </a>
                    </li>

                    <li>
                        <a class="dropdown-item" href="my_orders.php">
                            My Orders
                        </a>
                    </li>

                    <li>
                        <a class="dropdown-item" href="change_password.php">
                            Change Password
                        </a>
                    </li>

                    <li><hr class="dropdown-divider"></li>

                    <li>
                        <a class="dropdown-item text-danger" href="logout.php">
                            Logout
                        </a>
                    </li>

                </ul>

            </div>

        <?php } else { ?>

            <a href="login.php" class="btn btn-outline-light me-2">
                Login
            </a>

            <a href="register.php" class="btn btn-warning me-2">
                Register
            </a>

        <?php } ?>

        <a href="cart.php" class="btn btn-info me-2">
            Cart
        </a>

        <a href="my_orders.php" class="btn btn-secondary me-2">
            My Orders
        </a>

    </div>

</div>
```

</nav>

<!-- Slider -->

<div id="mainSlider" class="carousel slide" data-bs-ride="carousel">

```
<div class="carousel-inner">

    <div class="carousel-item active">
        <img src="images/banner1.jpg" class="d-block w-100" height="350" style="object-fit: cover;">
    </div>

    <div class="carousel-item">
        <img src="images/banner2.jpg" class="d-block w-100" height="350" style="object-fit: cover;">
    </div>

    <div class="carousel-item">
        <img src="images/banner3.jpg" class="d-block w-100" height="350" style="object-fit: cover;">
    </div>

</div>

<button class="carousel-control-prev" type="button"
        data-bs-target="#mainSlider" data-bs-slide="prev">

    <span class="carousel-control-prev-icon"></span>

</button>

<button class="carousel-control-next" type="button"
        data-bs-target="#mainSlider" data-bs-slide="next">

    <span class="carousel-control-next-icon"></span>

</button>
```

</div>

<!-- Products Section -->

<div class="container mt-5">

```
<h2 class="mb-4 text-center fw-bold">Featured Products</h2>

<!-- Search Box -->
<form method="GET" class="mb-4">

    <div class="input-group">

        <input type="text"
               name="search"
               class="form-control"
               placeholder="Search Product..."
               value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">

        <button class="btn btn-primary">
            Search
        </button>

    </div>

</form>

<div class="row">

    <?php

    if(isset($_GET['search']))
    {
        $search = mysqli_real_escape_string($conn, $_GET['search']);

        $result = mysqli_query($conn,
        "SELECT * FROM products
         WHERE product_name LIKE '%$search%'
         OR description LIKE '%$search%'");
    }
    else
    {
        $result = mysqli_query($conn,
        "SELECT * FROM products");
    }

    if(mysqli_num_rows($result) > 0)
    {
        while($row = mysqli_fetch_assoc($result))
        {
    ?>

    <div class="col-md-4 mb-4">

        <div class="card h-100 shadow border-0">

            <img src="images/<?php echo $row['image']; ?>"
                 class="card-img-top"
                 height="250"
                 style="object-fit: cover;">

            <div class="card-body text-center">

                <h5 class="card-title">
                    <?php echo $row['product_name']; ?>
                </h5>

                <p class="text-success fw-bold fs-5">
                    ₹ <?php echo $row['price']; ?>
                </p>

                <p class="text-muted">
                    <?php echo substr($row['description'],0,80); ?>...
                </p>

                <a href="product.php?id=<?php echo $row['id']; ?>"
                   class="btn btn-primary w-100">

                    View Details

                </a>

            </div>

        </div>

    </div>

    <?php

        }
    }
    else
    {

    ?>

    <div class="col-12">

        <div class="alert alert-warning text-center">

            No Product Found!

        </div>

    </div>

    <?php } ?>

</div>
```

</div>

<!-- Footer -->

<footer class="bg-dark text-white mt-5 py-4">

```
<div class="container">

    <div class="row">

        <div class="col-md-4">

            <h5>MyShop</h5>

            <p>Best place to buy laptops and electronics online.</p>

        </div>

        <div class="col-md-4">

            <h5>Quick Links</h5>

            <ul class="list-unstyled">

                <li><a href="index.php" class="text-white text-decoration-none">Home</a></li>

                <li><a href="cart.php" class="text-white text-decoration-none">Cart</a></li>

                <li><a href="my_orders.php" class="text-white text-decoration-none">My Orders</a></li>

            </ul>

        </div>

        <div class="col-md-4">

            <h5>Contact</h5>

            <p>📧 support@myshop.com</p>

            <p>📞 +91 9876543210</p>

        </div>

    </div>

    <hr>

    <p class="text-center mb-0">
        © 2026 MyShop. All Rights Reserved.
    </p>

</div>
```

</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
