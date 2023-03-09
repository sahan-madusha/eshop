<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-shop</title>

    <link rel="stylesheet" href="./bootstrap.css">
    <link rel="stylesheet" href="./style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
</head>
<body>
    <div class="col-12 mt-2">
        <div class="row mt-1 mb-1">
            <div class="offset-lg-1 col-12 col-lg-4 align-self-start">
            <?php
                session_start();
                if (isset($_SESSION["u"])) {
                    $data = $_SESSION["u"];
                ?>
                    <span class="text-lg-start"><b><a href="./home.php" class="text-dark text-decoration-none">Welcome</a> </b><?php echo $data["fname"]; ?></span> |
                    <a class="text-lg-start fw-bold signout" onclick="signout();">Sign Out</a> |
                <?php
                } else {
                    ?>
                    <a href="index.php" class="text-decoration-none fw-bold">Sign In or Register</a> | 
                    <?php
                }
                ?>
                <a style="text-decoration:none; color:black;" class="text-lg-start fw-bold">Help and Contact</a> |
            </div>

            <div class="offset-lg-4 col-12 col-lg-3 align-self-end">
                <div class="row">
                    <div class="col-1 col-lg-3">
                    <a style="text-decoration:none; color:black;" class="text-lg-start fw-bold">Sell</a>
                    </div>

                    <div class="col-2 col-lg-2 dropdown">
                      <button class="btn btn-light dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        My E-Shop
                      </button>
                      <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="./userProfile.php">My Profile</a></li>
                        <li><a class="dropdown-item" href="#">My Selling</a></li>
                        <li><a class="dropdown-item" href="./myProduct.php">My Product</a></li>
                        <li><a class="dropdown-item" href="./watchlist.php">Wishlist</a></li>
                        <li><a class="dropdown-item" href="./purchasingHistory.php">Purchase History</a></li>
                        <li><a class="dropdown-item" href="./message.php">Message</a></li>
                        <li><a class="dropdown-item" href="#" onclick="contactAdmin('<?php echo $_SESSION['u']['email']; ?>');">message with admin</a></li>
                      </ul>
                    </div>

                    <div class="col-1 col-lg-3 ms-5 ms-lg-5 mt-1 cart-icon" onclick="window.location='cart.php';"></div>

                </div>
            </div>
        </div>
    </div>

    <script src="./bootstrap.bundle.js "></script>
    <script src="./script.js"></script>
    <!-- JavaScript Bundle with Popper -->
</body>
</html>