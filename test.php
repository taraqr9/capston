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
  <?php include 'admin/product/splitfile/navbar.php' ?>

  <div class="container text-success">
    <?php
    if (!empty($_SESSION['approve_user'])) {
      echo $_SESSION['approve_user'];
      $_SESSION['approve_user'] = "";
    }
    if (!empty($_SESSION['delete_order'])) {
      echo $_SESSION['delete_order'];
      $_SESSION['delete_order'] = "";
    }
    ?>
  </div>
  <!-- View Pending Events -->
  <div class="container-fluid">
    <div class="container">
      <table class="table table-hover border">
        <thead>
          <tr>

            <th class="col-1 border-right">Product Id</th>
            <th class="col-1 border-right">Name</th>
            <th class="col-1 border-right">QTY</th>
            <th class="col-1 border-right">Price</th>
          </tr>
        </thead>
        <tbody>

          <?php
          // NOTE Current season 
          $date = date('M');
          $month =  date('m', strtotime($date));
          $mon = $source->Query("SELECT * FROM `month` where `id` = $month");
          $row = $source->SingleRow();
          $currentSeason = $row->season;
          $currentMonth = $row->id;




          $query = $source->Query("SELECT * FROM `products` where season = $currentSeason and qty <= '15'");
          $lowqty = $source->FetchAll();
          $numrow = $source->CountRows();
          $allpid = [];
          if ($numrow > 0) {




            foreach ($lowqty as $row) :
              // NOTE Next season
              if ($currentMonth != `12`) {
                $nextMonth  = $currentMonth + 1;
              } else {
                $nextMonth = 1;
              }
              $mon = $source->Query("SELECT * FROM `month` where `id` = $nextMonth");
              $nextS = $source->SingleRow();
              $nextSeason = $nextS->season;

              
              // NOTE CURRENT SEASON  == NEXT SEASON then product will come 60% of total order qty.
              // else 20% of the total order of the product id
              if ($currentSeason == $nextSeason && !in_array($check, $allpid)) {
                
                // FIXME Product er qty sum kore print korte hobe
                // FIXME jodi print hoy then oitake 60% korte hobe total sell qty er.
                
                // $query = $source->Query("SELECT pid,oid,uid,date,pname,sum(qty) as qtyy,price,category,sub_category  FROM `order` where pid = $row->id");
                // $featchRow = $source->SingleRow();
                
                // echo "
                // <tr>
                // <td class='border-right'>" . $featchRow->pid . "</td>
                // <td class='border-right'>" . $featchRow->pname . "</td>
                // <td class='border-right'>" . $featchRow->qqty . "</td>
                // <td class='border-right'>" . $featchRow->oid . "</td>";
                // echo "
                // </tr>";
              } else {
              }

            $allpid[] = $check;

            endforeach;
          }

          ?>
        </tbody>
      </table>
    </div>
  </div>




</body>

</html>