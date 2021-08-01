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
                            <input type="submit" value="BacK" name="back" class="btn btn-outline-danger">
                        </div>
                        <div class="mr-2">
                            <input type="submit" value="Before 20" name="before20" class="btn btn-outline-info" >
                        </div>
                        <div class="mr-2">
                            <input type="submit" value="On 25 TO 28" name="on25" class="btn btn-outline-info">
                        </div>
                        <div class="mr-2">
                            <input type="submit" value="NEXT SEASON" name="nextseason" class="btn btn-outline-info">
                        </div>
                        <div class="mr-2">
                            <input type="submit" value="ALL SEASON" name="allseason" class="btn btn-outline-info">
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

    echo "
    <div class='alert'>
        <span class='closebtn ' onclick='this.parentElement.style.display='none';'>&times;</span><span class = 'h5'>Products that have expired before the 20th of this month </span>
    </div>
    ";
    echo "<thead>
                        <tr>
                            <th class='col-1 border-left border'></th>
                            <th class='col-1 border'>PID</th>
                            <th class='col-1 border'>Name</th>
                            <th class='col-1 border'>QTY LEFT</th>
                            <th class='col-1 border'>QTY ORDERED</th>
                            <th class='col-1 border'>QTY NEED</th>
                            <th class='col-1 border'>PRICE</th>
                            <th class='col-1 border'>CATEGORY</th>
                            <th class='col-1 border'>SUB CATEGORY</th>
                            <th class='col-1 border bg-info text-white'>REASON</th>
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
                    $query = $source->Query("SELECT * FROM `products` where season = $currentSeason and qty <= '15' and day(current_date)<=20 ");
                    $lowqty = $source->FetchAll();
                    $numrow = $source->CountRows();
                    foreach ($lowqty as $row) :
                        // NOTE Next Month
                        if ($currentMonth == `12`) {
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
                        $testid = $source->Query("SELECT *  FROM `order` where pid = $row->id and month(date) = month(CURRENT_DATE) and year(date) = year(CURRENT_DATE)");
                        $getRow = $source->SingleRow();
                        $rownumm = $source->CountRows();
                        if ($currentSeason == $nextSeason && $rownumm>0) {
                            $query = $source->Query("SELECT pid,pname,sum(qty) as qtyy,price,category,sub_category  FROM `order` where pid = $row->id and month(date) = month(CURRENT_DATE) and year(date) = year(CURRENT_DATE)");
                            $featchRow = $source->SingleRow();

                            //NOTE 60% qty for product
                            $parcent = (int)(($featchRow->qtyy * 60) / 100);

                            echo "
                <tr>
                <td class='col-1 border-left border'> <img class='rounded m-1' style='height:60px;' src='../../assets/productsimg/" . $featchRow->pid . ".jpg' alt='Sample'></td>
                <td class='border'>" . $featchRow->pid . "</td>
                <td class='border'>" . $featchRow->pname . "</td>
                <td class='border bg-warning'>" . $row->qty . "</td>
                <td class='border'>" . $featchRow->qtyy . "</td>
                <td class='border bg-info'>" . $parcent . "</td>
                <td class='border'>" . $row->price . "</td>
                <td class='border'>" . $featchRow->category . "</td>
                <td class='border'>" . $featchRow->sub_category . "</td>
                <td class='border col-1 bg-info text-white'>Finished Before 20th</td>";
                            echo "
                </tr>";
                        } 
                        elseif($currentSeason != $nextSeason && $rownumm>0)
                        //NOTE if qty>=15 && this qty id found on order table where ordered month is current month
                        {
                            $query = $source->Query("SELECT pid,pname,sum(qty) as qtyy,price,category,sub_category  FROM `order` where pid = $row->id and month(date) = month(CURRENT_DATE) and year(date) = year(CURRENT_DATE)");
                            $featchRow = $source->SingleRow();
                            
                            //NOTE 20% qty for product
                            $parcent = (int)(($featchRow->qtyy * 20) / 100);
                            echo "
                                <tr>
                                <td class='col-1 border-left border'> <img class='rounded m-1' style='height:60px;' src='../../assets/productsimg/" . $featchRow->pid . ".jpg' alt='Sample'></td>
                                <td class='border'>" . $featchRow->pid . "</td>
                                <td class='border'>" . $featchRow->pname . "</td>
                                <td class='border bg-warning'>" . $row->qty . "</td>
                                <td class='border'>" . $featchRow->qtyy . "</td>
                                <td class='border bg-info'>" . $parcent . "</td>
                                <td class='border'>" . $row->price . "</td>
                                <td class='border'>" . $featchRow->category . "</td>
                                <td class='border'>" . $featchRow->sub_category . "</td>
                                <td class='border col-1 bg-info text-white'>Finished Before 20th</td>";
                                            echo "
                                </tr>";
                        }
                        $allproductid[] = $row->id;

                    endforeach;
 //NOTE End of low qty before 20th of this month
}

//NOTE Getting product from product table where  date >=25
elseif(isset($_POST['on25'])){
    echo "
    <div class='alert'>
        <span class='closebtn ' onclick='this.parentElement.style.display='none';'>&times;</span><span class = 'h5'>Those product need on next month</span>
    </div>
    ";
    echo "<thead>
                        <tr>
                            <th class='col-1 border'></th>
                            <th class='col-1 border'>PID</th>
                            <th class='col-1 border'>Name</th>
                            <th class='col-1 border'>QTY LEFT</th>
                            <th class='col-1 border'>QTY ORDERED</th>
                            <th class='col-1 border'>QTY NEED</th>
                            <th class='col-1 border'>PRICE</th>
                            <th class='col-1 border'>CATEGORY</th>
                            <th class='col-1 border'>SUB CATEGORY</th>
                            <th class='col-1 border bg-info text-white'>REASON</th>
                        </tr>
                    </thead>
                    ";
                    //NOTE data will show only 25,26,27,28
                    if(date('d') == 25 || date('d') == 26 || date('d') == 27 || date('d') == 28 || date('d') == 31){
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
                            if ($currentMonth == `12`) {
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
                            if ($currentSeason == $nextSeason) {
                                $query = $source->Query("SELECT pid,pname,sum(qty) as qtyy,price,category,sub_category  FROM `order` where pid = $row->id and month(date) = month(CURRENT_DATE) and year(date) = year(CURRENT_DATE)");
                                $featchRow = $source->SingleRow();

                                //NOTE 60% qty for product
                                $parcent60 = (int)(($featchRow->qtyy * 60) / 100);

                                if ($productqty <= $parcent60) {
                                    $addqty = $parcent60 - $productqty;
                                    echo "
                                    <tr>
                                    <td class='col-1 border-left border'> <img class='rounded m-1' style='height:60px;' src='../../assets/productsimg/" . $featchRow->pid . ".jpg' alt='Sample'></td>
                                    <td class='border'>" . $featchRow->pid . "</td>
                                    <td class='border'>" . $featchRow->pname . "</td>
                                    <td class='border'>" . $row->qty . "</td>
                                    <td class='border'>" . $featchRow->qtyy . "</td>
                                    <td class='border'>" . $addqty . "</td>
                                    <td class='border'>" . $row->price . "</td>
                                    <td class='border'>" . $featchRow->category . "</td>
                                    <td class='border'>" . $featchRow->sub_category . "</td>
                                    <td class='border col-1 bg-dark text-white'>After 25</td>";
                                    echo "
                                    </tr>";
                                }
                            }
                        }
                    }
                    }else{
                        echo "Data will show only 25,26,27,28";
                    }
                    
}

//NOTE  currentseason != Next season  Then Select next season product from database
elseif(isset($_POST['nextseason'])){
    echo "
    <div class='alert'>
        <span class='closebtn ' onclick='this.parentElement.style.display='none';'>&times;</span><span class = 'h5'>Products that need on next season</span>
    </div>
    ";
    echo "<thead>
                        <tr>
                            <th class='col-1 border'></th>
                            <th class='col-1 border'>PID</th>
                            <th class='col-1 border'>Name</th>
                            <th class='col-1 border'>QTY LEFT</th>
                            <th class='col-1 border'>QTY ORDERED</th>
                            <th class='col-1 border'>QTY NEED</th>
                            <th class='col-1 border'>PRICE</th>
                            <th class='col-1 border'>CATEGORY</th>
                            <th class='col-1 border'>SUB CATEGORY</th>
                            <th class='col-1 border'>SEASON</th>
                            <th class='col-1 border bg-info text-white'>REASON</th>
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
                    
                    $nextSeason = "";

                    //NOTE  currentseason != Next season  Then Select next season product from database
                    // NOTE Next Month
                    if ($currentMonth == `12`) {
                        $nextMonth  = $currentMonth + 1;
                    } else {
                        $nextMonth = 1;
                    }
                    // NOTE next season
                    $mon = $source->Query("SELECT * FROM `month` where `id` = $nextMonth");
                    $nextS = $source->SingleRow();
                    $nextSeason = $nextS->season;
                    
                    // NOTE next season NAME
                    
                    $mon = $source->Query("SELECT * FROM `season` where `id` = $nextSeason");
                    $nextS = $source->SingleRow();
                    $nextSeasonName = $nextS->season_name;
                    
                    if($currentSeason != $nextSeason){
                        $query = $source->Query("SELECT * FROM `PRODUCTS` WHERE `SEASON` = $nextSeason");
                        $prodetails = $source->fetchAll();

                        foreach($prodetails as $pro):
                            
                            if($pro->qty <25){
                                $qtyNeed = 25-$pro->qty;
                                echo "
                                <tr>
                                <td class='col-1 border'> <img class='rounded m-1' style='height:60px;' src='../../assets/productsimg/" . $pro->id . ".jpg' alt='Sample'></td>
                                <td class='border'>" . $pro->id . "</td>
                                <td class='border'>" . $pro->name . "</td>
                                <td class='border'>" . $pro->qty . "</td>
                                <td class='border bg-secondary text-white'>No Order Will Show Now</td>
                                <td class='border'>" . $qtyNeed . "</td>
                                <td class='border'>" . $pro->price . "</td>
                                <td class='border'>" . $pro->category . "</td>
                                <td class='border'>" . $pro->sub_category . "</td>
                                <td class='border'>" . $nextSeasonName . "</td>
                                <td class='border col-1 bg-secondary text-white'>After 25</td>";
                                echo "
                                </tr>";
                            }
                            
                        endforeach;
                    }
                    
                    //NOTE End of CurrentSeason != NextSeason 

}

//NOTE  All season
elseif(isset($_POST['allseason'])){
    echo "
    <div class='alert'>
        <span class='closebtn ' onclick='this.parentElement.style.display='none';'>&times;</span><span class = 'h5'>All season prodcuts </span>
    </div>
    ";
    echo "<thead>
                        <tr>
                            <th class='col-1 border'></th>
                            <th class='col-1 border'>PID</th>
                            <th class='col-1 border'>Name</th>
                            <th class='col-1 border'>QTY LEFT</th>
                            <th class='col-1 border'>QTY ORDERED</th>
                            <th class='col-1 border'>QTY NEED</th>
                            <th class='col-1 border'>PRICE</th>
                            <th class='col-1 border'>CATEGORY</th>
                            <th class='col-1 border'>SUB CATEGORY</th>
                            <th class='col-1 border'>SEASON</th>
                            <th class='col-1 border bg-info text-white'>REASON</th>
                        </tr>
                    </thead>
                    ";

//NOTE QTY<15
                    $query = $source->Query("SELECT * FROM `products` where qty<=15 and season = '1'");
                    $allseason = $source->FetchAll();
                    $allproductid = [];
                    foreach($allseason as $row){
                        $query = $source->Query("SELECT pid,pname,sum(qty) as qtyy,price,category,sub_category  FROM `order` where pid = $row->id and month(date) = month(CURRENT_DATE) and year(date) = year(CURRENT_DATE)");
                        $featchRow = $source->SingleRow();

                        //NOTE checking product sold on this month or not 
                        $testid = $source->Query("SELECT *  FROM `order` where pid = $row->id and month(date) = month(CURRENT_DATE) and year(date) = year(CURRENT_DATE)");
                        $getRow = $source->SingleRow();
                        $rownumm = $source->CountRows();

                        //NOTE if sold then
                        if($rownumm>0 && !in_array($row->id,$allproductid)){
                            $category = $source->Query("SELECT * FROM `product_categories` where id = $row->category");
                            $cate = $source->SingleRow();
                            $cateName = $cate->categories;
    
                            $category1 = $source->Query("SELECT * FROM `product_categories` where id = $row->sub_category");
                            $cate1 = $source->SingleRow();
                            $subCateName = $cate1->categories;
    
                            $qtyneed = 40-$row->qty;
                                echo "
                                    <tr>
                                    <td class='col-1 border-left border'> <img class='rounded m-1' style='height:60px;' src='../../assets/productsimg/" . $featchRow->pid . ".jpg' alt='Sample'></td>
                                    <td class='border'>" . $featchRow->pid . "</td>
                                    <td class='border'>" . $featchRow->pname . "</td>
                                    <td class='border'>" . $row->qty . "</td>
                                    <td class='border'>" . $featchRow->qtyy . "</td>
                                    <td class='border bg-info'>" . $qtyneed . "</td>
                                    <td class='border'>" . $row->price . "</td>
                                    <td class='border'>" . $cateName . "</td>
                                    <td class='border'>" . $subCateName . "</td>
                                    <td class='border'>All Season</td>
                                    <td class='border col-1 bg-danger text-white'>Finished Before 20th</td>";
                                echo "
                                    </tr>";
                        }
                        $allproductid[] = $row->id;
                    }
//NOTE END OF LOW QTY


                    //NOTE data will show only 25,26,27,28
                    if(date('d') == 25 || date('d') == 26 || date('d') == 27 || date('d') == 28 ){
                        $query = $source->Query("SELECT * FROM `products` where season = '1'");
                        $allseason = $source->FetchAll();

                        foreach($allseason as $row){
                            if(!in_array($row->id,$allproductid)){
                                $query = $source->Query("SELECT pid,pname,sum(qty) as qtyy,price,category,sub_category  FROM `order` where pid = $row->id and month(date) = month(CURRENT_DATE) and year(date) = year(CURRENT_DATE)");
                                $featchRow = $source->SingleRow();

                                //NOTE checking product sold on this month or not 
                                $testid = $source->Query("SELECT *  FROM `order` where pid = $row->id and month(date) = month(CURRENT_DATE) and year(date) = year(CURRENT_DATE)");
                                $getRow = $source->SingleRow();
                                $rownumm = $source->CountRows();

                            if($rownumm>0){
                                $category = $source->Query("SELECT * FROM `product_categories` where id = $row->category");
                                $cate = $source->SingleRow();
                                $cateName = $cate->categories;
        
                                $category1 = $source->Query("SELECT * FROM `product_categories` where id = $row->sub_category");
                                $cate1 = $source->SingleRow();
                                $subCateName = $cate1->categories;
                                
                                //NOTE if sell low then demand qty low
                                if($featchRow->qtyy >=70){
                                    $qtyneed = 60;
                                }elseif($featchRow->qtyy >=50){
                                    $qtyneed = 40;
                                }elseif($featchRow->qtyy >=30){
                                    $qtyneed = 20;
                                }elseif($featchRow->qtyy <=15){
                                    $qtyneed = "<p class='text-danger'>Low Sell</p>";
                                }
                                
                                    echo "
                                        <tr>
                                        <td class='col-1 border-left border'> <img class='rounded m-1' style='height:60px;' src='../../assets/productsimg/" . $featchRow->pid . ".jpg' alt='Sample'></td>
                                        <td class='border'>" . $featchRow->pid . "</td>
                                        <td class='border'>" . $featchRow->pname . "</td>
                                        <td class='border'>" . $row->qty . "</td>
                                        <td class='border'>" . $featchRow->qtyy . "</td>
                                        <td class='border bg-info'>" . $qtyneed . "</td>
                                        <td class='border'>" . $row->price . "</td>
                                        <td class='border'>" . $cateName . "</td>
                                        <td class='border'>" . $subCateName . "</td>
                                        <td class='border'>All Season</td>
                                        <td class='border col-1 bg-info text-white'>Next Month</td>";
                                    echo "
                                        </tr>";
                            }
                            }
                        }
                    }else{
                        echo " 
                    <div class='alert'>
                        <span class='closebtn ' onclick='this.parentElement.style.display='none';'>&times;</span> 
                        <strong class = 'h4'>Info!</strong> <span class = 'h5'>Other item will show on 25 to 28 of this month.</span>
                    </div>
                    ";
                    }
        }
else{
    //NOTE  before day of 20th code repeat
    //NOTE Low qty before 20th of this month

    echo "<thead>
                        <tr>
                            <th class='col-1 border-left border'></th>
                            <th class='col-1 border'>PID</th>
                            <th class='col-1 border'>Name</th>
                            <th class='col-1 border'>QTY LEFT</th>
                            <th class='col-1 border'>QTY ORDERED</th>
                            <th class='col-1 border'>QTY NEED</th>
                            <th class='col-1 border'>PRICE</th>
                            <th class='col-1 border'>CATEGORY</th>
                            <th class='col-1 border'>SUB CATEGORY</th>
                            <th class='col-1 border bg-info text-white'>REASON</th>
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
                    $query = $source->Query("SELECT * FROM `products` where season = $currentSeason and qty <= '15' and day(current_date)<=20 ");
                    $lowqty = $source->FetchAll();
                    $numrow = $source->CountRows();
                    foreach ($lowqty as $row) :
                        // NOTE Next Month
                        if ($currentMonth == `12`) {
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
                        $testid = $source->Query("SELECT *  FROM `order` where pid = $row->id and month(date) = month(CURRENT_DATE) and year(date) = year(CURRENT_DATE)");
                        $getRow = $source->SingleRow();
                        $rownumm = $source->CountRows();
                        if ($currentSeason == $nextSeason && $rownumm>0) {
                            $query = $source->Query("SELECT pid,pname,sum(qty) as qtyy,price,category,sub_category  FROM `order` where pid = $row->id and month(date) = month(CURRENT_DATE) and year(date) = year(CURRENT_DATE)");
                            $featchRow = $source->SingleRow();

                            //NOTE 60% qty for product
                            $parcent = (int)(($featchRow->qtyy * 60) / 100);

                            echo "
                <tr>
                <td class='col-1 border-left border'> <img class='rounded m-1' style='height:60px;' src='../../assets/productsimg/" . $featchRow->pid . ".jpg' alt='Sample'></td>
                <td class='border'>" . $featchRow->pid . "</td>
                <td class='border'>" . $featchRow->pname . "</td>
                <td class='border'>" . $row->qty . "</td>
                <td class='border'>" . $featchRow->qtyy . "</td>
                <td class='border'>" . $parcent . "</td>
                <td class='border'>" . $row->price . "</td>
                <td class='border'>" . $featchRow->category . "</td>
                <td class='border'>" . $featchRow->sub_category . "</td>
                <td class='border col-1 bg-info text-white'>Finished Before 20th</td>";
                            echo "
                </tr>";
                        } 
                        elseif($currentSeason != $nextSeason && $rownumm>0)
                        //NOTE if qty>=15 && this qty id found on order table where ordered month is current month
                        {
                            $query = $source->Query("SELECT pid,pname,sum(qty) as qtyy,price,category,sub_category  FROM `order` where pid = $row->id and month(date) = month(CURRENT_DATE) and year(date) = year(CURRENT_DATE)");
                            $featchRow = $source->SingleRow();
                            
                            //NOTE 20% qty for product
                            $parcent = (int)(($featchRow->qtyy * 20) / 100);
                            echo "
                                <tr>
                                <td class='col-1 border-left border'> <img class='rounded m-1' style='height:60px;' src='../../assets/productsimg/" . $featchRow->pid . ".jpg' alt='Sample'></td>
                                <td class='border'>" . $featchRow->pid . "</td>
                                <td class='border'>" . $featchRow->pname . "</td>
                                <td class='border'>" . $row->qty . "</td>
                                <td class='border'>" . $featchRow->qtyy . "</td>
                                <td class='border'>" . $parcent . "</td>
                                <td class='border'>" . $row->price . "</td>
                                <td class='border'>" . $featchRow->category . "</td>
                                <td class='border'>" . $featchRow->sub_category . "</td>
                                <td class='border col-1 bg-info text-white'>Finished Before 20th</td>";
                                            echo "
                                </tr>";
                        }
                        $allproductid[] = $row->id;

                    endforeach;
 //NOTE End of low qty before 20th of this month
}

?>


</body>
</html>
