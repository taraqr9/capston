<?php
include "../init.php";
include "headerfile.php";
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
<?php include 'splitfile/navbar.php' ?>

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
            $query = $source->Query("SELECT * FROM `order` where status='pending'");
            $details = $source->FetchAll();
            $numrow = $source->CountRows();
            if($numrow>0){
              foreach($details as $row):
                
            if($row->status==='Pending'){
              $app = "<a href='delete.php?deleteorder=".$row->oid."' class='btn btn-outline-danger mt-2'> Delete</a>";
              $approval_text="class = text-warning";
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
                <td>"."<a href='approvedsql.php?approval=".$row->oid."' class='btn btn-outline-success mt-2'> Approve</a>".$app." </td>
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