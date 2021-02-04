<?php include "init.php"; ?>
<?php
if (!isset($_SESSION['id'])) {
    header('location:index.php');
}
if (isset($_POST['profile'])) {
    header('location:prfile.php');
}

?>

<html>
<title>Home</title>

<head>
    <meta name="viewpost" content="width=device-width, initial-scale=1.0">
    <link href="assets/css/home.css?v=<?php echo time(); ?>" rel="stylesheet" type="text/css">

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
                        <a href="home.php" class="nav-link text-light">Home</a>
                    </li>
                    <li class="nav-item mr-3">
                        <a href="categoryproduct.php?category=1" class="nav-link text-light">Man</a>
                    </li>
                    <li class="nav-item mr-3">
                        <a href="categoryproduct.php?category=7" class="nav-link text-light">Women</a>
                    </li>
                    <li class="nav-item mr-3">
                        <a href="categoryproduct.php?category=13" class="nav-link text-light">Health & Breauty</a>
                    </li>
                    <li class="nav-item mr-3">
                        <a href="categoryproduct.php?category=19" class="nav-link text-light">Electronic</a>
                    </li>
                    <li class="nav-item mr-3">
                        <a href="categoryproduct.php?category=24" class="nav-link text-light">Food</a>
                    </li>
                    <li class="nav-item mr-3">
                        <a href="order.php" class="nav-link text-light">Order</a>
                    </li>
                    <li class="nav-item mr-3">
                        <button class="btn nav-link bg-primary mt-2 text-light" data-toggle="collapse" data-target="#demo"><?php
                                                                                                                            echo $_SESSION['login_success']; ?>
                        </button>
                        <div id="demo" class="collapse mt-1">

                            <ul>
                                <li><a href="profile.php" class="h5 text-light link-unstyled">Profile</a></li>
                                <li><a href="cart.php" class="h5 text-light link-unstyled">Cart</a></li>
                                <li><a href="logout.php" class="h5 text-light text-decoration-none">Logout</a></li>
                            </ul>



                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>


    <div class='row container-fluid mt-2 m-auto'>
        <?php
        $query = $source->Query("SELECT * FROM products limit 1,70");
        $products = $source->FetchAll();
        $row = $source->CountRows();
        $i = 0;
        if ($row > 0) {
            foreach ($products as $product) {
                echo   "<div class='mainbody col-sm-5 col-md-5 col-lg-2'>
                   <div class='card bg-light'>
                        <img class='card-img-top ' src='assets/productsimg/" . $product->image . "'>
                        <div class='card-body'>
                            <span class='card-title '>" . $product->name . "</span>
                            <hr>
                            <p class='card-text h5'>" . $product->price . " Tk</p>
                            
                            <a href='productdetails.php?clicked=" . $product->id . "' class='btn btn-outline-success mr-auto'>See Details</a>
                        </div>
		            </div>
	            </div>";
            }
        }
        ?>

    </div>
    </div>

</body>

</html>