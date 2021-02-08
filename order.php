<?php
include "init.php";
if (empty($_SESSION['login_success'])) {
  header("location:index.php");
}

$query = $source->Query("SELECT * FROM `order` WHERE uid like ? ORDER BY oid DESC", [$_SESSION['id']]);
$details = $source->FetchAll();
$numrow = $source->CountRows();
?>

<html>

<head>
  <title>Order</title>
  <?php include 'assets/splitfile/linkfiles.html'; ?>
</head>

<body>
  <!-- Navbar -->
  <?php include "assets/splitfile/header.php" ?>

  <!-- view events -->
  <div class="container-fluid ">
    <div class="container ">
      <table class="table table-hover mt-4">
        <thead>
          <tr>
            <th class="col-1 border"></th>
            <th class="col-1 border">Product Name</th>
            <th class="col-1 border">QTY</th>
            <th class="col-1 border">Size</th>
            <th class="col-1 border">Price</th>
            <th class="col-1 border">Customer Name</th>
            <th class="col-1 border">Email</th>
            <th class="col-1 border">Phone</th>
            <th class="col-1 border">Address</th>
            <th class="col-1 border">Status</th>
            <th class="col-1 border"></th>
          </tr>
        </thead>
        <tbody>
          <?php
          if ($numrow > 0) {

            foreach ($details as $row) :

              if ($row->status === 'Pending') {
                $app = "<a href='php/delete.php?delete=" . $row->oid . "' class='btn btn-outline-dark mt-2'> Delete</a>";
                $approval_text = "text-warning";
              } else {
                $app = "";
                $approval_text = "text-success text-uppercase";
              }
              // NOTE if there have size then show else show null
              if(!empty($row->size)){
                $size = $row->size;
              }else{
                $size = "Null";
              }
              echo "
              <tr>
              <td class='border'><img src='assets/productsimg/" . $row->pid . ".jpg' class='w-100'> </td>
              <td class='border'>" . $row->pname . "</td>
              <td class='border'>" . $row->qty . "</td>
              <td class='border'>" . $size . "</td>
              <td class='border'>" . $row->price . "</td>
              <td class='border'>" . $row->name . "</td>
              <td class='border'>" . $row->email . "</td>
              <td class='border'>" . $row->phone . "</td>
              <td class='border'>" . $row->address . "</td>
              <td class='border " . $approval_text . "'>" . $row->status . "</td>
              <td class='border'>" . $app . " </td>
              </tr>";
            endforeach;

            // if($row->status==='Pending'){
            //   $app = "<a href='delete.php?delete=".$row->id."' class='btn btn-outline-dark mt-2'> Delete</a>";
            //   $approval_text="class = text-warning";
            // }else{
            //   $app = "";
            //   $approval_text="class = text-success text-uppercase";
            // }


          }
          ?>
        </tbody>
      </table>
    </div>
  </div>

</body>

</html>