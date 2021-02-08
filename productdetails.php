<!-- //Some changes will happen -->

<?php include "init.php";
if (isset($_POST['profile'])) {
    header('location:prfile.php');
}

?>

<?php
// Query for product details

if (!empty($_GET['clicked'])) {
    $query = $source->Query("SELECT * FROM products WHERE id=?", [$_GET['clicked']]);
    $product = $source->SingleRow();
    $row = $source->CountRows();
    $qty = $product->qty;;
    $sub_cate = $product->sub_category;
    $category = $product->category;
    $productIn = [];
    $productIn[] = $_GET['clicked'];
} else if (!empty($_SESSION['pid'])) {
    $query = $source->Query("SELECT * FROM products WHERE id=?", [$_SESSION['pid']]);
    $product = $source->SingleRow();
    $row = $source->CountRows();
    $qty = $product->qty;
    $img = $product->image;
    $sub_cate = $product->sub_category;
    $category = $product->category;
}


// Query for Category name 
$query1 = $source->Query("SELECT * FROM product_categories WHERE id=?", [$category]);
$product1 = $source->SingleRow();
$cate = $product1->categories;

//size
if (isset($_POST['s'])) {
    $_SESSION['size'] = $_POST['s'];
} else if (isset($_POST['m'])) {
    $_SESSION['size'] = $_POST['m'];
} else if (isset($_POST['l'])) {
    $_SESSION['size'] = $_POST['l'];
} else if (isset($_POST['xl'])) {
    $_SESSION['size'] = $_POST['xl'];
} else if (isset($_POST['xxl'])) {
    $_SESSION['size'] = $_POST['xxl'];
} else {
    $_SESSION['size'] = "S";
}

//special offer 10%

$price = $product->price * .10;
$offerprice = $product->price - $price;
?>

<html>
<title>Home</title>

<head>

    <link href="assets/css/productdetails.css?v=<?php echo time(); ?>" rel="stylesheet" type="text/css">
    <?php include 'assets/splitfile/linkfiles.html'; ?>

    <style>
        .stars {
            color: #fcc45f;
        }
    </style>

</head>

<body>
    <!-- nav bar -->
    <?php include "assets/splitfile/header.php" ?>

    <!-- <nav class=" navbar navbar-expand-md navbar-light sticky-top">
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
    </nav> -->
    <!-- After bought product msg -->
    <div class="text-success bg-light h3">
        <?php
        if (!empty($_SESSION['addtocart'])) {
            echo $_SESSION['addtocart'];
            $_SESSION['addtocart'] = "";
        }

        if (!empty($_SESSION['shopdone'])) {
            echo $_SESSION['shopdone'];
            $_SESSION['shopdone'] = "";
        }
        ?>
    </div>
    <!-- Product -->
    <form action="" method="POST">


        <section class="bannerSection">
            <div class="container-fluid">
                <div class="row">
                    <!-- NOTE side menu -->
                    <?php include 'assets/splitfile/sidemenu.php' ?>



                    <!-- NOTE Product Details Start -->
                    <div class="mt-2">
                        <div class="col-xxl-9 col-xl-9 col-lg-9 col-sm-12">
                            <div class="product">
                                <div class="row">
                                    <div class="img col-4 m-auto">
                                        <img src="assets/productsimg/<?php echo $product->id . ".jpg"; ?>">
                                    </div>
                                    <div class="details col-8 bg-light">
                                        <?php
                                        if ($row > 0) {
                                            echo "
                                                    <p class='h3 font-weight-normal mt-2'>Name : " . $product->name . "</p>
                                                    <p class='h5 font-weight-normal text-secondary '>Category : <span class='text-dark'>" . $cate . "</span></p>
                                                    <hr>

                                                    <table class='table table-bordered w-75'>
                                                        <thead>
                                                            <tr>
                                                                <th class='h4'>Original Price</th>
                                                                <th class='h4'>Special Price</th>
                                                                <th class='h4'>Disscount</th>
                                                                <th class='h4'>Save</th>
                                                            </tr>
                                                            <tr>
                                                                <th class='text-secondary h4'><del>TK. " . $product->price . "</del></th>
                                                                <th class='h4'>TK. " . intval($offerprice) . "</th>
                                                                <th class='text-muted h4'>TK. 10%</th>
                                                                <th class='h4 text-muted'>TK. " . intval($price) . "</th>
                                                            </tr>
                                                        </thead>
                                                    </table>
                                                    ";

                                            if ($sub_cate == '2' || $sub_cate == '5' || $sub_cate == '9') {
                                                echo "
                                                        <p class='size mb-3 text-muted text-uppercase small'> <span class='sizetitle'> Size : " . $_SESSION['size'] . " </span><br><br>
                                                        <input type='submit' name='s' value='S' class='btn btn-outline-secondary  ml-2 p-1'>
                                                        <input type='submit' name='m' value='M' class='btn btn-outline-secondary ml-2 p-1'>
                                                        <input type='submit' name='l' value='L' class='btn btn-outline-secondary ml-2 p-1'>
                                                        <input type='submit' name='xl' value='XL' class='btn btn-outline-secondary ml-2 p-1'>               
                                                        <input type='submit' name='xxl' value='XXL' class='btn btn-outline-secondary ml-2 p-1'> </p>
                                                        ";
                                            } else {
                                                $_SESSION['size'] = '';
                                            }
                                            echo "
                
                                                    <hr>
                                                    <p class='h5 font-weight-normal text-dark '>Product Left : <span class='text-dark'>" . $qty . "</span></p>
                                                    <hr>
                                                    <h4>Description : </h4>
                                                    <p class='text-justify'>" . $product->description . "</p>
                                                    <div class='row m-auto mb-2'>
                                                    <a href='buy.php?clicked=" . $product->id . "&qty=" . $qty . "' class='btn btn-outline-success m-1 d-inline col-4'>Buy Now</a>
                                                    <a href='php/addtocart.php?addtocart=" . $product->id . "' class='btn text-light bg-primary m-1 col-4'>Add to Cart </a>
                                                    </div>
                                                    ";
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- NOTE Product Details END -->
                <!-- NOTE Suggested product Start -->
                <?php
                $query = $source->Query("SELECT max(id) as id FROM `products` WHERE category=? and sub_category=?", [$category, $sub_cate]);
                $findId = $source->SingleRow();
                $maxId = $findId->id;

                $query = $source->Query("SELECT min(id) as id FROM `products` WHERE category=? and sub_category=?", [$category, $sub_cate]);
                $findId = $source->SingleRow();
                $minId = $findId->id;

                for ($i = 1; $i <= 8; $i++) {
                    $randomId = rand($minId, $maxId);
                    if (!in_array($randomId, $productIn)) {
                        $query = $source->Query("SELECT * FROM products WHERE id=?", [$randomId]);
                        $product = $source->SingleRow();
                        echo "
                        
                        <div class='suggPro  col-2'>
                            <div class='card' >
                                <img src='assets/productsimg/" . $product->id . ".jpg' class='card-img-top m-auto' style='height:200px; width:200px;' alt=''>
                                <div class='card-body'>
                                    <p class='card-text' style='height:20px;'>" . $product->name . "</p>
                                    <strong>" . intval($offerprice) . " TK</strong><br>
                                    <del><strong class = 'text-secondary'>" . $product->price . "</strong></del><br>
                                    
                                    <div class='stars'>
                                        <span><i class='fas fa-star'></i></span>
                                        <span><i class='fas fa-star'></i></span>
                                        <span><i class='fas fa-star'></i></span>
                                        <span><i class='fas fa-star'></i></span>
                                        <span><i class='fas fa-star'></i></span>
                                    </div>
                                </div>
                                <a href='productdetails.php?clicked=" . $product->id . "' class='btn btn-outline-info p-2'>See Details</a>
                            </div>
                        </div>";

                        $productIn[] = $product->id;
                    } else {
                        $i--;
                    }
                    $br = $i % 4;
                    if ($br == 0) {
                        echo "<br>";
                    }
                }

                ?>
            </div>
            <!-- NOTE Suggested product END -->
        </section>
    </form>
    </div>

    <?php include 'assets/splitfile/sidemenujs.html'; ?>
</body>

</html>