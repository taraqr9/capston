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
    $qty = $product->qty;
    $img = $product->image;
    $sub_cate = $product->sub_category;
    $category = $product->category;
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
if(isset($_POST['s'])){
    $_SESSION['size'] = $_POST['s'];
}else if(isset($_POST['m'])){
    $_SESSION['size'] = $_POST['m'];
}else if(isset($_POST['l'])){
    $_SESSION['size'] = $_POST['l'];
}else if(isset($_POST['xl'])){
    $_SESSION['size'] = $_POST['xl'];
}else if(isset($_POST['xxl'])){
    $_SESSION['size'] = $_POST['xxl'];
}else{
    $_SESSION['size'] = "S";
}

//special offer 10%

$price = $product->price * .10;
$offerprice = $product->price - $price;
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

        <div class="container-fluid mt-2 row">

            <div class="img col-4">
                <img src="assets/productsimg/<?php echo $img; ?>" class="col-10">
            </div>
            <div class="details col-sm-8 bg-light">
                <?php

                if ($row > 0) {

                    
                    echo "
                <p class='h3 font-weight-normal mt-2'>Name : " . $product->name . "</p>
                <p class='h5 font-weight-normal text-secondary '>Category : <span class='text-dark'>" . $cate . "</span></p>
                <hr>

                <table class='table table-bordered'>
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
                <p class='size mb-3 text-muted text-uppercase small'> <span class='sizetitle'> Size : ".$_SESSION['size']." </span><br><br>
                <input type='submit' name='s' value='S' class='btn btn-outline-secondary  ml-2 p-1'>
                <input type='submit' name='m' value='M' class='btn btn-outline-secondary ml-2 p-1'>
                <input type='submit' name='l' value='L' class='btn btn-outline-secondary ml-2 p-1'>
                <input type='submit' name='xl' value='XL' class='btn btn-outline-secondary ml-2 p-1'>               
                <input type='submit' name='xxl' value='XXL' class='btn btn-outline-secondary ml-2 p-1'> </p>
                ";
                    }else{
                        $_SESSION['size'] = '';
                    }

                    echo "
                
                <hr>
                <p class='h5 font-weight-normal text-dark '>Product Left : <span class='text-dark'>" . $qty . "</span></p>
                <hr>
                <h4>Description : </h4>
                <p class='text-justify'>" . $product->description . "</p>
                <div class='row ml-0 mb-2'>
                <a href='buy.php?clicked=" . $product->id . "&qty=".$qty."' class='btn btn-outline-success'>Buy Now</a>
                <a href='php/addtocart.php?addtocart=" . $product->id . "' class='btn text-light bg-primary ml-2'>Add to Cart </a>
                </div>
                ";
                }
                ?>
            </div>
        </div>

    </form>
    </div>

</body>

</html>