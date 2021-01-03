<?php
include "../init.php";

if(empty($_SESSION['email'])){
    header("location:index.php");
  }
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

if(isset($_POST['adduser'])){
    
    $data=[
        'name' => $_POST['name'],
        'email' => $_POST['email'],
        'password' => $_POST['password'],
        'phone' => $_POST['phone'],
        'address' => $_POST['address'],
        'gender' => $_POST['gender'],
        'name_error' => '',
        'email_error' => '',
        'password_error' => '',
        'phone_error' => '',
    ];
// /* Checking validations-*/
if($source->Query("SELECT * FROM userregistration where email = ?",[$data['email']])){
    if($source->CountRows()>0){
        $data['email_error'] = "Sorry, this email already exist";
    }
}
    if(strlen($data['password'])<5){
        $data['password_error'] = "Password is too short";
    }
    

    // submitting form 
    // if(empty($data['name_error']) && empty($data['email_error']) && empty($data['password_error']) && empty($data['phone_error'])){
        if(empty($data['password_error'])){
            

            if(empty($data['email_error'])){
                $password = password_hash($data['password'],PASSWORD_DEFAULT);
                if($source->Query("INSERT INTO `userregistration` (name,email,password,phone,address,gender) VALUES (?,?,?,?,?,?)",
                [$data['name'],$data['email'],$password,$data['phone'],$data['address'],$_POST['gender']]
                )){
                    $user_create = "User account created successfully";
                }else{
                    $user_create = "Failed To create user";
                }
            }else{
                $user_create = "This email already in user panel";
            }
        }else{
            $user_create = "Minimum 6 digit password required";
        }
       
        
    //     }
    // }else{
    //     $error = "Please full fill the form.";
    // }
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
<!-- success or error message -->
    <div class="container text-success m-auto">
        <?php
        if (!empty($user_create)) {
            echo $user_create;
            $user_create = "";
        }
        ?>
    </div>
    <div class="text-danger m-auto">
        <?php
        if (!empty($error)) {
            echo $error;
            $error = "";
        }
        ?>
    </div>
<!-- add users -->
<form action="" method="POST">
<?php
    if(!empty($_SESSION['admin_log'])){
        if($_SESSION['admin_log']==1){
            echo "
            <div class='container mt-3 w-100'>
        <form method='POST'>
            <input type='text' class='form-control w-25 ml-auto' name='name' placeholder='Name' required>

            <input type='email' class='form-control w-25 mt-2 ml-auto' name='email' placeholder='Email' required>

            <input type='password' class='form-control w-25 mt-2 ml-auto' name='password' placeholder='Password ( 6 digit )' required>

            <input type='number' class='form-control w-25 ml-auto mt-2' name='phone' placeholder='Phone Number' required>

            <input type='text' class='form-control w-25 mt-2 ml-auto' name='address' placeholder='Address' required>

            <div class='float-right '>
                        <input type='radio' name='gender' value='male' checked class = 'mr-auto'> Male 
                        <input type='radio' name='gender' value='female'> Female
                    </div>


            <input type='submit' class='form-control w-25 mt-4 ml-auto btn btn-block btn-outline-info' name='adduser' value='Add User'>
        </form>
    </div>
      
            ";
        }
    }
?>
</form>

<div class="text-success container display-4 ">
    <?php 
        if(!empty($_SESSION['delete_user'])){
            echo $_SESSION['delete_user'];
            $_SESSION['delete_user'] = "";
        }
    ?>
</div>

    <!-- show admins -->
  <div class="container-fluid">
    <div class="container">
      <table class="table table-hover">
        <thead>
          <tr>
          
            <th class="col-1">ID</th>
            <th class="col-1">Name</th>
            <th class="col-1">Email</th>
            <th class="col-1">Password</th>
            <th class="col-1">Phone</th>
          </tr>
        </thead>
        <tbody>
          <?php
            $query = $source->Query("SELECT * FROM userregistration");
            $details = $source->FetchAll();
            $numrow = $source->CountRows();
            if($numrow>0){
              foreach($details as $row):

                if(!empty($_SESSION['admin_log'])){
                    if($_SESSION['admin_log']==1){
                        $delete = "<td> <a href='delete.php?deleteuser=".$row->id."' class='btn btn-outline-danger mt-2'> Delete</a> </td>";
                    }else{
                        $delete = "";
                    }
                }


                if(!empty($delete)){
                    echo "
                <tr>
                
                <td>".$row->id."</td>
                <td>".$row->name."</td>
                <td>".$row->email."</td>
                <td>".$row->password."</td>
                <td>".$row->phone."</td>
                ".$delete."
                </tr>";
                }else{
                    echo "
                <tr>
                
                <td>".$row->id."</td>
                <td>".$row->name."</td>
                <td>".$row->email."</td>
                <td>".$row->password."</td>
                <td>".$row->phone."</td>
                </tr>";
                }





                  
                // echo "
                // <tr>
                
                // <td>".$row->id."</td>
                // <td>".$row->name."</td>
                // <td>".$row->email."</td>
                // <td>".$row->password."</td>
                // <td>".$row->phone."</td>
                // <td> <a href='delete.php?delete=".$row->id."' class='btn btn-outline-danger mt-2'> Delete</a> </td>
                // </tr>";

              endforeach;
              
            }   
          ?>
        </tbody>
      </table>
    </div>
  </div>
</body>

</html>