<?php
include "../init.php";
include "headerfile.php";

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
  <?php include 'splitfile/navbar.php' ?>

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
  <div class="container-fluid mt-4">
    <div class="container">
      <table class="table table-hover border">
        <thead>
          <tr>
            <th class="col-1 border"></th>
            <th class="col-1 border">Order Id</th>
            <th class="col-1 border">Product Id</th>
            <th class="col-1 border">User Id</th>
            <th class="col-1 border">QTY</th>
            <th class="col-1 border">Size</th>
            <th class="col-1 border">Price</th>
            <th class="col-1 border">Name</th>
            <th class="col-1 border">Address</th>
            <th class="col-1 border">Phone</th>
            <th class="col-1 border">Email</th>
            <th class="col-1 border">Approval</th>
            <th class="col-1 border"></th>
          </tr>
        </thead>
        <tbody>
          <?php
          $query = $source->Query("SELECT * FROM `order` where status='Approved'");
          $details = $source->FetchAll();
          $numrow = $source->CountRows();
          if ($numrow > 0) {
            foreach ($details as $row) :
              //Checking super admin logged or not 
              if (!empty($_SESSION['admin_log'])) {
                if ($_SESSION['admin_log'] == '1') {
                  if ($row->status === 'Approved') {
                    $app =  "<td><a href='delete.php?deleteorder=" . $row->oid . "' class='btn btn-outline-danger mt-2'> Delete</a>
                    <a href='pendingsql.php?pending=" . $row->oid . "' class=' btn btn-outline-warning text-dark mt-2'> Pending</a>
                    </td>";
                    $approval_text = "class = text-info";
                  } elseif ($row->status === 'Canceled') {
                    $approval_text = "class = text-danger";
                  } else {
                    $app = "";
                    $approval_text = "class = text-success text-uppercase";
                  }
                }
              }else{
                if ($row->status === 'Approved') {
                  $approval_text = "class = text-info";
                } elseif ($row->status === 'Canceled') {
                  $approval_text = "class = text-danger";
                } else {
                  $approval_text = "class = text-success text-uppercase";
                }
              }



              echo "
                <tr>
                <td class='col-1 border-left border-right'> <img class='rounded m-1' style='height:60px;' src='../assets/productsimg/" . $row->pid . ".jpg' alt='Sample'></td>
                <td class='border-right'>" . $row->oid . "</td>
                <td class='border-right'>" . $row->pid . "</td>
                <td class='border-right'>" . $row->uid . "</td>
                <td class='border-right'>" . $row->qty . "</td>";
              if (!empty($row->size)) {
                echo "<td>" . $row->size . "</td>";
              } else {
                echo "<td class='text-danger
                  '>Null</td>";
              }
              echo "
                <td class='border-right'>" . $row->price . "</td>
                <td class='border-right'>" . $row->name . "</td>
                <td class='border-right'>" . $row->address . "</td>
                <td class='border-right'>" . $row->phone . "</td>
                <td class='border-right'>" . $row->email . "</td>
                <td class='border-right " . $approval_text . "'>" . $row->status . "
                ";
                if(!empty($app)){
                  echo $app;
                }

                

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