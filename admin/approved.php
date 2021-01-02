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
        if(!empty($_SESSION['approve_user'])){
            echo $_SESSION['approve_user'];
            $_SESSION['approve_user'] = "";
        }
        if(!empty($_SESSION['delete_order'])){
          echo $_SESSION['delete_order'];
          $_SESSION['delete_order'] = "";
      }
    ?>
</div>
    <!-- View Pending Events -->
<div class="container-fluid">
    <div class="container">
      <table class="table table-hover border-left border-right border-bottom">
        <thead>
          <tr>
          
            <th class="col-1">Order Id</th>
            <th class="col-1">Product Id</th>
            <th class="col-1">User Id</th>
            <th class="col-1">QTY</th>
            <th class="col-1">Size</th>
            <th class="col-1">Price</th>
            <th class="col-1">Name</th>
            <th class="col-1">Address</th>
            <th class="col-1">Phone</th>
            <th class="col-1">Email</th>
            <th class="col-1">Approval</th>
          </tr>
        </thead>
        <tbody>
          <?php
            $query = $source->Query("SELECT * FROM `order` where status='Approved'");
            $details = $source->FetchAll();
            $numrow = $source->CountRows();
            if($numrow>0){
              foreach($details as $row):
                
            if($row->status==='Approved'){
              $app = "<a href='delete.php?deleteorder=".$row->oid."' class='btn btn-outline-danger mt-2'> Delete</a>";
              $approval_text="class = text-info";
            }elseif($row->status==='Canceled'){
                $approval_text="class = text-danger";
            }else{
              $app = "";
              $approval_text="class = text-success text-uppercase";
            }



                echo "
                <tr>
                
                <td class='border-right'>".$row->oid."</td>
                <td>".$row->pid."</td>
                <td>".$row->uid."</td>
                <td>".$row->qty."</td>";
                if(!empty($row->size)){
                  echo "<td>".$row->size."</td>";
                }else{
                  echo "<td class='text-danger
                  '>Null</td>";
                }
                echo "
                <td>".$row->price."</td>
                <td>".$row->name."</td>
                <td>".$row->address."</td>
                <td>".$row->phone."</td>
                <td>".$row->email."</td>
                <td ".$approval_text.">".$row->status."</td>
                <td>"."<a href='pendingsql.php?pending=".$row->oid."' class='btn btn-outline-warning text-warning mt-2'> Pending</a>".$app." </td>
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