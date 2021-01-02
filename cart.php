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


// checking user details
if (isset($_POST['proceed'])) {



    // get check list value-------------------------

    if (!empty($_POST['check_list'])) {
        $count = 0;
        foreach ($_POST['check_list'] as $check) :
            

            //size
            $size0 = $source->Query("SELECT * FROM cart WHERE pid LIKE ? and uid like ?", [$check, $_SESSION['id']]);
            $size1 = $source->SingleRow();
            
            if(!empty($size1->oid)){
                $oid = $size1->oid;
            }else{
                $oid = "";
            }
            if (!empty($size1->size)) {
                $size = $size1->size;
            } else {
                $size = "";
            }

            $qty = $_POST['qty'] ;

            //details for cart to order table
            $db = $source->Query("SELECT * FROM products WHERE id=?", [$check]);
            $db1 = $source->SingleRow();
            $pname = $db1->name;
            $price = $db1->price;
            $category = $db1->category;
            $sub_category = $db1->sub_category;


            $status = "Pending";
            $data = [
                'name' => $_POST['name'],
                'email' => $_POST['email'],
                'phone' => $_POST['phone'],
                'address' => $_POST['address']
            ];
            //special offer 10%
            $price0 = $price * .10;
            $offerprice = $price - $price0;
            $price1 = intval($offerprice)*$qty[$count];
            if($qty[$count] != 0 || !empty($qty[$count])){
                if ($source->Query("INSERT INTO `order` SET pid=?,uid=?,pname=?,qty=?,size=?,category=?,sub_category=?,price=?, name =?, email = ?, phone=?,address=?, status=?", [$check, $_SESSION['id'], $pname,$qty[$count], $size, $category, $sub_category,$price1, $data['name'], $data['email'], $data['phone'], $data['address'], $status])) {
                    if ($source->Query("DELETE FROM cart WHERE oid =?", [$oid ])) {
                        $success = "Added On your ordered list. Please check on order  page";
                    }
                } else {
                    $success = "Something went wrong";
                }
            }
            

            
            $count++;
        endforeach;
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

    <!-- test part -->
    <div class="text-success">
        <?php
        if (!empty($success)) {
            echo $success;
            $success = "";
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


        <?php
        if ($source->Query("SELECT * FROM `cart` WHERE uid like ?", [$_SESSION['id']])) {
            $order = $source->FetchAll();
            $row = $source->CountRows();
            if ($row > 0) {
                foreach ($order as $carts) :

                    //special offer 10%
                    $price = $carts->price * .10;
                    $offerprice = $carts->price - $price;
                    echo "
            <div class='container-fluid p-3'>
                <div class='container bg-light m-auto row mb-4'>
                    <div class='col-md-5 col-lg-2 col-xl-2'>
                      <div class='view zoom overlay z-depth-1 rounded mb-3 mb-md-0'>
                          <input type='hidden' class='mr-3' name='check_list[" . $carts->pid . "]' value='" . $carts->pid . "'>
                          
                        <img class='img-fluid rounded w-50 m-1'
                          src='assets/productsimg/" . $carts->pid . ".jpg'>
                      </div>
                    </div>

                    
                    <div class='col-md-4 col-lg-2 col-xl-2'>
                      <div>
                        <div class='d-flex justify-content-between'>
                          <div>
                            <h5 class='mb-4 text-secondary'>Name : " . $carts->pname . " </h5>";

                    if ($carts->sub_category == '2' || $carts->sub_category == '5' || $carts->sub_category == '9') {

                        if (!empty($carts->size)) {
                            echo "<p class='mb-3 text-muted text-uppercase small'> Size : ";
                            echo $carts->size."</p>";
                        }
                    }
                    echo "
                            
                            <p class='mb-3 text-muted text-uppercase small'> QTY : <input type='number' value='1' name='qty[]' class='col-6'></p>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class='col-lg-8 col-xl-4 bg-light'>
                       <table class='table m-4'>
                        <tr>
                            <th>Original Price</th>
                            <th>Special Price</th>
                            <th>Disscount</th>
                            <th>Save</th>
                        </tr>
                        <tr>
                            <th class='text-secondary'><del>TK. " . $carts->price . "</del></th>
                            <th>TK. " . intval($offerprice) . "</th>
                            <th>TK. 10%</th>
                            <th>TK. " . intval($price) . "</th>
                        </tr>
                       </table>
                        
                    </div>
                    <a href='php/delete.php?remove=" . $carts->oid . "' class='btn btn-outline-danger m-auto h-25'>Remove</a>
                      
                  </div>
            </div>
            
            
            ";
                endforeach;
            }
        }


        ?>

        <!-- User Address -->

        <div class="container col-6 mt-5 ">
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
            <div class="mt-5 w-25">
            <a href="#" style="text-decoration:none; color: black; margin-left:10px;">
                <input type="submit" name="proceed" value="Proceed" class="btn btn-outline-success col-s-3">
            </a>
        </div>
        </div>

        

    </form>

    </div>

    <?php

    ?>



</body>

</html>