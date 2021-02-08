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
                    $_SESSION['shoping'] = "<div class='text-danger'>Something Went Wrong 1</div>
                    
                    ".error_reporting(E_ALL);
                }
            } else {
                if ($source->Query("INSERT INTO `order` (`pid`,`uid`, `pname`, `qty`, `size`, `category`, `sub_category`, `price`, `name`, `email`, `phone`, `address`, `status`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)", [$_GET['clicked'], $_SESSION['id'], $pname, $data['qty'], $_SESSION['size'], $category, $sub_category, $price1, $data['name'], $data['email'], $data['phone'], $data['address'], $status])) {

                    $source->Query("UPDATE `products` set qty = ? where id = ?", [$uqty, $_GET['clicked']]);

                    $_SESSION['shoping'] = "<div class='text-success'>Thank you for your shopping</div>";
                } else {
                    $_SESSION['shoping'] = "<div class='text-danger'>Something Went Wrong</div>".error_reporting(E_ALL);
                }
            }
        }
    }
}
?>
<html>

<head>
    <?php include 'assets/splitfile/linkfiles.html'; ?>
    <style>
        .stars {
            color: #fcc45f;
        }
    </style>
</head>

<body>
    <!-- Top Bar -->
    <?php include "assets/splitfile/header.php" ?>

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
        <div class="container">
            <div class="container-fluid bg-light m-auto row mb-4">
                <div class="col-md-5 col-lg-2 col-xl-2">
                    <div class="mb-3 mb-md-0">

                        <img class="rounded w-75 m-1" src="assets/productsimg/<?php echo $_GET['clicked']; ?>.jpg" alt="Sample">
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
            <a href="#" style="text-decoration:none; color: black; margin-left:205px;">
                <input type="submit" name="proceed" value="Proceed To Buy" class="btn btn-outline-success col-2">
            </a>
        </div>

    </form>

    </div>





</body>

</html>