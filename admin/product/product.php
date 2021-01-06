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
    <script src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script>
</head>

<body>
    <!-- navbar -->
    <div class="container-fluid sticky-top">
        <div class="row bg-light">
            <h1 class="text-info col-6 text-center m-auto">ADMIN PANEL</h1>
            <div class="col-6  mt-3">
                <form action="" method="POST">



                    <div class="row ml-5">
                        <div class="mr-2">
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







                </form>
            </div>
        </div>
    </div>

    <div class="container-fluid sticky-top">
        <div class="row bg-light">
            <div class="col-6  mt-3">
                <form action="" method="POST">

                    <div class="row ml-5">

                        <div class="mr-2">
                            <button class="btn btn-outline-info dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Man
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                <button class="dropdown-item" type="button"><a href="endfile/category.php?category=1" class="btn btn-outline-info col-12">All of Man</a></button>

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
                                <button class="dropdown-item" type="button"><a href="endfile/category.php?category=7" class="btn btn-outline-info col-12">All of Woman</a></button>

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
                                <button class="dropdown-item" type="button"><a href="endfile/category.php?category=13" class="btn btn-outline-info col-12">All</a></button>

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
                                <button class="dropdown-item" type="button"><a href="endfile/category.php?category=19" class="btn btn-outline-info col-12">All Electronic</a></button>

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
                                <button class="dropdown-item" type="button"><a href="endfile/category.php?category=24" class="btn btn-outline-info col-12">Food</a></button>

                                
                            </div>
                        </div>

                        
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Add product button -->
    <?php
    if (!empty($_SESSION['admin_log'])) {
        if ($_SESSION['admin_log'] == '1') {
            echo "
      <div class='container mt-3 mb-3 w-100'>
    <form method='POST'>
      <input type='submit' class='form-control col-3 mt-2 ml-auto btn btn-block btn-outline-info' name='addproduct' value='Add Product'>
    </form>
  </div>
      
      ";
        }
    }
    ?>

    <!-- show admins -->
    <div class="container-fluid">
        <div class="container">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th class="col-1">ID</th>
                        <th class="col-1">Email</th>
                        <th class="col-1">Password</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $query = $source->Query("SELECT * FROM admin");
                    $details = $source->FetchAll();
                    $numrow = $source->CountRows();

                    if ($numrow > 0) {
                        foreach ($details as $row) :

                            echo "
                <tr>
                <td>" . $row->id . "</td>
                <td>" . $row->email . "</td>
                <td>" . $row->password . "</td>
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