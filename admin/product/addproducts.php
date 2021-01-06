<?php
include "../../init.php";

if (empty($_SESSION['email'])) {
    header("location:index.php");
}
if (isset($_POST['admin'])) {
    header("location:admin.php");
}
if (isset($_POST['users'])) {
    header("location:users.php");
}
if (isset($_POST['approved'])) {
    header("location:approved.php");
}
if (isset($_POST['pending'])) {
    header("location:pending.php");
}




// Category
if (isset($_POST['1'])) {
    $_SESSION['cate'] = 1;
} else if (isset($_POST['7'])) {
    $_SESSION['cate'] = 7;
} else if (isset($_POST['13'])) {
    $_SESSION['cate'] = 13;
} else if (isset($_POST['19'])) {
    $_SESSION['cate'] = 19;
} else if (isset($_POST['24'])) {
    $_SESSION['cate'] = 24;
} else {
    $_SESSION['cate'] = "None";
}
// Sub Category
if (isset($_POST['1'])) {
    $_SESSION['cate'] = 1;
} else if (isset($_POST['7'])) {
    $_SESSION['cate'] = 7;
} else if (isset($_POST['13'])) {
    $_SESSION['cate'] = 13;
} else if (isset($_POST['19'])) {
    $_SESSION['cate'] = 19;
} else if (isset($_POST['24'])) {
    $_SESSION['cate'] = 24;
} else {
    $_SESSION['cate'] = "None";
}
?>

<html>

<head>
    <title>Products</title>
    <meta name="viewpost" content="width=device-width, initial-scale=1.0" />

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>


</head>

<body>
    <!-- navbar -->
    <div class="container sticky-top">
        <div class="row bg-light">
            <h1 class="text-info col-6 text-center m-auto">ADMIN PANEL</h1>
            <div class="col-6  mt-3">
                <form action="" method="POST">



                    <div class="row col-12">
                        <div class="mr-2 ml-auto">
                            <button class="btn btn-outline-info dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Admin
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                <button class="dropdown-item" type="button"><input type="submit" value="Admins" name="admin" class="btn btn-outline-info col-12" /></button>
                                <button class="dropdown-item" type="button"><input type="submit" value="Users" name="users" class="btn btn-outline-info col-12" /></button>
                            </div>
                        </div>



                        <div class="mr-2">
                            <button class="btn btn-outline-info dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Product
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                <button class="dropdown-item" type="button"><input type="submit" value="Products" name="approved" class="btn btn-outline-info col-12" /></button>
                                <button class="dropdown-item" type="button"><input type="submit" value="Add Products" name="pending" class="btn btn-outline-info col-12" /></button>
                            </div>
                        </div>

                        <div class="mr-2">
                            <button class="btn btn-outline-info dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Order
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                <button class="dropdown-item" type="button"><input type="submit" value="Approved" name="approved" class="btn btn-outline-info col-12" /></button>
                                <button class="dropdown-item" type="button"><input type="submit" value="Pending" name="pending" class="btn btn-outline-info col-12" /></button>
                            </div>
                        </div>
                        <a href="logout.php" class="btn btn-outline-info mr-2">Logout</a>
                    </div>



            </div>
        </div>
    </div>

    <!-- Product details  -->
    <form action="" method="POST">
        <div class="div container">
            <div class="row">
                <!-- product pricture -->
                <div class="col-4 bg-secondary">
                    <div class="selectimg"><input type="file" name="image"></div>
                    <div class="uploadimg"><button type="submit" name="uploadbtn">Upload</button></div>
                    <div>
                        <?php
                        if (isset($_GET['file-name'])) {
                            echo "Image uploaded successfully";
                        }
                        ?>
                    </div>
                </div>




                <!-- product details -->
                <div class="col-8">
                    <input type="text" placeholder="Product Name" class="form-control col-5">

                    <div class="row col-6 mr-auto mt-2">
                        <input type="number" placeholder="Price" class="form-control col-5">
                        <input type="number" placeholder="Quantity" class="form-control col-5 ml-4">
                    </div>
                    <input type="text" placeholder="Description" class="form-control col-5 h-100 mt-2">


                    <!-- Category and sub category -->
                    <div class="row col-6 mr-auto mt-2">
                        <div class="mt-2">
                            <button class="btn btn-outline-secondary dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown">
                                Category
                            </button>
                            <div class="dropdown-menu m-auto">
                                <button class="dropdown-item" type="button"><input class="btn btn-outline-secondary" type="submit" value="Man" name="1" /></button>

                                <button class="dropdown-item" type="button"><input class="btn btn-outline-secondary" type="submit" value="Women" name="7" /></button>

                                <button class="dropdown-item" type="button"><input class="btn btn-outline-secondary" type="submit" value="Health & Beauty" name="13" /></button>

                                <button class="dropdown-item" type="button"><input class="btn btn-outline-secondary" type="submit" value="Electronic" name="19" /></button>

                                <button class="dropdown-item" type="button"><input class="btn btn-outline-secondary" type="submit" value="Food" name="24" /></button>

                            </div>
                        </div>
                        <div class="mt-2 ml-4">
                            <button class="btn btn-outline-secondary dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown">
                                Sub Category
                            </button>
                            <div class="dropdown-menu m-auto">
                                <?php
                                if ($_SESSION['cate'] != 'None' || !empty($_SESSION['cate'])) {
                                    $query = $source->Query("SELECT * FROM `product_categories` WHERE parent_id = ?", [$_SESSION['cate']]);
                                    $row = $source->FetchAll();
                                    foreach ($row as $data) {
                                        echo "<button class='dropdown-item' type='button'>
                                        <a href='endfile/addproductssql.php?sub_category=" . $data->id . "' class='btn btn-outline-secondary col-12'>" . $data->categories . "</a></button>";
                                    }
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Submit Form -->
                    <input type="submit" name="addproduct" value="Add Product" class="form-control col-3 mt-3 btn btn-outline-info">
                </div>

                <?php 
                    if($_POST['addproduct']){
                        echo $_SESSION['cate']."<br>".$_SESSION['sub_cate'];
                    }
                ?>
            </div>
        </div>
    </form>
</body>

</html>