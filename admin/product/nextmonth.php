<?php
include '../../init.php';
include 'splitfile/headerfile.php'; 
if(isset($_POST['back'])){
    header("location:allsell.php");
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

<!-- All Sell lists -->
<div class="container">
    <form action="" method="POST">
        <div class="container-fluid">
            <div class="row bg-light">
                <div class="m-2 container ml-lg-auto">
                    <!-- category Dropdownlist -->
                    <div class="row">
                        <div class="mr-2">
                            <input type="submit" value="BacK" name="back" class="btn btn-outline-danger">
                        </div>
                        <!-- men -->
                        <div class="mr-2">
                            <input type="submit" value="Before 20" name="before20" class="btn btn-outline-info">
                        </div>
                        <div class="mr-2">
                            <input type="submit" value="On 25 TO 28" name="on25" class="btn btn-outline-info">
                        </div>
                        <div class="mr-2">
                            <input type="submit" value="FOR NEW SEASON" name="nextseason" class="btn btn-outline-info">
                        </div>
                    </div>
                </div>
            </div>
        </div>

</div>

<div class="container-fluid">
        <div class="container ">
            <table class="table table-hover ">
                <tbody>


<?php
if(isset($_POST['before20'])){
    //NOTE Low qty before 20th of this month

    echo "<thead>
                        <tr>
                            <th class='col-1 border-left border-right'></th>
                            <th class='col-1 border-right'>PID</th>
                            <th class='col-1 border-right'>Name</th>
                            <th class='col-1 border-right'>QTY LEFT</th>
                            <th class='col-1 border-right'>QTY ORDERED</th>
                            <th class='col-1 border-right'>QTY NEED</th>
                            <th class='col-1 border-right'>PRICE</th>
                            <th class='col-1 border-right'>CATEGORY</th>
                            <th class='col-1 border-right'>SUB CATEGORY</th>
                            <th class='col-1 border-right bg-info'>REASON</th>
                        </tr>
                    </thead>
                    ";
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
                <td class='col-1 border-left border-right'> <img class='rounded m-1' style='height:60px;' src='../../assets/productsimg/" . $featchRow->pid . ".jpg' alt='Sample'></td>
                <td class='border-right'>" . $featchRow->pid . "</td>
                <td class='border-right'>" . $featchRow->pname . "</td>
                <td class='border-right'>" . $row->qty . "</td>
                <td class='border-right'>" . $featchRow->qtyy . "</td>
                <td class='border-right'>" . $parcent . "</td>
                <td class='border-right'>" . $featchRow->price . "</td>
                <td class='border-right'>" . $featchRow->category . "</td>
                <td class='border-right'>" . $featchRow->sub_category . "</td>
                <td class='border-right col-1 bg-info text-white'>Finished Before 20th</td>";
                            echo "
                </tr>";
                        } else {
                            $query = $source->Query("SELECT pid,pname,sum(qty) as qtyy,price,category,sub_category  FROM `order` where pid = $row->id and month(date) = month(CURRENT_DATE) and year(date) = year(CURRENT_DATE)");
                            $featchRow = $source->SingleRow();
                            //NOTE 20% qty for product
                            $parcent = (int)(($featchRow->qtyy * 20) / 100);
                            echo "
                <tr>
                <td class='border-right'>" . $featchRow->pid . "</td>
                <td class='border-right'>" . $featchRow->pname . "</td>
                <td class='border-right'>" . $featchRow->qtyy . "</td>
                <td class='border-right'>" . $parcent . "</td>
                <td class='border-right'>" . $featchRow->price . "</td>
                <td class='border-right'>" . $featchRow->category . "</td>
                <td class='border-right'>" . $featchRow->sub_category . "</td>";
                            echo "
                </tr>";
                        }
                        $allproductid[] = $row->id;

                    endforeach;
 //NOTE End of low qty before 20th of this month
}


if(isset($_POST['on25'])){
    //NOTE Low qty before 20th of this month

    echo "<thead>
                        <tr>
                            <th class='col-1 border-left border-right'></th>
                            <th class='col-1 border-right'>PID</th>
                            <th class='col-1 border-right'>Name</th>
                            <th class='col-1 border-right'>QTY LEFT</th>
                            <th class='col-1 border-right'>QTY ORDERED</th>
                            <th class='col-1 border-right'>QTY NEED</th>
                            <th class='col-1 border-right'>PRICE</th>
                            <th class='col-1 border-right'>CATEGORY</th>
                            <th class='col-1 border-right'>SUB CATEGORY</th>
                            <th class='col-1 border-right bg-secondary'>REASON</th>
                        </tr>
                    </thead>
                    ";

                    $date = date('M');
                    $month =  date('m', strtotime($date));
                    $mon = $source->Query("SELECT * FROM `month` where `id` = $month");
                    $row = $source->SingleRow();
                    $currentSeason = $row->season;
                    $currentMonth = $row->id;
                    $allproductid = [];

                    
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
                                    <td class='col-1 border-left border-right'> <img class='rounded m-1' style='height:60px;' src='../../assets/productsimg/" . $featchRow->pid . ".jpg' alt='Sample'></td>
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
}

if(isset($_POST['nextseason'])){
    //NOTE Low qty before 20th of this month

    echo "<thead>
                        <tr>
                            <th class='col-1 border-left border-right'></th>
                            <th class='col-1 border-right'>PID</th>
                            <th class='col-1 border-right'>Name</th>
                            <th class='col-1 border-right'>QTY LEFT</th>
                            <th class='col-1 border-right'>QTY ORDERED</th>
                            <th class='col-1 border-right'>QTY NEED</th>
                            <th class='col-1 border-right'>PRICE</th>
                            <th class='col-1 border-right'>CATEGORY</th>
                            <th class='col-1 border-right'>SUB CATEGORY</th>
                            <th class='col-1 border-right'>SEASON</th>
                            <th class='col-1 border-right bg-info'>REASON</th>
                        </tr>
                    </thead>
                    ";

                    $date = date('M');
                    $month =  date('m', strtotime($date));
                    $mon = $source->Query("SELECT * FROM `month` where `id` = $month");
                    $row = $source->SingleRow();
                    $currentSeason = $row->season;
                    $currentMonth = $row->id;
                    $allproductid = [];
    //NOTE  currentseason != Next season  Then Select next season product from database
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
                                <td class='col-1 border-left border-right'> <img class='rounded m-1' style='height:60px;' src='../../assets/productsimg/" . $pro->id . ".jpg' alt='Sample'></td>
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

}
?>


</body>
</html>
