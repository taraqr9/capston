<?php
include "init.php";
include "admin/product/splitfile/headerfile.php";

?>
<!-- Testing Purpuse -->


<html>

<head>
    <title>Home</title>
    <meta name="viewpost" content="width=device-width, initial-scale=1.0" />

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script>
</head>

<body>
    <!-- NOTE details about the color -->

    <!-- View Pending Events -->
    <div class="container-fluid">
        <div class="container">
            <table class="table table-hover border">
                <thead>
                    <tr>
                    <th class="col-1 border-right"></th>
                        <th class="col-1 border-right">Product Id</th>
                        <th class="col-1 border-right">Name</th>
                        <th class="col-1 border-right">QTY LEFT</th>
                        <th class="col-1 border-right">QTY ORDERED</th>
                        <th class="col-1 border-right">NEED QTY</th>
                        <th class="col-1 border-right">Price</th>
                        <th class="col-1 border-right">Category</th>
                        <th class="col-1 border-right">Sub Category</th>
                        <th class="col-1 border-right">Reason</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
//NOTE Low qty before 20th of this month
                    // NOTE Current season 
                    $date = date('M');
                    $month =  date('m', strtotime($date));
                    $mon = $source->Query("SELECT * FROM `month` where `id` = $month");
                    $row = $source->SingleRow();
                    $currentSeason = $row->season;
                    $currentMonth = $row->id;
                    $allproductid = [];

                    //NOTE Getting product from product table where qty lower than 15 and  date <=20
                    // FIXME change day(current_date)<=30 to 20;
                    $query = $source->Query("SELECT * FROM `products` where season = $currentSeason and qty <= '15' and day(current_date)<=30 ");
                    $lowqty = $source->FetchAll();
                    $numrow = $source->CountRows();
                    foreach ($lowqty as $row) :

                        // NOTE Next Month
                        if ($currentMonth != `12`) {
                            $nextMonth  = $currentMonth + 1;
                        } else {
                            $nextMonth = 1;
                        }
                        // NOTE next season
                        $mon = $source->Query("SELECT * FROM `month` where `id` = $nextMonth");
                        $nextS = $source->SingleRow();
                        $nextSeason = $nextS->season;


                        // NOTE CURRENT SEASON  == NEXT SEASON then product will come 60% of total order qty.
                        // else 20% of the total order of the product id
                        if ($currentSeason == $nextSeason) {
                            $query = $source->Query("SELECT pid,pname,sum(qty) as qtyy,price,category,sub_category  FROM `order` where pid = $row->id and month(date) = month(CURRENT_DATE) and year(date) = year(CURRENT_DATE)");
                            $featchRow = $source->SingleRow();

                            //NOTE 60% qty for product
                            $parcent = (int)(($featchRow->qtyy * 60) / 100);

                            echo "
                                    <tr>
                                    <td class='col-1 border-left border-right'> <img class='rounded m-1' style='height:60px;' src='assets/productsimg/" . $featchRow->pid . ".jpg' alt='Sample'></td>
                                    <td class='border-right'>" . $featchRow->pid . "</td>
                                    <td class='border-right'>" . $featchRow->pname . "</td>
                                    <td class='border-right'>" . $row->qty . "</td>
                                    <td class='border-right'>" . $featchRow->qtyy . "</td>
                                    <td class='border-right'>" . $parcent . "</td>
                                    <td class='border-right'>" . $row->price . "</td>
                                    <td class='border-right'>" . $featchRow->category . "</td>
                                    <td class='border-right'>" . $featchRow->sub_category . "</td>
                                    <td class='border-right col-1 bg-info'>Finished Before 20th</td>";
                            echo "
                                    </tr>";
                        } else {
                            $query = $source->Query("SELECT pid,pname,sum(qty) as qtyy,price,category,sub_category  FROM `order` where pid = $row->id and month(date) = month(CURRENT_DATE) and year(date) = year(CURRENT_DATE)");
                            $featchRow = $source->SingleRow();
                            $nummm = $source->CountRows();
                            echo $nummm;
                            echo $featchRow->pid;
                            //NOTE 20% qty for product
                            $parcent = (int)(($featchRow->qtyy * 20) / 100);
                            echo "
                                    <tr>
                                    <td class='col-1 border-left border-right'> <img class='rounded m-1' style='height:60px;' src='assets/productsimg/" . $featchRow->pid . ".jpg' alt='Sample'></td>
                                    <td class='border-right'>" . $featchRow->pid . "</td>
                                    <td class='border-right'>" . $featchRow->pname . "</td>
                                    <td class='border-right'>" . $row->qty . "</td>
                                    <td class='border-right'>" . $featchRow->qtyy . "</td>
                                    <td class='border-right'>" . $parcent . "</td>
                                    <td class='border-right'>" . $row->price . "</td>
                                    <td class='border-right'>" . $featchRow->category . "</td>
                                    <td class='border-right'>" . $featchRow->sub_category . "</td>
                                    <td class='border-right col-1 bg-info'>Finished Before 20th</td>";
                            echo "
                                    </tr>";
                        }
                        $allproductid[] = $row->id;

                    endforeach;
 //NOTE End of low qty before 20th of this month


//NOTE Getting product from product table where  date >=25
                    // FIXME change day 25;
                    $query = $source->Query("SELECT * FROM `products` where season = $currentSeason and day(current_date)>='25' ");
                    $season = $source->FetchAll();
                    $numrow = $source->CountRows();
                    foreach ($season as $row) {
                        if (!in_array($row->id, $allproductid)) {
                            // NOTE Next Month
                            if ($currentMonth != `12`) {
                                $nextMonth  = $currentMonth + 1;
                            } else {
                                $nextMonth = 1;
                            }
                            // NOTE next season
                            $mon = $source->Query("SELECT * FROM `month` where `id` = $nextMonth");
                            $nextS = $source->SingleRow();
                            $nextSeason = $nextS->season;

                            //NOTE product table ar product ar qty
                            $productid = $source->Query("SELECT * FROM `products` where `id` = $row->id");
                            $pqty = $source->SingleRow();
                            $productqty = $pqty->qty;
                            // FIXME 
                            if ($currentSeason == $nextSeason) {
                                $query = $source->Query("SELECT pid,pname,sum(qty) as qtyy,price,category,sub_category  FROM `order` where pid = $row->id and month(date) = month(CURRENT_DATE) and year(date) = year(CURRENT_DATE)");
                                $featchRow = $source->SingleRow();

                                //NOTE 60% qty for product
                                $parcent60 = (int)(($featchRow->qtyy * 60) / 100);

                                if ($productqty <= $parcent60) {
                                    $addqty = $parcent60 - $productqty;
                                    echo "
                                    <tr>
                                    
                                    <td class='border-right'>" . $featchRow->pid . "</td>
                                    <td class='border-right'>" . $featchRow->pname . "</td>
                                    <td class='border-right'>" . $row->qty . "</td>
                                    <td class='border-right'>" . $featchRow->qtyy . "</td>
                                    <td class='border-right'>" . $addqty . "</td>
                                    <td class='border-right'>" . $featchRow->price . "</td>
                                    <td class='border-right'>" . $featchRow->category . "</td>
                                    <td class='border-right'>" . $featchRow->sub_category . "</td>
                                    <td class='border-right col-1 bg-dark text-white'>After 25</td>";
                                    echo "
                                    </tr>";
                                }
                            }
                        }
                    }
// End of currentSeason == NextSeason


                    //NOTE  currentseason != Next season  Then Select next season product from database
                    // NOTE Next Month
                    if ($currentMonth != `12`) {
                        $nextMonth  = $currentMonth + 1;
                        echo $nextMonth;
                    } else {
                        $nextMonth = 1;
                    }
                    // NOTE next season
                    $mon = $source->Query("SELECT * FROM `month` where `id` = $nextMonth");
                    $nextS = $source->SingleRow();
                    $nextSeason = $nextS->season;
                    // NOTE next season NAME
                    $mon = $source->Query("SELECT * FROM `season` where `id` = $nextMonth");
                    $nextS = $source->SingleRow();
                    $nextSeasonName = $nextS->season_name;
                    //FIXME $currentSeason == $nextSeason change to $currentSeason != $nextSeason
                    if($currentSeason == $nextSeason){
                        $query = $source->Query("SELECT * FROM `PRODUCTS` WHERE SEASON = $nextSeason");
                        $prodetails = $source->fetchAll();
    
                        foreach($prodetails as $pro):
                            if($pro->qty <100){
                                $qtyNeed = 100-$pro->qty;
                                echo "
                                <tr>
                                
                                <td class='border-right'>" . $pro->id . "</td>
                                <td class='border-right'>" . $pro->name . "</td>
                                <td class='border-right'>" . $pro->qty . "</td>
                                <td class='border-right bg-secondary text-white'>No Order Will Show Now</td>
                                <td class='border-right'>" . $qtyNeed . "</td>
                                <td class='border-right'>" . $pro->price . "</td>
                                <td class='border-right'>" . $pro->category . "</td>
                                <td class='border-right'>" . $pro->sub_category . "</td>
                                <td class='border-right'>" . $nextSeasonName . "</td>
                                <td class='border-right col-1 bg-secondary text-white'>After 25</td>";
                                echo "
                                </tr>";
                            }
                            
                        endforeach;
                    }
                    
                    //NOTE End of CurrentSeason != NextSeason 

                    ?>

                </tbody>

            </table>
        </div>
    </div>




</body>

</html>