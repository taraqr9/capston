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
        $price = $row->price;
        $description = $row->descriptions;
    }
}
?>

<?php
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


    if (!empty($data['name']) && !empty($data['email']) && !empty($data['phone']) && !empty($data['address']) && $data['qty'] !== '0') {

        if (empty($_POST['size'])) {
            if ($source->Query("INSERT INTO `order` (`uid`, `pname`, `qty`, `category`, `sub_category`, `price`, `name`, `email`, `phone`, `address`, `status`) VALUES (?,?,?,?,?,?,?,?,?,?,?)", [$_SESSION['id'], $pname, $data['qty'], $category, $sub_category, $price, $data['name'], $data['email'], $data['phone'], $data['address'], $status])) {

                $_SESSION['shoping'] = "Thank you for your shopping";
            } else {
                $_SESSION['shoping'] = "Something Went Wrong";
            }
        } else {
            if ($source->Query("INSERT INTO `order` (`uid`, `pname`, `qty`, `size`, `category`, `sub_category`, `price`, `name`, `email`, `phone`, `address`, `status`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)", [$_SESSION['id'], $pname, $data['qty'],$_POST['size'], $category, $sub_category, $price, $data['name'], $data['email'], $data['phone'], $data['address'], $status])) {

                $_SESSION['shoping'] = "Thank you for your shopping";
            } else {
                $_SESSION['shoping'] = "Something Went Wrong";
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
                        <button class="btn nav-link bg-primary mt-2 text-light" data-toggle="collapse" data-target="#demo"><?php
                                                                                                                            echo $_SESSION['login_success'];
                                                                                                                            ?></button>
                        <div id="demo" class="collapse mt-1">
                            <a href="profile.php" class="h5 text-light link-unstyled">Profile</a>

                            <a href="#" class="h5 text-light link-unstyled">Order</a>

                            <a href="logout.php" class="h5 text-light text-decoration-none">Logout</a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- test part -->




    <div class="text-success">

        <?php
        if (!empty($_SESSION['shoping'])) {
            echo $_SESSION['shoping'];
            $_SESSION['shoping'] = "";
        }
        ?>
    </div>




    <?php
    //  product detials
    if (!empty($product->sub_category)) {
        echo $product->category;
    }
    ?>
    <!-- show product -->
    <form action="" method="POST">
        <div class="container-fluid mt-2">
            <div class="row bg-light">
                <div class="col-3">
                    <img src="assets/productsimg/<?php echo $_GET['clicked']; ?>.jpg" style="width: 40%;">
                </div>
                <div class="col-2 m-auto">
                    <b>Name</b> : <?php echo $pname; ?>
                </div>
                <div class="col-1 m-auto">
                    <b>Price</b> : <?php echo $price . " TK"; ?>
                </div>
                <hr>
                <div class="col-3 m-auto">
                    <b>Description</b> : <?php echo $description; ?>
                </div>

                <div class="col-3 m-auto">
                    <p> QTY : <input type="number" name="qty" required value="1"></p>
                    <p>
                        <?php
                        if ($sub_category == '2' || $sub_category == '5' || $sub_category == '9') {
                            echo "Size : <input type='text' placeholder='S , M , X , XL , XXL'  name='size' required>";
                        }

                        ?>
                    </p>

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