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
          $query = $source->Query("SELECT * FROM `products` where season = '2'");
          $details = $source->FetchAll();
          $numrow = $source->CountRows();
          if ($numrow > 0) {
            foreach ($details as $row) :
              echo "
                <tr>
                <td class='border-right'>" . $row->id . "</td>
                <td class='border-right'>" . $row->name . "</td>
                <td class='border-right'>" . $row->qty . "</td>
                <td class='border-right'>" . $row->price . "</td>";
                echo"
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