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
  <title>Create Event</title>
  <meta name="viewpost" content="width=device-width, initial-scale=1.0">
  <link href="assets/css/home.css?v=<?php echo time(); ?>" rel="stylesheet" type="text/css">


  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
  <script src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script>
</head>

<body>
  <!-- Navbar -->
  <nav class=" navbar navbar-expand-md navbar-light sticky-top">
    <div class="container">
      <h1 class="display-4 text-light"><a href="home.php" style="text-decoration: none; color: white;">DailyBazar</a></h1>

      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item mr-3 active">
            <a href="home.php" class="nav-link text-light">Home</a>
          </li>
          <li class="nav-item mr-3">
            <a href="#" class="nav-link text-light">Man</a>
          </li>
          <li class="nav-item mr-3">
            <a href="#" class="nav-link text-light">Women</a>
          </li>
          <li class="nav-item mr-3">
            <a href="#" class="nav-link text-light">Food</a>
          </li>
          <li class="nav-item mr-3">
            <a href="order.php" class="nav-link text-light">Order</a>
          </li>
          <li class="nav-item mr-3">
            <button class="btn nav-link bg-primary mt-2 text-light" data-toggle="collapse" data-target="#demo">
              <?php
              echo $_SESSION['login_success'];
              ?></button>
            <div id="demo" class="collapse mt-1">
              <a href="profile.php" class="h5 text-light link-unstyled">Profile</a>

              <a href="logout.php" class="h5 text-light text-decoration-none">Logout</a>
            </div>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- view events -->
  <div class="container-fluid">
    <div class="container">
      <table class="table table-hover">
        <thead>
          <tr>
          <th class="col-1"></th>
            <th class="col-1">Product Name</th>
            <th class="col-1">QTY</th>
            <th class="col-1">Size</th>
            <th class="col-1">Price</th>
            <th class="col-1">Customer Name</th>
            <th class="col-1">Email</th>
            <th class="col-1">Phone</th>
            <th class="col-1">Address</th>
            <th class="col-1">Status</th>
          </tr>
        </thead>
        <tbody>
          <?php
          if ($numrow > 0) {

            foreach ($details as $row) :

              if ($row->status === 'Pending') {
                $app = "<a href='php/delete.php?delete=" . $row->oid . "' class='btn btn-outline-dark mt-2'> Delete</a>";
                $approval_text = "class = text-warning";
              } else {
                $app = "";
                $approval_text = "class = text-success text-uppercase";
              }

              echo "
              <tr>
              <td><img src='assets/productsimg/".$row->pid.".jpg' class='w-100'> </td>
              <td>" . $row->pname . "</td>
              <td>" . $row->qty . "</td>
              <td>" . $row->size . "</td>
              <td>" . $row->price . "</td>
              <td>" . $row->name . "</td>
              <td>" . $row->email . "</td>
              <td>" . $row->phone . "</td>
              <td>" . $row->address . "</td>
              <td " . $approval_text . ">" . $row->status . "</td>
              <td>" . $app . " </td>
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