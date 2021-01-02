<?php
include "../init.php";
if (isset($_POST['admin'])) {
    header("location:admin.php");
}
if (isset($_POST['users'])) {
    header("location:users.php");
}
if (isset($_POST['approved'])) {
    header("location:approved.php");
}
if (isset($_POST['pending'])) {
    header("location:pending.php");
}

?>



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
    <div class="container-fluid sticky-top">
        <div class="row bg-light">
            <h1 class="text-info col-6 text-center m-auto">ADMIN PANEL</h1>
            <div class="col-6 text-center ml-auto mt-2">
                <form action="" method="POST">
                    <input type="submit" value="Admins" name="admin" class="btn btn-outline-info mr-2" />

                    <input type="submit" value="Users" name="users" class="btn btn-outline-info mr-2" />

                    <input type="submit" value="Approved" name="approved" class="btn btn-outline-info mr-2" />

                    <input type="submit" value="Pending" name="pending" class="btn btn-outline-info mr-2" />

                    <a href="logout.php" class="btn btn-outline-info mr-2">Logout</a>
                </form>
            </div>
        </div>
    </div>

<div class="container text-success">
    <?php 
        if(!empty($_SESSION['pending_user'])){
            echo $_SESSION['pending_user'];
            $_SESSION['pending_user'] = "";
        }
    ?>
</div>
    <!-- View Pending Events -->
<div class="container-fluid">
    <div class="container">
      <table class="table table-hover">
        <thead>
          <tr>
          
            <th class="col-1">Title</th>
            <th class="col-1">Date To</th>
            <th class="col-1">Date Form</th>
            <th class="col-1">Time To</th>
            <th class="col-1">Time Form</th>
            <th class="col-1">Decoration</th>
            <th class="col-1">Chair</th>
            <th class="col-1">Food</th>
            <th class="col-1">Food Platter</th>
            <th class="col-1">Address</th>
            <th class="col-1">Mobile</th>
            <th class="col-1">Email</th>
            <th class="col-1">Approval</th>
          </tr>
        </thead>
        <tbody>
          <?php
            $query = $source->Query("SELECT * FROM event where approval='pending'");
            $details = $source->FetchAll();
            $numrow = $source->CountRows();
            if($numrow>0){
              foreach($details as $row):
                
            if($row->approval==='Pending'){
              $app = "<a href='delete.php?delete=".$row->id."' class='btn btn-outline-danger mt-2'> Delete</a>";
              $approval_text="class = text-warning";
            }elseif($row->approval==='Canceled'){
                $approval_text="class = text-danger";
            }else{
              $app = "";
              $approval_text="class = text-success text-uppercase";
            }



                echo "
                <tr>
                
                <td>".$row->title."</td>
                <td>".$row->dateto."</td>
                <td>".$row->dateform."</td>
                <td>".$row->timeto."</td>
                <td>".$row->timeform."</td>
                <td>".$row->decoration."</td>
                <td>".$row->chair."</td>
                <td>".$row->food."</td>
                <td>".$row->foodplatter."</td>
                <td>".$row->address."</td>
                <td>".$row->mobile."</td>
                <td>".$row->email."</td>
                <td ".$approval_text.">".$row->approval."</td>
                <td>"."<a href='approvedsql.php?approval=".$row->id."' class='btn btn-outline-success mt-2'> Approve</a>".$app." </td>
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