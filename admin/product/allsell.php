<?php
include '../../init.php';
include 'splitfile/headerfile.php' ;
if(isset($_POST['nextmonth'])){
    header("location:nextmonth.php");
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

    <!-- Style for not sold page alert info -->
    <style>
        .alert {
            padding: 20px;
            background-color: #47A8F5;
            color: white;
        }

        .closebtn {
            margin-left: 15px;
            color: white;
            font-weight: bold;
            float: right;
            font-size: 30px;
            line-height: 20px;
            cursor: pointer;
            transition: 0.3s;
        }

        .closebtn:hover {
            color: black;
        }
    </style>

</head>

<body>

    <!-- navbar -->
    <?php include 'splitfile/navbar.php' ?>

    <!-- All Sell lists -->
    <div class="container">
        <form action="" method="POST">
            <div class="container-fluid">
                <div class="row bg-light">
                    <div class="m-2 container ml-lg-auto">
                        <!-- category Dropdownlist -->
                        <div class="row">
                            <div class="mr-2">
                                <input type="submit" value="All Sell" name="allsell" class="btn btn-outline-info">
                            </div>
                            <!-- men -->
                            <div class="mr-2">
                                <input type="submit" value="Most Sold" name="mostsold" class="btn btn-outline-info">
                            </div>
                            <div class="mr-2">
                                <input type="submit" value="Low Quintaty" name="lowquintaty" class="btn btn-outline-info">
                            </div>
                            <div class="mr-2">
                                <input type="submit" value="Next Month Need" name="nextmonth" class="btn btn-outline-danger">
                            </div>
                            <div class="mr-2">
                                <input type="submit" value="Not Sold" name="notsold" class="btn btn-outline-info">
                            </div>
                            <div class="mr-2">
                                <input type="submit" value="Last Month" name="lastmonth" class="btn btn-outline-info">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

    </div>

    

    <!-- show Products -->
    <div class="container-fluid">
        <div class="container ">
            <table class="table table-hover ">
                <tbody>
                    <?php

                    // Most sold
                    if (isset($_POST['mostsold'])) {
                        include "splitfile/tablehead.php";
                        $allpid = [];
                        $pidqty = [];
                        $query = $source->Query("SELECT * FROM `order`");
                        $details = $source->FetchAll();
                        $numrow = $source->CountRows();
                        $i = 1;
                        if ($numrow > 0) {
                            foreach ($details as $row) :
                                $query = $source->Query("SELECT pid,oid,uid,date,pname,sum(qty) as qtyy,price,category,sub_category  FROM `order` where pid = ?", [$row->pid]);

                                $db = $source->SingleRow();
                                $check = $row->pid;
                                if (!in_array($check, $allpid)) {
                                    $pidqty[] = array($row->pid, $db->qtyy);
                                }
                                $allpid[] = $check;
                            endforeach;
                        }

                        function build_sorter($key)
                        {
                            return function ($a, $b) use ($key) {
                                return strnatcmp($a[$key], $b[$key]);
                            };
                        }
                        usort($pidqty, build_sorter('1'));

                        foreach (array_reverse($pidqty) as $item) {
                            // echo $item['0'] . ', ' . $item['1'] . "<br>";
                            $query = $source->Query("SELECT * from `order` where pid = ? ", [$item[0]]);
                            $db = $source->SingleRow();

                            //cate name
                            $query = $source->Query("SELECT * FROM `product_categories` where id =  $db->category");
                            $cate = $source->SingleRow();
                            $catename = $cate->categories;
                            //sub cate name
                            $squery = $source->Query("SELECT * FROM `product_categories` where id =  $db->sub_category");
                            $sub_cate = $source->SingleRow();
                            $sub_catename = $sub_cate->categories;

                            echo "
                                    <tr class='col-1 border-left border-right border-bottom'>
                                    <td class='col-1 border-left border-right'> <img class='rounded m-1' style='height:60px;' src='../../assets/productsimg/" . $db->pid . ".jpg' alt='Sample'></td>
                                    <td class='col-1 border-right'>" . $i++ . "</td>
                                    <td class='col-1 border-right'>" . $item['0'] . "</td>
                                    <td class='col-1 border-right'>" . $db->date . "</td>
                                    <td class='col-1 border-right'>" . $db->pname . "</td>
                                    <td class='col-1 border-right bg-primary text-white'>" . $item['1'] . "</td>
                                    <td class='col-1 border-right'>" . $db->price . "</td>
                                    <td class='col-1 border-right'>" . $catename . "</td>
                                    <td class='col-1 border-right'>" . $sub_catename . "</td>";
                            if (!empty($_SESSION['admin_log'])) {
                                if ($_SESSION['admin_log'] == '1') {
                                    echo "<td class='col-1 border-right'><a href='#?approval=" . $row->oid . "' class='btn btn-outline-info m-auto'> Edit</a> </td>";
                                }
                            }

                            echo "</tr>";
                        }
                    }


                    //Low Quintaty
                    elseif (isset($_POST['lowquintaty'])) {
                        echo " 
                    <div class='alert'>
                        <span class='closebtn ' onclick='this.parentElement.style.display='none';'>&times;</span> 
                        <strong class = 'h4'>Info!</strong> <span class = 'h5'>Listed item showing less than 150 quantity.</span>
                    </div>
                    ";

                        echo "
                    <thead>
                        <tr>
                            <th class='col-1 border-left border-right'></th>
                            <th class='col-1 border-right'>ID</th>
                            <th class='col-1 border-right'>PID</th>
                            <th class='col-1 border-right'>Name</th>
                            <th class='col-1 border-right'>Qty</th>
                            <th class='col-1 border-right'>Price</th>
                            <th class='col-1 border-right'>Category</th>
                            <th class='col-1 border-right'>Sub Category</th>
                            ";
                        if (!empty($_SESSION['admin_log'])) {
                            if ($_SESSION['admin_log'] == '1') {
                                echo "<th class='col-1 border-right'></th>";
                            }
                        }
                        echo "
                        </tr>
                    </thead>";

                        $allpid = [];
                        $pidqty = [];
                        //qty declearing....
                        $query = $source->Query("SELECT * FROM `products` where qty<150");
                        $details = $source->FetchAll();
                        $numrow = $source->CountRows();
                        $i = 1;
                        if ($numrow > 0) {
                            foreach ($details as $row) :
                                $query = $source->Query("SELECT * FROM `product_categories` where id =  $row->category");
                                $cate = $source->SingleRow();
                                $catename = $cate->categories;

                                $squery = $source->Query("SELECT * FROM `product_categories` where id =  $row->sub_category");
                                $sub_cate = $source->SingleRow();
                                $sub_catename = $sub_cate->categories;
                                echo "
                                    <tr class='col-1 border-left border-right border-bottom'>
                                    <td class='col-1 border-left border-right'> <img class='rounded m-1' style='height:60px;' src='../../assets/productsimg/" . $row->image . "' alt='Sample'></td>
                                    <td class='col-1 border-right'>" . $i++ . "</td>
                                    <td class='col-1 border-right'>" . $row->id . "</td>
                                    <td class='col-1 border-right'>" . $row->name . "</td>
                                    <td class='col-1 border-right bg-primary text-white'>" . $row->qty . "</td>
                                    <td class='col-1 border-right'>" . $row->price . "</td>
                                    <td class='col-1 border-right'>" . $catename . "</td>
                                    <td class='col-1 border-right'>" . $sub_catename . "</td>";
                                if (!empty($_SESSION['admin_log'])) {
                                    if ($_SESSION['admin_log'] == '1') {
                                        echo "<td class='col-1 border-right'><a href='#?approval=" . $row->id . "' class='btn btn-outline-info m-auto'> Edit</a> </td>";
                                    }
                                }

                                echo "</tr>";
                            endforeach;
                        }
                    }

                    // Not Sold
                    elseif (isset($_POST['notsold'])) {
                        echo " 
                                <div class='alert'>
                                    <span class='closebtn ' onclick='this.parentElement.style.display='none';'>&times;</span> 
                                    <strong class = 'h4'>Info!</strong> <span class = 'h5'>Listed item not sold from last 10 days.</span>
                                </div>";

                        //Taking product id from product table and product id from order table , if match then find last sold date , if not a quantity sold in last 30 day then show it.
                        echo "
                    <thead>
                        <tr>
                            <th class='col-1 border-left border-right'></th>
                            <th class='col-1 border-right'>S.ID</th>
                            <th class='col-1 border-right'>PID</th>
                            <th class='col-1 border-right'>Name</th>
                            <th class='col-1 border-right'>Last Sell</th>
                            <th class='col-1 border-right'>Qty</th>
                            <th class='col-1 border-right'>Price</th>
                            <th class='col-1 border-right'>Category</th>
                            <th class='col-1 border-right'>Sub Category</th>";

                        if (!empty($_SESSION['admin_log'])) {
                            if ($_SESSION['admin_log'] == '1') {
                                echo "<th class='col-1 border-right'></th>";
                            }
                        }
                        echo "
                        </tr>
                    </thead>
                    ";



                        $products = $source->Query("SELECT * FROM `products`");
                        $products = $source->FetchAll();
                        $numrow = $source->CountRows();

                        $order = $source->Query("SELECT * FROM `order`");
                        $order = $source->FetchAll();
                        $proid = [];
                        $checkone = [];
                        $numrow1 = $source->CountRows();
                        $i = 1;


                        foreach ($order as $or) {
                            $proid[] = $or->pid;
                        }

                        foreach ($products as $product) :

                            //cate name
                            $query = $source->Query("SELECT * FROM `product_categories` where id =  $product->category");
                            $cate = $source->SingleRow();
                            $catename = $cate->categories;

                            //sub cate name
                            $squery = $source->Query("SELECT * FROM `product_categories` where id =  $product->sub_category");
                            $sub_cate = $source->SingleRow();

                            //Order Table last 10 days not sold items
                            if (in_array($product->id, $proid) && !in_array($product->id, $checkone)) {
                                $query = $source->Query("SELECT pname,min(DATEDIFF(CURDATE(),date)) as dayy from `order` where pid = ?", [$product->id]);
                                $date = $source->SingleRow();

                                //Number of day you want show from order table 
                                if ($date->dayy >= 10) {
                                    echo "
                                <tr class='col-1 border-left border-right border-bottom'>
                                <td class='col-1 border-left border-right'> <img class='rounded m-1' style='height:60px;' src='../../assets/productsimg/" . $product->image . "' alt='Sample'></td>
                                <td class='col-1 border-right'>" . $i++ . "</td>
                                <td class='col-1 border-right'>" . $product->id . "</td>
                                <td class='col-1 border-right'>" . $product->name . "</td>
                                <td class='col-1 border-right bg-primary text-white'>" . $date->dayy . " - Days Ago</td>
                                <td class='col-1 border-right bg-primary text-white'>" . $product->qty . "</td>
                                <td class='col-1 border-right'>" . $product->price . " - TK</td>
                                <td class='col-1 border-right'>" . $catename . "</td>
                                <td class='col-1 border-right'>" . $sub_cate->categories . "</td>";
                                    if (!empty($_SESSION['admin_log'])) {
                                        if ($_SESSION['admin_log'] == '1') {
                                            echo "<td class='col-1 border-right'><a href='#?approval=" . $product->id . "' class='btn btn-outline-info m-auto'> Edit</a> </td>";
                                        }
                                    }
                                    echo "</tr>";
                                }
                            }

                            //NOTE Product table last 10 days not sold items
                            if (!in_array($product->id, $proid)) {
                                $query = $source->Query("SELECT name,min(DATEDIFF(CURDATE(),date)) as dayy from `products` where id = ?", [$product->id]);
                                $date = $source->SingleRow();

                                //NOTE Number of day you want show from product table - 10days
                                if ($date->dayy >= 10) {
                                    echo "
                                <tr class='col-1 border-left border-right border-bottom'>
                                <td class='col-1 border-left border-right border-bottom'> <img class='rounded m-1' style='height:60px;' src='../../assets/productsimg/" . $product->image . "' alt='Sample'></td>
                                <td class='col-1 border-right'>" . $i++ . "</td>
                                <td class='col-1 border-right'>" . $product->id . "</td>
                                <td class='col-1 border-right'>" . $product->name . "</td>
                                <td class='col-1 border-right bg-primary text-white'>" . $date->dayy . " - Days Ago</td>
                                <td class='col-1 border-right bg-primary text-white'>" . $product->qty . "</td>
                                <td class='col-1 border-right'>" . $product->price . " - TK</td>
                                <td class='col-1 border-right'>" . $catename . "</td>
                                <td class='col-1 border-right'>" . $sub_cate->categories . "</td>";
                                    if (!empty($_SESSION['admin_log'])) {
                                        if ($_SESSION['admin_log'] == '1') {
                                            echo "<td class='col-1 border-right'><a href='#?approval=" . $product->id . "' class='btn btn-outline-info m-auto'> Edit</a> </td>";
                                        }
                                    }
                                    echo "</tr>";
                                }
                            }

                        endforeach;
                    }

                    //Last Month sold all item
                    elseif (isset($_POST['lastmonth'])) {
                        echo " 
                                <div class='alert'>
                                    <span class='closebtn ' onclick='this.parentElement.style.display='none';'>&times;</span> 
                                    <strong class = 'h4'>Info!</strong> <span class = 'h5'>Last month items sold listed.</span>
                                </div>
                    ";

                        include "splitfile/tablehead.php";
                        $i = 1;
                        $query = $source->Query("SELECT * FROM  `order` WHERE MONTH( DATE ) = MONTH( DATE_SUB(CURDATE(),INTERVAL 1 MONTH ))");
                        $details = $source->FetchAll();
                        $numrow = $source->CountRows();
                        $allpid = [];
                        foreach ($details as $row) {

                            //cate name
                            $query = $source->Query("SELECT * FROM `product_categories` where id =  $row->category");
                            $cate = $source->SingleRow();
                            $catename = $cate->categories;


                            //sub cate name
                            $squery = $source->Query("SELECT * FROM `product_categories` where id =  ?", [$row->sub_category]);
                            $sub_cate = $source->SingleRow();
                            $sub_catenamee = $sub_cate->categories;

                            echo "
                                            <tr class='col-1 border-left border-right border-bottom'>
                                            <td class='col-1 border-left border-right'> <img class='rounded m-1' style='height:60px;' src='../../assets/productsimg/" . $row->pid . ".jpg' alt='Sample'></td>
                                            <td class='col-1 border-right'>" . $i++ . "</td>
                                            <td class='col-1 border-right'>" . $row->pid . "</td>
                                            <td class='col-1 border-right'>" . $row->date . "</td>
                                            <td class='col-1 border-right'>" . $row->pname . "</td>
                                            <td class='col-1 border-right'>" . $row->qty . "</td>
                                            <td class='col-1 border-right'>" . $row->price . "</td>
                                            <td class='col-1 border-right'>" . $catename . "</td>
                                            <td class='col-1 border-right'>" . $sub_catenamee . "</td>";
                            if (!empty($_SESSION['admin_log'])) {
                                if ($_SESSION['admin_log'] == '1') {
                                    echo "<td class='col-1 border-right'><a href='#?approval=" . $row->oid . "' class='btn btn-outline-info m-auto'> Edit</a>
                                                                    </td>";
                                }
                            }

                            echo "</tr>";
                        }
                    }

                    //All sell
                    else {
                        include "splitfile/tablehead.php";
                        echo "<tbody>";
                        $allpid = [];
                        $query = $source->Query("SELECT * FROM `order`");
                        $details = $source->FetchAll();
                        $numrow = $source->CountRows();
                        $i = 1;
                        if ($numrow > 0) {
                            foreach ($details as $row) :
                                $query = $source->Query("SELECT pid,oid,uid,date,pname,sum(qty) as qtyy,price,category,sub_category  FROM `order` where pid = ? order by qty desc", [$row->pid]);
                                $db = $source->SingleRow();
                                $check = $row->pid;
                                if (!in_array($check, $allpid)) {
                                    //cate name
                                    $query = $source->Query("SELECT * FROM `product_categories` where id =  $row->category");
                                    $cate = $source->SingleRow();
                                    $catename = $cate->categories;
                                    //sub cate name
                                    $squery = $source->Query("SELECT * FROM `product_categories` where id =  $row->sub_category");
                                    $sub_cate = $source->SingleRow();
                                    $sub_catename = $sub_cate->categories;

                                    echo "
                                            <tr class='col-1 border-left border-right border-bottom'>
                                            <td class='col-1 border-left border-right'> <img class='rounded m-1' style='height:60px;' src='../../assets/productsimg/" . $row->pid . ".jpg' alt='Sample'></td>
                                            <td class='col-1 border-right'>" . $i++ . "</td>
                                            <td class='col-1 border-right'>" . $row->pid . "</td>
                                            <td class='col-1 border-right'>" . $row->date . "</td>
                                            <td class='col-1 border-right'>" . $row->pname . "</td>
                                            <td class='col-1 border-right'>" . $db->qtyy . "</td>
                                            <td class='col-1 border-right'>" . $row->price . "</td>
                                            <td class='col-1 border-right'>" . $catename . "</td>
                                            <td class='col-1 border-right'>" . $sub_catename . "</td>";
                                    if (!empty($_SESSION['admin_log'])) {
                                        if ($_SESSION['admin_log'] == '1') {
                                            echo "<td class='col-1 border-right'><a href='#?approval=" . $row->oid . "' class='btn btn-outline-info m-auto'> Edit</a>
                                                                    </td>";
                                        }
                                    }

                                    echo "</tr>";
                                }
                                $allpid[] = $check;
                            endforeach;
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    </form>
</body>

</html>