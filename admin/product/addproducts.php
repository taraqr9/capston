<?php
include "../../init.php";
include "splitfile/headerfile.php";

if (empty($_SESSION['email'])) {
    header("location:index.php");
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
}
// given value store name price qty description
if (isset($_POST['1']) || isset($_POST['7']) || isset($_POST['13']) || isset($_POST['19']) || isset($_POST['24'])) {
    if (!empty($_POST['productname'])) {
        $_SESSION['pname'] = $_POST['productname'];
    }
    if (!empty($_POST['price'])) {
        $_SESSION['price'] = $_POST['price'];
    }
    if (!empty($_POST['qty'])) {
        $_SESSION['qty'] = $_POST['qty'];
    }
    if (!empty($_POST['description'])) {
        $_SESSION['des'] = $_POST['description'];
    }
}
// Checking valdation and sumitting form
if (isset($_POST['addproduct'])) {
    $row = $source->Query("SELECT * FROM products WHERE id = (SELECT MAX(id) FROM products)");
    $fetch = $source->SingleRow();
    $numrow = $fetch->id;
    $jpg = ".jpg";
    $imagedbname = $numrow + 1 . $jpg;
    $imagename = $numrow + 1;




    if ($_FILES['image']['name'] != '') {
        $allowed_ext = array("jpg", "JPG"); //allowed image extensions
        $extention = explode('.', $_FILES['image']['name']); //get uploaded file extension
        $ext = end($extention);
        if (in_array($ext, $allowed_ext)) {
            $path = "../../assets/productsimg/" . $imagename . '.' . $ext; //file upload loaction
            $image = $_FILES['image']['name'];
            move_uploaded_file($_FILES['image']['tmp_name'], $path);
        } else {
            $imageError = "<div class='text-success'>Invalid image file</div>";
        }
    } else {
        $imageError = "<div class='text-danger'>Please select a image file</div>";
    }


    //checking validation.....
    if (empty($imageError) && !empty($_POST['productname']) && !empty($_POST['price']) && !empty($_POST['qty']) && !empty($_POST['description']) && !empty($_SESSION['cate']) && !empty($_SESSION['sub_cate'])) {
        if ($source->Query("INSERT INTO `products` (name,price,qty,description,image,category,sub_category) VALUES (?,?,?,?,?,?,?)", [$_POST['productname'], $_POST['price'], $_POST['qty'], $_POST['description'], $imagedbname, $_SESSION['cate'], $_SESSION['sub_cate']])) {
            $_SESSION['addproduct'] = "<div class='text-success'>Product Added Successfully</div>";

            $_SESSION['cate'] = '';
            $_SESSION['sub_cate'] = '';
            $_SESSION['pname'] = '';
            $_SESSION['price'] = '';
            $_SESSION['qty'] = '';
            $_SESSION['des'] = '';
        } else {
            $_SESSION['addproduct'] =  "<div class='text-danger'>Product not Added</div>";
        }
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
    <?php include '../splitfile/navbar.php' ?>
    <!-- Afte added success or failed message  -->
    <?php
    if (!empty($_SESSION['addproduct'])) {
        echo $_SESSION['addproduct'];
        $_SESSION['addproduct'] = '';
    }
    if (!empty($imageError)) {
        echo $imageError;
    }

    ?>
    <!-- Product details  -->
    <div class="container mt-5 bg-secondary p-5 rounded">
        <input type="text" name="productname" placeholder="Product Name" class="form-control col-5 m-auto" <?php if (!empty($_SESSION['pname'])) {
                                                                                                                echo "value='" . $_SESSION['pname'] . "'";
                                                                                                            } ?>>

        <div class="row col-6 m-auto ">
            <input type="number" name="price" placeholder="Price" class="form-control col-5 mt-3 mr-auto" <?php if (!empty($_SESSION['price'])) {
                                                                                                                echo "value='" . $_SESSION['price'] . "'";
                                                                                                            } ?>>
            <input type="number" name="qty" placeholder="Quantity" class="form-control col-5 mt-3 ml-auto" <?php if (!empty($_SESSION['qty'])) {
                                                                                                                echo "value='" . $_SESSION['qty'] . "'";
                                                                                                            } ?>>




        </div>
        <div class='mt-3'>
            <input type="text" name="description" placeholder="Description" class="form-control  col-5 h-25  m-auto" <?php if (!empty($_SESSION['des'])) {
                                                                                                                            echo "value='" . $_SESSION['des'] . "'";
                                                                                                                        } ?>>
        </div>


        <!-- Category and sub category -->
        <div class="row col-6 m-auto ">
            <div class="m-auto">
                <button class="btn btn-outline-white dropdown-toggle mt-3" type="button" id="dropdownMenu2" data-toggle="dropdown">
                    <?php if (!empty($_SESSION['cate'])) {
                        if ($_SESSION['cate'] == 1) {
                            echo "Man";
                        } else if ($_SESSION['cate'] == 7) {
                            echo "Women";
                        } else if ($_SESSION['cate'] == 13) {
                            echo "Health & Beauty";
                        } else if ($_SESSION['cate'] == 19) {
                            echo "Electronic";
                        } else if ($_SESSION['cate'] == 24) {
                            echo "Food";
                        }
                    } else {
                        echo "Category";
                    }
                    ?>
                </button>
                <div class="dropdown-menu m-auto">
                    <button class="dropdown-item" type="button"><input class="btn btn-outline-dark" type="submit" value="Man" name="1" /></button>

                    <button class="dropdown-item" type="button"><input class="btn btn-outline-dark" type="submit" value="Women" name="7" /></button>

                    <button class="dropdown-item" type="button"><input class="btn btn-outline-dark" type="submit" value="Health & Beauty" name="13" /></button>

                    <button class="dropdown-item" type="button"><input class="btn btn-outline-dark" type="submit" value="Electronic" name="19" /></button>

                    <button class="dropdown-item" type="button"><input class="btn btn-outline-dark" type="submit" value="Food" name="24" /></button>

                </div>
            </div>
            <div class="m-auto">
                <button class="btn btn-outline-white dropdown-toggle mt-3" type="button" id="dropdownMenu2" data-toggle="dropdown">
                    Sub Category
                </button>
                <div class="dropdown-menu m-auto">
                    <?php
                    if ($_SESSION['cate'] != 'None' || !empty($_SESSION['cate'])) {
                        $query = $source->Query("SELECT * FROM `product_categories` WHERE parent_id = ?", [$_SESSION['cate']]);
                        $row = $source->FetchAll();
                        foreach ($row as $data) {
                            echo "<button class='dropdown-item' type='button'>
                                        <a href='endfile/addproductssql.php?sub_category=" . $data->id . "' class='btn btn-outline-dark col-12'>" . $data->categories . "</a></button>";
                        }
                    }
                    ?>
                </div>
            </div>
            <!-- Image inserting -->
        </div>
        <div class="mt-4 mb-3">
            <input type="file" name="image" class="form-control  col-5 m-auto">
        </div>
        <!-- Submit Form -->
        <div class="mt-4 mb-3">
            <input type="submit" name="addproduct" value="Add Product" class="form-control m-auto col-2 d-block btn btn-outline-white mt-2">
        </div>
    </div>
    </form>
</body>

</html>