<?php
include 'init.php';
?>

<?php
// if (isset($_POST['allsell'])) {
//     // for all order
//     $query = $source->Query("SELECT * FROM `order`  order by pid asc");
//     $details = $source->FetchAll();
//     $numrow = $source->CountRows();
//     if ($numrow > 0) {
//         $b = "";
//         foreach ($details as $row) :
//             $query = $source->Query("SELECT DISTINCT(pid),oid,uid,date,pname,sum(qty) as qtyy,price,category,sub_category  FROM `order` where pid = ?", [$row->pid]);
//             $db = $source->SingleRow();
//             $check = $row->pid;
//             if ($check !== $b) {
//                 echo "
//                     <tr>
//                     <td class='col-1 border-left border-right'> <img class='rounded m-1' style='height:60px;' src='assets/productsimg/" . $row->pid . ".jpg' alt='Sample'></td>
//                     <td class='col-1 border-right'>" . $row->oid . "</td>
//                     <td class='col-1 border-right'>" . $row->pid . "</td>
//                     <td class='col-1 border-right'>" . $row->uid . "</td>
//                     <td class='col-1 border-right'>" . $row->date . "</td>
//                     <td class='col-1 border-right'>" . $row->pname . "</td>
//                     <td class='col-1 border-right'>" . $db->qtyy . "</td>
//                     <td class='col-1 border-right'>" . $row->price . "</td>
//                     <td class='col-1 border-right'>" . $row->category . "</td>
//                     <td class='col-1 border-right'>" . $row->sub_category . "</td>";
//                 if (!empty($_SESSION['admin_log'])) {
//                     if ($_SESSION['admin_log'] == '1') {
//                         echo "<td class='col-1 border-right'><a href='edit.php?approval=" . $row->oid . "' class='btn btn-outline-info m-auto'> Edit</a>
//       </td>";
//                     }
//                 }

//                 echo "
// </tr>";
//             }
//             $b = $check;
//         endforeach;
//     }
// }
// if (isset($_POST['mostsold'])) {
//     // for all order
//     $query = $source->Query("SELECT * FROM `order`  order by oid desc");
//     $details = $source->FetchAll();
//     $numrow = $source->CountRows();

//     if ($numrow > 0) {
//         $b = "";
//         foreach ($details as $row) :
//             $query = $source->Query("SELECT DISTINCT(pid),oid,uid,date,pname,sum(qty) as qtyy,price,category,sub_category  FROM `order` where pid = ?", [$row->pid]);
//             $db = $source->SingleRow();
//             $check = $row->pid;
//             if ($check !== $b) {
//                 echo "
//                     <tr>
//                     <td class='col-1 border-left border-right'> <img class='rounded m-1' style='height:60px;' src='assets/productsimg/" . $row->pid . ".jpg' alt='Sample'></td>
//                     <td class='col-1 border-right'>" . $row->oid . "</td>
//                     <td class='col-1 border-right'>" . $row->pid . "</td>
//                     <td class='col-1 border-right'>" . $row->uid . "</td>
//                     <td class='col-1 border-right'>" . $row->date . "</td>
//                     <td class='col-1 border-right'>" . $row->pname . "</td>
//                     <td class='col-1 border-right'>" . $db->qtyy . "</td>
//                     <td class='col-1 border-right'>" . $row->price . "</td>
//                     <td class='col-1 border-right'>" . $row->category . "</td>
//                     <td class='col-1 border-right'>" . $row->sub_category . "</td>";
//                 if (!empty($_SESSION['admin_log'])) {
//                     if ($_SESSION['admin_log'] == '1') {
//                         echo "<td class='col-1 border-right'><a href='edit.php?approval=" . $row->oid . "' class='btn btn-outline-info m-auto'> Edit</a>
//       </td>";
//                     }
//                 }

//                 echo "
// </tr>";
//             }
//             $b = $check;
//         endforeach;
//     }
// }
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
                            <div class="mr-2">
                                <input type="submit" value="Most Sold" name="mostsold" class="btn btn-outline-info">
                            </div>
                            <div class="mr-2">
                                <input type="submit" value="Low Quintaty" name="lowquintaty" class="btn btn-outline-info">
                            </div>
                            <div class="mr-2">
                                <input type="submit" value="Next Month Need" name="nmneed" class="btn btn-outline-info">
                            </div>
                            <div class="mr-2">
                                <input type="submit" value="Not Sold" name="notsold" class="btn btn-outline-info">
                            </div>
                            <div class="mr-2">
                                <input type="submit" value="Last Month" name="mostsold" class="btn btn-outline-info">
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
                
                    <?php


                    if (isset($_POST['notsold'])) {
                        //Taking product id from product table and product id from order table , if match then find last sold date , if not a quantity sold in last 30 day then show it.
                        echo "
                                <thead>
                                <tr>
                                    <th class='col-1 border-left border-right'></th>
                                    <th class='col-1 border-right'>S.ID</th>
                                    <th class='col-1 border-right'>PID</th>
                                    <th class='col-1 border-right'>Name</th>
                                    <th class='col-1 border-right'>Qty</th>
                                    <th class='col-1 border-right'>Price</th>
                                    <th class='col-1 border-right'>Category</th>
                                    <th class='col-1 border-right'>Sub Category</th>
                                    <th class='col-1 border-right'></th>
                                </tr>
                            </thead>
                            <tbody>
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
                        $squery = $source->Query("SELECT * FROM `product_categories` where id =  ?",[$product->sub_category]);
                        $sub_cate = $source->SingleRow();
                        

                            if (in_array($product->id, $proid) && !in_array($product->id, $checkone)) {
                                $query = $source->Query("SELECT pname,min(DATEDIFF(CURDATE(),date)) as dayy from `order` where pid = ?",[$product->id]);
                                $date = $source->SingleRow();

                                
                                echo "
                                    <tr>
                                    <td class='col-1 border-left border-right'> <img class='rounded m-1' style='height:60px;' src='assets/productsimg/" . $product->image . "' alt='Sample'></td>
                                    <td class='col-1 border-right'>" . $i++ . "</td>
                                    <td class='col-1 border-right'>" . $product->id . "</td>
                                    <td class='col-1 border-right'>" . $product->name . "</td>
                                    <td class='col-1 border-right bg-primary text-white'>" . $product->qty . "</td>
                                    <td class='col-1 border-right'>" . $product->price . "</td>
                                    <td class='col-1 border-right'>" . $catename . "</td>
                                    <td class='col-1 border-right'>" . $sub_cate->categories . "</td>";
                            if (!empty($_SESSION['admin_log'])) {
                                if ($_SESSION['admin_log'] == '1') {
                                    echo "<td class='col-1 border-right'><a href='#?approval=" . $product->id . "' class='btn btn-outline-info m-auto'> Edit</a> </td>";
                                }
                            }
                            }
                        endforeach;
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    </form>
</body>




</html>