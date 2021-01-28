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
  <!-- navbar -->

  <!-- View Pending Events -->
  <div class="container-fluid">
    <div class="container">
      <table class="table table-hover border">
        <thead>
          <tr>
            <th class="col-1 border-right">Product Id</th>
            <th class="col-1 border-right">Name</th>
            <th class="col-1 border-right">QTY</th>
            <th class="col-1 border-right">NEED QTY</th>
            <th class="col-1 border-right">Price</th>
            <th class="col-1 border-right">Category</th>
            <th class="col-1 border-right">Sub Category</th>
          </tr>
        </thead>
        
          <?php
          // NOTE Current season 
          $date = date('M');
          $month =  date('m', strtotime($date));
          $mon = $source->Query("SELECT * FROM `month` where `id` = $month");
          $row = $source->SingleRow();
          $currentSeason = $row->season;
          $currentMonth = $row->id;

          //NOTE Getting product from product table where qty lower than 15
          $query = $source->Query("SELECT * FROM `products` where season = $currentSeason and qty <= '15' and day(current_date)<=30");
          $lowqty = $source->FetchAll();
          $numrow = $source->CountRows();
          echo $numrow;
            foreach ($lowqty as $row) :
              echo "<tbody>";
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

              $productid = $row->id;

              // NOTE CURRENT SEASON  == NEXT SEASON then product will come 60% of total order qty.
              // else 20% of the total order of the product id
              if ($currentSeason == $nextSeason) {
                $query = $source->Query("SELECT pid,pname,sum(qty) as qtyy,price,category,sub_category  FROM `order` where pid = $row->id and month(date) = month(CURRENT_DATE) and year(date) = year(CURRENT_DATE)");
                $featchRow = $source->SingleRow();

                //NOTE 60% qty for product
                $parcent = (int)(($featchRow->qtyy * 60) / 100);

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
                </tr></tbody>";
              }
              echo $row->id."<br>";
            endforeach;
          ?>
        
      </table>
    </div>
  </div>




</body>

</html>