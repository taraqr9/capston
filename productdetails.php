<?php include "init.php"; ?>

<?php
$query = $source->Query("SELECT * FROM products WHERE id=?", [$_GET['clicked']]);
$product = $source->SingleRow();
$row = $source->CountRows();
$sub_cate = $product->sub_category;


?>

<html>
<title>Home</title>

<head>
    <meta name="viewpost" content="width=device-width, initial-scale=1.0">
    <link href="assets/css/productdetails.css?v=<?php echo time(); ?>" rel="stylesheet" type="text/css">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script>
</head>

<body>
    <!-- nav bar -->
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

    <!-- After bought product msg -->
    <div class="text-success">
        <?php

        if (!empty($_SESSION['shopdone'])) {
            echo $_SESSION['shopdone'];
            $_SESSION['shopdone'] = "";
        }
        ?>
    </div>
    <!-- Product -->
    <div class="row col-12 p-5  bg-light">
        <div class="productpicture col-5 ml-auto">
            <img src="assets/productsimg/<?php echo $_GET['clicked']; ?>.jpg">
        </div>
        <div class="productpicture col-6 card">
            <?php

            if ($row > 0) {
                echo
                    "<div class='card-body '>
			<p class='card-title h3'> Name : " . $product->name . "</p>
			<hr>
			<p class='card-text h3'> Price : " . $product->price . " Tk</p>
			
            <div class='row'>
            <p class='card-text h3'>" . $product->descriptions . " Tk</p>
			<hr>
            <div class='row mt-5'>
            <a href='buy.php?clicked=" . $product->id . "' class='btn btn-outline-success'>Buy Now</a>
            <a href='productdetails.php?clicked=" . $product->id . "' class='btn btn-primary ml-2'>Add To Cart</a>
			</div>
		    </div> ";
            }
            ?>
        </div>
    </div>
</body>

</html>