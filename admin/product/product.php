<?php
include "../../init.php";
include "headerfile.php";
if (empty($_SESSION['email'])) {
    header("location:index.php");
}
if (isset($_POST['addadmin'])) {

    $data = [
        'email' => $_POST['email'],
        'password' => $_POST['password'],
        'email_error' => '',
        'password_error' => ''
    ];

    if (empty($data['email'])) {
        $data['email_error'] = "Email is required";
    }
    if (empty($data['password'])) {
        $data['password_error'] = "Password is required";
    }
    // submitting form 
    if (empty($data['email_error']) && empty($data['password_error'])) {

        $password = password_hash($data['password'], PASSWORD_DEFAULT);
        if ($source->Query(
            "INSERT INTO admin (email,password) VALUES (?,?)",
            [$data['email'], $password]
        )) {
            $admin_create = "Admin account created successfully";
        }
    } else {
        $error = "Something went wrong";
    }
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
    <?php include 'splitfile/navbar.php' ?>

    <!-- products dropdown lists -->
    <div class="container">
        <form action="" method="POST">
            <div class="container-fluid">
                <div class="row bg-light">
                    <div class="col-lg-12 col-xl-8  m-2 container ml-lg-auto">

                        <!-- category product Dropdownlist -->
                        <div class="row">
                        <div class="mr-2">
                                <a href="endfile/category.php?all=999" class="btn btn-outline-info col-12">All</a>
                                
                            </div>

                            <div class="mr-2">
                                <button class="btn btn-outline-info dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Man
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                    <button class="dropdown-item" type="button"><a href="endfile/category.php?mcategory=1" class="btn btn-outline-info col-12">All of Man</a></button>

                                    <button class="dropdown-item" type="button"><a href="endfile/category.php?category=2" class="btn btn-outline-info col-12">T-Shirt</a></button>

                                    <button class="dropdown-item" type="button"><a href="endfile/category.php?category=3" class="btn btn-outline-info col-12">Panjabi</a></button>

                                    <button class="dropdown-item" type="button"><a href="endfile/category.php?category=4" class="btn btn-outline-info col-12">Pants</a></button>

                                    <button class="dropdown-item" type="button"><a href="endfile/category.php?category=5" class="btn btn-outline-info col-12">Shoes</a></button>

                                    <button class="dropdown-item" type="button"><a href="endfile/category.php?category=6" class="btn btn-outline-info col-12">Accessories</a></button>

                                </div>
                            </div>

                            <div class="mr-2">
                                <button class="btn btn-outline-info dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Women
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                    <button class="dropdown-item" type="button"><a href="endfile/category.php?mcategory=7" class="btn btn-outline-info col-12">All of Woman</a></button>

                                    <button class="dropdown-item" type="button"><a href="endfile/category.php?category=8" class="btn btn-outline-info col-12">Saree</a></button>

                                    <button class="dropdown-item" type="button"><a href="endfile/category.php?category=9" class="btn btn-outline-info col-12">Traditional Clothing</a></button>

                                    <button class="dropdown-item" type="button"><a href="endfile/category.php?category=10" class="btn btn-outline-info col-12">Bag</a></button>

                                    <button class="dropdown-item" type="button"><a href="endfile/category.php?category=11" class="btn btn-outline-info col-12">Shoes</a></button>

                                    <button class="dropdown-item" type="button"><a href="endfile/category.php?category=12" class="btn btn-outline-info col-12">Accessories</a></button>

                                </div>
                            </div>

                            <div class="mr-2">
                                <button class="btn btn-outline-info dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Health & Beauty
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                    <button class="dropdown-item" type="button"><a href="endfile/category.php?mcategory=13" class="btn btn-outline-info col-12">All</a></button>

                                    <button class="dropdown-item" type="button"><a href="endfile/category.php?category=14" class="btn btn-outline-info col-12">Bath Body</a></button>

                                    <button class="dropdown-item" type="button"><a href="endfile/category.php?category=15" class="btn btn-outline-info col-12">Beauty Tool</a></button>

                                    <button class="dropdown-item" type="button"><a href="endfile/category.php?category=16" class="btn btn-outline-info col-12">Hair Care</a></button>

                                    <button class="dropdown-item" type="button"><a href="endfile/category.php?category=17" class="btn btn-outline-info col-12">Man Care</a></button>

                                    <button class="dropdown-item" type="button"><a href="endfile/category.php?category=18" class="btn btn-outline-info col-12">Skin Care</a></button>

                                </div>
                            </div>

                            <div class="mr-2">
                                <button class="btn btn-outline-info dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Electronic
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                    <button class="dropdown-item" type="button"><a href="endfile/category.php?mcategory=19" class="btn btn-outline-info col-12">All Electronic</a></button>

                                    <button class="dropdown-item" type="button"><a href="endfile/category.php?category=20" class="btn btn-outline-info col-12">Mobile</a></button>

                                    <button class="dropdown-item" type="button"><a href="endfile/category.php?category=21" class="btn btn-outline-info col-12">Tablet</a></button>

                                    <button class="dropdown-item" type="button"><a href="endfile/category.php?category=22" class="btn btn-outline-info col-12">Laptop</a></button>

                                    <button class="dropdown-item" type="button"><a href="endfile/category.php?category=23" class="btn btn-outline-info col-12">Camera</a></button>

                                </div>
                            </div>

                            <div class="mr-2">
                                <button class="btn btn-outline-info dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Food
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                    <button class="dropdown-item" type="button"><a href="endfile/category.php?mcategory=24" class="btn btn-outline-info col-12">Food</a></button>


                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Search Bar -->
                    <form action="endfile/search.php" method="post">
                        <div class="row col-lg-12 col-xl-4 ml-lg-auto">
                            <input type="text" class="form-control col-6 m-2 " placeholder="Search..." name="textsearch">
                            <input type="submit" name="searchbtn" value="Search" class="btn btn-outline-info col-3 m-2 " />
                        </div>
                    </form>
                </div>
            </div>
        </form>
    </div>
    
    <!-- Add product button -->
    <?php
    if (!empty($_SESSION['admin_log'])) {
        if ($_SESSION['admin_log'] == '1') {
            echo "
                    <div class='container mt-3 mb-3 w-100'>
                    <form method='POST'>
                    <a href='addproducts.php' class='form-control col-3 mt-2 ml-auto btn btn-block btn-outline-info'>Add Product</a>
                    </form>
                    </div>";
        }
    }
    ?>

    <!-- show admins -->
    <div class="container-fluid">
        <div class="container">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th class="col-1"></th>
                        <th class="col-1">ID</th>
                        <th class="col-1">Name</th>
                        <th class="col-1">Price</th>
                        <th class="col-1">Qty</th>
                        <th class="col-1">Category</th>
                        <th class="col-1">Sub Category</th>
                        <th class="col-1"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if(!empty($_SESSION['category'])){

                        $cate = $_SESSION['category'];
                        $query = $source->Query("SELECT * FROM products where sub_category=?",[$cate]);
                        $_SESSION['category'] = "";
                    }else if(!empty($_SESSION['mcategory'])){

                        $cate = $_SESSION['mcategory'];
                        $query = $source->Query("SELECT * FROM products where category=?",[$cate]);
                        $_SESSION['mcategory'] = "";
                    }else if(!empty($_SESSION['all'])){
                        $query = $source->Query("SELECT * FROM products");
                        $_SESSION['all'] = "";
                    }else{
                        $query = $source->Query("SELECT * FROM products");
                        
                    }
                    $details = $source->FetchAll();
                    $numrow = $source->CountRows();

                    if ($numrow > 0) {
                        foreach ($details as $row) :

                            echo "
                <tr>
                <td class='col-1'> <img class='rounded m-1' style='height:60px;' src='../../assets/productsimg/".$row->image."' alt='Sample'></td>
                <td class='col-1'>" . $row->id . "</td>
                <td class='col-1'>" . $row->name . "</td>
                <td class='col-1'>" . $row->price . "</td>
                <td class='col-1'>" . $row->qty . "</td>
                <td class='col-1'>" . $row->category . "</td>
                <td class='col-1'>" . $row->sub_category . "</td>";
                if (!empty($_SESSION['admin_log'])) {
                    if ($_SESSION['admin_log'] == '1') {
                        echo "<td class='col-1'><a href='edit.php?approval=".$row->id."' class='btn btn-outline-info m-auto'> Edit</a>
                        </td>";
                    }
                }

                echo "
                </tr>";

                        endforeach;
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>


</body>

</html>