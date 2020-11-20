<?php include "init.php"; ?>
<?php 
if(!isset($_SESSION['id'])){
    header('location:index.php');
}
if(isset($_POST['profile'])){
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
        <h1 class="display-4 text-light">DailyBazar</h1>
            
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


<div class='row mt-2'  >
<?php 
    $query = $source->Query("SELECT * FROM products");
    $products = $source->FetchAll();
    $row = $source->CountRows();
    $i = 0;
    if($row>0){
        foreach($products as $product){
        echo   "<div class='col-sm-10 col-md-6 col-lg-2'>
                   <div class='card'>
                        <img class='card-img-top' src='assets/productsimg/".$product->image."' width='200' height='300'>
                        <div class='card-body'>
                            <span class='card-title '>".$product->name."</span>
                            <hr>
                            <p class='card-text h3'>".$product->price." Tk</p>
                            <hr>
                            <div class='row'>
                            <a href='productdetails.php?clicked=".$product->id."' class='btn btn-outline-success'>See Details</a>
                            <a href='productdetails.php?clicked=".$product->id."' class='btn text-light bg-primary ml-2'>Add to Cart</a>
                            </div>
                        </div>
		            </div>
	            </div>";
            }
        }
?>

</div>






<!-- "<div class='col-sm-10 col-md-6 col-lg-2 container'>
                   <div class='card'>
                        <img class='card-img-top' src='assets/products/men/".$product->image."'>
                        <div class='card-body'>
                            <span class='card-title '>".$product->name."</span>
                            <hr>
                            <p class='card-text h3'>".$product->price." Tk</p>
                            <hr>
                            <a href='#' class='btn btn-outline-secondary'>See Profile</a>
                        </div>
		            </div>
	            </div>"; -->
    
        <!-- <div>
                <?php 
                    $query = $source->Query("SELECT * FROM products");
                    $products = $source->FetchAll();
                    $row = $source->CountRows();
                    $i = 0;
                    if($row>0){
                        foreach($products as $product){
                            echo "<div class='body' 
                            <ul class = 'item-box'>
                                <li>".$product->id."</li>
                                <li>".$product->price."</li>
                                <li>".$product->category."</li>
                            </ul> ";
                        }
                    }
                ?>
            </div> -->

</body>

</html>