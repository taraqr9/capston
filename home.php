<?php
include "init.php";
if (!isset($_SESSION['id'])) {
  header('location:index.php');
}
if (isset($_POST['profile'])) {
  header('location:prfile.php');
}

?>

<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewpost" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
  <script src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script>
  <!-- style CSS -->
  <link rel="stylesheet" href="assets/css/style.css">
  <meta name="viewpost" content="width=device-width, initial-scale=1.0">
  <title>Daily Bazar|Home</title>
  <link rel="icon" href="assets/img/Logo2.png">

  <!-- font awsome link -->
  <link rel="stylesheet" href="assets/css/all.css">

</head>

<body>
  <!-- ***** header-section start***** -->
  <section class="headerSection sticky-top">
    <div class="container">
      <div class="row" style="align-items: center;">
        <!-- logo-column -->
        <div class="col-3 col-sm-3 col-xsm-2">
          <h2><a href="home.php" style="text-decoration: none; color: white;">DailyBazar</a></h2>
        </div>
        <!-- search box column -->
        <div class="col-5 col-sm-4 col-xsm-3">
          <div class="searchTextField">
            <form class="d-flex" method="POST">
              <input class="form-control me-2" type="text" name="search" required>
              <input type="submit" name="searchBtn" value="SEARCH" class="btn btn-outline-light rounded-pill">
            </form>
          </div>

        </div>
        <div class="col-1 col-sm-1 col-xsm-1">
          <a href="cart.php"><img src="assets/img/shopping.png" alt=""></a>
        </div>
        <div class="col-3 col-sm-4 col-xsm-6">
          <div class="row">
            <div class="profile">
              <div class="profileDrop dropdown">
                <button class="btn shadow-none dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <img src="assets/img/profile.svg" style="width: 40px; margin-bottom:10px">
                  <span class="h3"><?php echo $_SESSION['login_success']; ?></span>
                </button>
                <div class="ddr dropdown-menu rounded" style="margin-left:200px;" aria-labelledby="dropdownMenu2">
                <a href="profile.php" class=" h5 rounded-pill dropdown-item">Profile</a>
                <a href="order.php" class="h5 rounded-pill dropdown-item ">Order</a>
                <a href="logout.php" class="h5 rounded-pill dropdown-item">Logout</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- ***** header-section End ***** -->
  <!-- ***** Banner section start ***** -->

  <section class="bannerSection">
    <div class="container">
      <div class="row">
        <div class="col-xxl-3 col-xl-3 col-lg-3 col-sm-12">
          <div class="catagory">
            <div class="accordion accordion-flush" id="accordionFlushExample">
              <div class="accordion-item">
                <h2 class="accordion-header" id="flush-headingOne">
                  <button class="accordion-button  collapsed shadow-none" style="background: none;" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                    <img src="assets/img/Men.svg" alt="" style="width: 23px;">
                    <h3>Men's Fashion</h3>
                  </button>
                </h2>
                <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                  <div class="accordion-body">
                    <ul>
                      <li><a href="home.php?category=1&sub_category=2">
                          <h4>T-Shirt</h4>
                        </a></li>
                      <li><a href="home.php?category=1&sub_category=3">
                          <h4>Panjabi</h4>
                        </a></li>
                      <li><a href="home.php?category=1&sub_category=4">
                          <h4>Pants</h4>
                        </a></li>
                      <li><a href="home.php?category=1&sub_category=5">
                          <h4>Shoes</h4>
                        </a></li>
                      <li><a href="home.php?category=1&sub_category=6">
                          <h4>Accessories</h4>
                        </a></li>
                    </ul>
                  </div>
                </div>
              </div>
              <div class="accordion-item">
                <h2 class="accordion-header" id="flush-headingTwo">
                  <button class="accordion-button collapsed shadow-none" style="background: none;" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                    <img src="assets/img/women.svg" alt="" style="width: 16px;">
                    <h3>Women's Fashion</h3>
                  </button>
                </h2>
                <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
                  <div class="accordion-body">
                    <ul>
                      <li><a href="home.php?category=7&sub_category=8">
                          <h4>Saree</h4>
                        </a></li>
                      <li><a href="home.php?category=7&sub_category=9">
                          <h4>Traditional Clothing</h4>
                        </a></li>
                      <li><a href="home.php?category=7&sub_category=10">
                          <h4>Women Bag</h4>
                        </a></li>
                      <li><a href="home.php?category=7&sub_category=11">
                          <h4>Shoes</h4>
                        </a></li>
                      <li><a href="home.php?category=7&sub_category=12">
                          <h4>Accessories</h4>
                        </a></li>
                    </ul>
                  </div>
                </div>
              </div>
              <div class="accordion-item">
                <h2 class="accordion-header" id="flush-headingThree">
                  <button class="accordion-button collapsed shadow-none" style="background: none;" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                    <img src="assets/img/helth.svg" alt="" style="width: 16px;">
                    <h3>Health and Beauty</h3>
                  </button>
                </h2>
                <div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
                  <div class="accordion-body">
                    <ul>
                      <li><a href="home.php?category=13&sub_category=14">
                          <h4>Bath Body</h4>
                        </a></li>
                      <li><a href="home.php?category=13&sub_category=15">
                          <h4>Beauty Tool</h4>
                        </a></li>
                      <li><a href="home.php?category=13&sub_category=16">
                          <h4>Hair Care</h4>
                        </a></li>
                      <li><a href="home.php?category=13&sub_category=17">
                          <h4>Man Care</h4>
                        </a></li>
                      <li><a href="home.php?category=13&sub_category=18">
                          <h4>Skin Care</h4>
                        </a></li>
                    </ul>
                  </div>
                </div>
              </div>
              <div class="accordion-item">
                <h2 class="accordion-header" id="flush-headingFour">
                  <button class="accordion-button collapsed shadow-none" style="background: none;" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseFour" aria-expanded="false" aria-controls="flush-collapseFour">
                    <img src="assets/img/Electronic.svg" alt="" style="width: 16px;">
                    <h3>Electronic Devices</h3>
                  </button>
                </h2>
                <div id="flush-collapseFour" class="accordion-collapse collapse" aria-labelledby="flush-headingFour" data-bs-parent="#accordionFlushExample">
                  <div class="accordion-body">
                    <ul>
                      <li><a href="home.php?category=19&sub_category=20">
                          <h4>Mobile</h4>
                        </a></li>
                      <li><a href="home.php?category=19&sub_category=21">
                          <h4>Tablet</h4>
                        </a></li>
                      <li><a href="home.php?category=19&sub_category=22">
                          <h4>Laptop</h4>
                        </a></li>
                      <li><a href="home.php?category=19&sub_category=23">
                          <h4>Camera</h4>
                        </a></li>
                    </ul>
                  </div>
                </div>
              </div>
              <div class="accordion-item">
                <h2 class="accordion-header" id="flush-headingFive">
                  <button class="accordion-button collapsed shadow-none" style="background: none;" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseFive" aria-expanded="false" aria-controls="flush-collapseFive">
                    <img src="assets/img/food.svg" alt="" style="width: 16px;">
                    <h3>Food</h3>
                  </button>
                </h2>
                <div id="flush-collapseFive" class="accordion-collapse collapse" aria-labelledby="flush-headingFive" data-bs-parent="#accordionFlushExample">
                  <div class="accordion-body">
                    <ul>
                      <li><a href="home.php?category=24&sub_category=25">
                          <h4>Fruit</h4>
                        </a>
                      </li>
                      <li><a href="home.php?category=24&sub_category=26">
                          <h4>Cooking Essential</h4>
                        </a>
                      </li>
                      <li><a href="home.php?category=24&sub_category=27">
                          <h4>Vegetables</h4>
                        </a>
                      </li>
                      <li><a href="home.php?category=24&sub_category=28">
                          <h4>Meat</h4>
                        </a>
                      </li>
                      <li><a href="home.php?category=24&sub_category=29">
                          <h4>Fish</h4>
                        </a>
                      </li>
                      <li><a href="home.php?category=24&sub_category=30">
                          <h4>Chocolate and Candies</h4>
                        </a>
                      </li>
                      <li><a href="home.php?category=24&sub_category=31">
                          <h4>Baby food & Care</h4>
                        </a>
                      </li>
                      <li><a href="home.php?category=24&sub_category=32">
                          <h4>Bread,Biscuits & Cake</h4>
                        </a>
                      </li>
                      <li><a href="home.php?category=24&sub_category=33">
                          <h4>Drinks</h4>
                        </a>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- //NOTE Main Section  -->
        <div class="col-xxl-9 col-xl-9 col-lg-9 col-sm-12">
          <div class="product">

            <div class="row">
              <?php
              if (isset($_POST['searchBtn']) && !empty($_POST['search'])) {
                $query = $source->Query("SELECT * FROM products WHERE name like '%%'");
                $products = $source->FetchAll();
                $totalRow = $source->CountRows();

                foreach ($products as $product) :
                  $price = $product->price * .10;
                  $offerprice = $product->price - $price;
                  echo "
                  
                  <div class='col-sm-3'>
                      <div class='card' >
                        <img src='assets/productsimg/" . $product->id . ".jpg' class='card-img-top' style='height:200px;' alt=''>
                        <div class='card-body'>
                          <p class='card-text ' style='height:30px;'>" . $product->name . "</p>
                          <strong>" . intval($offerprice) . " TK</strong><br>
                          <del><strong class = 'text-secondary'>" . $product->price . " TK</strong></del><br>
                          
                          <ul>
                            <li><i class='fas fa-star'></i></li>
                            <li><i class='fas fa-star'></i></li>
                            <li><i class='fas fa-star'></i></li>
                            <li><i class='fas fa-star'></i></li>
                            <li><i class='fas fa-star'></i></li>
                          </ul>
                          <a href='productdetails.php?clicked=" . $product->id . "' class='btn btn-outline-info text-dark'>See Details</a>
                        </div>
                      </div>
                    </div>
                  
                  ";

                endforeach;
              } elseif (isset($_GET['category'])  && isset($_GET['sub_category'])) {
                $query = $source->Query("SELECT * FROM `products` where category = ? and sub_category = ? ", [$_GET['category'], $_GET['sub_category']]);
                $products = $source->FetchAll();
                $totalRow = $source->CountRows();

                foreach ($products as $product) :
                  $price = $product->price * .10;
                  $offerprice = $product->price - $price;
                  echo "
                  
                  <div class='col-sm-3'>
                      <div class='card' >
                        <img src='assets/productsimg/" . $product->id . ".jpg' class='card-img-top' style='height:200px;' alt=''>
                        <div class='card-body'>
                          <p class='card-text ' style='height:30px;'>" . $product->name . "</p>
                          <strong>" . intval($offerprice) . " TK</strong><br>
                          <del><strong class = 'text-secondary'>" . $product->price . " TK</strong></del><br>
                          
                          <ul>
                            <li><i class='fas fa-star'></i></li>
                            <li><i class='fas fa-star'></i></li>
                            <li><i class='fas fa-star'></i></li>
                            <li><i class='fas fa-star'></i></li>
                            <li><i class='fas fa-star'></i></li>
                          </ul>
                        </div>
                        <a href='productdetails.php?clicked=" . $product->id . "' class='btn btn-outline-info text-dark p-2'>See Details</a>
                      </div>
                    </div>
                  
                  ";

                endforeach;
              } else {
                $i = 0;
                for ($i = 0; $i <= 23; $i++) {
                  $randomNumber = [];
                  $randNum = rand(2, 400);
                  if (!in_array($randNum, $randomNumber)) {
                    $query = $source->Query("SELECT * FROM `products` where id = ?", [$randNum]);
                    $product = $source->SingleRow();

                    $price = intval($product->price) * .10;
                    $offerprice = intval($product->price - $price);
                    echo "
                      
                      <div class='col-sm-3'>
                          <div class='card' >
                            <img src='assets/productsimg/" . $product->id . ".jpg' class='card-img-top' style='height:200px;' alt=''>
                            <div class='card-body'>
                              <p class='card-text ' style='height:30px;'>" . $product->name . "</p>
                              <strong>" . intval($offerprice) . " TK</strong><br>
                              <del><strong class = 'text-secondary'>" . $product->price . "</strong></del><br>
                              
                              <ul>
                                <li><i class='fas fa-star'></i></li>
                                <li><i class='fas fa-star'></i></li>
                                <li><i class='fas fa-star'></i></li>
                                <li><i class='fas fa-star'></i></li>
                                <li><i class='fas fa-star'></i></li>
                              </ul>
                              
                            </div>
                            <a href='productdetails.php?clicked=" . $product->id . "' class='btn btn-outline-info p-2'>See Details</a>
                          </div>
                        </div>
                      
                      ";
                    $randomNumber[] = $randNum;
                  } else {
                    $i--;
                  }
                }
              }
              ?>

            </div>
          </div>
        </div>
      </div>
    </div>
  </section>






  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
  <script src="assets/js/all.js"></script>
</body>

</html>



<!-- // $media-lg:1199px;
// $media-md:991px;
// $media-sm:767px;
// $media-xs:575px; -->