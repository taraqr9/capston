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
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

  <!-- style CSS -->
  <link rel="stylesheet" href="assets/css/style.css">

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
              <input class="form-control me-2" type="search" name="search">
            <div class="searchIcon">
            <a href="home01.php?sbtn = 00"><i class="fas fa-search fa-2x"></i></a>
              
            </div>
            </form>
          </div>
          
        </div>
        <div class="col-1 col-sm-1 col-xsm-1">
          <a href="#"><img src="assets/img/shopping.png" alt=""></a>
        </div>
        <div class="col-3 col-sm-4 col-xsm-6">
          <div class="row">
            <div class="profile">
              <img src="assets/img/profile.svg" alt=""><span>Afia Mahmuda Ava</span>
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
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                    <img src="assets/img/Men.svg" alt="" style="width: 16px;"> Men's Fashion
                  </button>
                </h2>
                <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                  <div class="accordion-body">
                    <ul>
                      <li><a href="home01.php?category=1&sub_category=2">T-Shirt</a></li>
                      <li><a href="home01.php?category=1&sub_category=3">Panjabi</a></li>
                      <li><a href="home01.php?category=1&sub_category=4">Pants</a></li>
                      <li><a href="home01.php?category=1&sub_category=5">Shoes</a></li>
                      <li><a href="home01.php?category=1&sub_category=6">Accessories</a></li>
                    </ul>
                  </div>
                </div>
              </div>
              <div class="accordion-item">
                <h2 class="accordion-header" id="flush-headingTwo">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                    <img src="assets/img/women.svg" alt="" style="width: 16px;"> Women's Fashion
                  </button>
                </h2>
                <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
                  <div class="accordion-body">
                    <ul>
                      <li><a href="home01.php?category=7&sub_category=8">Saree</a></li>
                      <li><a href="home01.php?category=7&sub_category=9">Traditional Clothing</a></li>
                      <li><a href="home01.php?category=7&sub_category=10">Women Bag</a></li>
                      <li><a href="home01.php?category=7&sub_category=11">Shoes</a></li>
                      <li><a href="home01.php?category=7&sub_category=12">Accessories</a></li>
                    </ul>
                  </div>
                </div>
              </div>
              <div class="accordion-item">
                <h2 class="accordion-header" id="flush-headingThree">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                    <img src="assets/img/helth.svg" alt="" style="width: 16px;"> Health and Beauty
                  </button>
                </h2>
                <div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
                  <div class="accordion-body">
                    <ul>
                      <li><a href="home01.php?category=13&sub_category=14">Bath Body</a></li>
                      <li><a href="home01.php?category=13&sub_category=15">Beauty Tool</a></li>
                      <li><a href="home01.php?category=13&sub_category=16">Hair Care</a></li>
                      <li><a href="home01.php?category=13&sub_category=17">Man Care</a></li>
                      <li><a href="home01.php?category=13&sub_category=18">Skin Care</a></li>
                    </ul>
                  </div>
                </div>
              </div>
              <div class="accordion-item">
                <h2 class="accordion-header" id="flush-headingFour">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseFour" aria-expanded="false" aria-controls="flush-collapseFour">
                    <img src="assets/img/Electronic.svg" alt="" style="width: 16px;"> Electronic Devices
                  </button>
                </h2>
                <div id="flush-collapseFour" class="accordion-collapse collapse" aria-labelledby="flush-headingFour" data-bs-parent="#accordionFlushExample">
                  <div class="accordion-body">
                    <ul>
                      <li><a href="home01.php?category=19&sub_category=20">Mobile</a></li>
                      <li><a href="home01.php?category=19&sub_category=21">Tablet</a></li>
                      <li><a href="home01.php?category=19&sub_category=22">Laptop</a></li>
                      <li><a href="home01.php?category=19&sub_category=23">Camera</a></li>
                    </ul>
                  </div>
                </div>
              </div>
              <div class="accordion-item">
                <h2 class="accordion-header" id="flush-headingFive">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseFive" aria-expanded="false" aria-controls="flush-collapseFive">
                    <img src="assets/img/food.svg" alt="" style="width: 16px;"> Food
                  </button>
                </h2>
                <div id="flush-collapseFive" class="accordion-collapse collapse" aria-labelledby="flush-headingFive" data-bs-parent="#accordionFlushExample">
                  <div class="accordion-body">
                    <ul>
                      <li><a href="home01.php?category=24&sub_category=25">Fruit</a></li>
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
              //FIXME  search er ta thik korte hobe.
              if(isset($_GET['sbtn']) && !empty($_POST['search'])){
                $query = $source->Query("SELECT * FROM products WHERE name like '%" . $_POST['search'] . "%'");
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
                          <a href='productdetails.php?clicked=" . $product->id . "' class='btn btn-outline-info'>See Details</a>
                        </div>
                      </div>
                    </div>
                  
                  ";

                endforeach;
              }
              elseif (isset($_GET['category'])  && isset($_GET['sub_category'])) {
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
                        <a href='productdetails.php?clicked=" . $product->id . "' class='btn btn-outline-info p-2'>See Details</a>
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
                    $query = $source->Query("SELECT * FROM `products` where id = ?",[$randNum]);
                    $product = $source->SingleRow();

                      $price = $product->price * .10;
                      $offerprice = $product->price - intval($price);
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