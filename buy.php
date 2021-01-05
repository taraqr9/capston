<?php include "init.php"; ?>
<?php
if (!isset($_SESSION['id'])) {
    header('location:index.php');
}
if (isset($_POST['profile'])) {
    header('location:prfile.php');
}
?>


<?php


if (!empty($_GET['clicked'])) {
    if ($source->Query("SELECT * FROM products WHERE id=?", [$_GET['clicked']])) {
        $row = $source->SingleRow();
        $pname = $row->name;
        $category = $row->category;
        $sub_category = $row->sub_category;
        $oprice = $row->price;
        $description = $row->description;

        //special offer 10%
        $price = $row->price * .10;
        $offerprice = $row->price - $price;
    }
}
// checking user details
if (isset($_POST['proceed'])) {
    $status = "Pending";
    $data = [
        'name' => $_POST['name'],
        'email' => $_POST['email'],
        'phone' => $_POST['phone'],
        'address' => $_POST['address'],
        'qty' => $_POST['qty']
    ];

    if (!empty($_GET['qty'])) {
        $pqty = $_GET['qty'];
        if ($pqty >= $data['qty']) {
            $uqty = $pqty - $data['qty'];
        } else {
            $qty_error = "<div class='text-danger'>We dont have sufficiant quantity that you want</div>";
        }
    }


    $price1 = intval($offerprice) * $data['qty'];
    if (empty($qty_error)) {
        if (!empty($data['name']) && !empty($data['email']) && !empty($data['phone']) && !empty($data['address']) && $data['qty'] !== '0') {
            if (empty($_SESSION['size'])) {
                if ($source->Query("INSERT INTO `order` (`pid`,`uid`, `pname`, `qty`, `category`, `sub_category`, `price`, `name`, `email`, `phone`, `address`, `status`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)", [$_GET['clicked'], $_SESSION['id'], $pname, $data['qty'], $category, $sub_category, $price1, $data['name'], $data['email'], $data['phone'], $data['address'], $status])) {

                    $source->Query("UPDATE `products` set qty = ? where id = ?", [$uqty, $_GET['clicked']]);

                    $_SESSION['shoping'] = "<div class='text-success'>Thank you for your shopping</div>";
                } else {
                    $_SESSION['shoping'] = "<div class='text-danger'>Something Went Wrong</div>";
                }
            } else {
                if ($source->Query("INSERT INTO `order` (`pid`,`uid`, `pname`, `qty`, `size`, `category`, `sub_category`, `price`, `name`, `email`, `phone`, `address`, `status`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)", [$_GET['clicked'], $_SESSION['id'], $pname, $data['qty'], $_SESSION['size'], $category, $sub_category, $price1, $data['name'], $data['email'], $data['phone'], $data['address'], $status])) {

                    $source->Query("UPDATE `products` set qty = ? where id = ?", [$uqty, $_GET['clicked']]);

                    $_SESSION['shoping'] = "<div class='text-success'>Thank you for your shopping</div>";
                } else {
                    $_SESSION['shoping'] = "<div class='text-danger'>Something Went Wrong</div>";
                }
            }
        }
    }
}
?>
<html>

<head>
    <meta name="viewpost" content="width=device-width, initial-scale=1.0">
    <link href="assets/css/home.css?v=<?php echo time(); ?>" rel="stylesheet" type="text/css">
    <link href="assets/css/buy.css?v=<?php echo time(); ?>" rel="stylesheet" type="text/css">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script>
</head>

<body>
    <!-- Top Bar -->
    <nav class=" navbar navbar-expand-md navbar-light sticky-top">
        <div class="container">
            <h1 class="display-4 text-light"><a href="home.php" style="text-decoration: none; color: white;">DailyBazar</a></h1>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item mr-3 active">
                        <a href="#" class="nav-link text-light">Home</a>
                    </li>
                    <li class="nav-item mr-3">
                        <a href="#" class="nav-link text-light">Man</a>
                    </li>
                    <li class="nav-item mr-3">
                        <a href="#" class="nav-link text-light">Women</a>
                    </li>
                    <li class="nav-item mr-3">
                        <a href="#" class="nav-link text-light">Food</a>
                    </li>
                    <li class="nav-item mr-3">
                        <a href="order.php" class="nav-link text-light">Order</a>
                    </li>
                    <li class="nav-item mr-3">
                        <button class="btn nav-link bg-primary mt-2 text-light" data-toggle="collapse" data-target="#demo"><?php
                                                                                                                            echo $_SESSION['login_success'];
                                                                                                                            ?></button>
                        <div id="demo" class="collapse mt-1">
                            <a href="profile.php" class="h5 text-light link-unstyled">Profile</a>

                            <a href="logout.php" class="h5 text-light text-decoration-none">Logout</a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Notification Bar -->
        <?php
        if (!empty($_SESSION['shoping'])) {
            echo $_SESSION['shoping'];
            $_SESSION['shoping'] = "";
        }
        if (!empty($qty_error)) {
            echo $qty_error;
            $qty_error = "";
        }
        ?>

    <?php
    //  product detials
    if (!empty($product->sub_category)) {
        echo $product->category;
    }
    ?>
    <!-- show product -->
    <form action="" method="POST">


        <div class="container-fluid">
            <div class="container-fluid bg-light m-auto row mb-4">
                <div class="col-md-5 col-lg-2 col-xl-2">
                    <div class="mb-3 mb-md-0">

                        <img class="rounded w-50 m-1" src="assets/productsimg/<?php echo $_GET['clicked']; ?>.jpg" alt="Sample">
                    </div>
                </div>


                <div class="col-md-4 col-lg-2 col-xl-2">
                    <div>
                        <div class="d-flex justify-content-between">
                            <div>
                                <h5 class="mb-4 text-secondary">Name : <?php echo $pname; ?></h5>

                                <?php
                                if ($sub_category == '2' || $sub_category == '5' || $sub_category == '9') {
                                    if (!empty($_SESSION['size'])) {
                                        echo "<p class='mb-3 text-muted text-uppercase small'> Size : ";
                                        echo $_SESSION['size'];
                                    }
                                }
                                ?>
                                </p>
                                <p class="mb-3 text-muted text-uppercase small"> QTY : <input type="number" name='qty' value="1"></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8 col-xl-4 bg-light">
                    <table class="table m-4">
                        <tr>
                            <th>Original Price</th>
                            <th>Special Price</th>
                            <th>Disscount</th>
                            <th>Save</th>
                        </tr>
                        <tr>
                            <th class='text-secondary'><del>TK. <?php echo $oprice; ?></del></th>
                            <th>TK. <?php echo intval($offerprice); ?></th>
                            <th>TK. 10%</th>
                            <th>TK. <?php echo intval($price); ?></th>
                        </tr>
                    </table>

                </div>
            </div>
        </div>
        <!-- User Address -->

        <div class="col-6 container-fluid mt-5 ">
            <div class="entertaiment">
                <input type="text" name="name" class="form-control col-5" placeholder="Name" required>
                <input type="email" name="email" class="form-control col-5 mt-2" placeholder="Email" required>
                <input type="phone" name="phone" class="form-control col-5 mt-2" placeholder="Phone Number" required>
                <input type="text" name="address" class="form-control col-5 mt-2" placeholder="Address" required>
                <div class="row container m-center mt-5">
                    <p><input type="checkbox" checked> Cash On Delivery</p>
                </div>
                <hr class="bg-success">
            </div>
        </div>

        <div class="container mt-5 text-left">
            <a href="#" style="text-decoration:none; color: black; margin-left:90px;">
                <input type="submit" name="proceed" value="Proceed To Buy" class="btn btn-outline-success col-3">
            </a>
        </div>

    </form>

    </div>





</body>

</html>