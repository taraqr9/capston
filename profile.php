<?php
include "init.php";
if(!isset($_SESSION['login_success'])){
    header('location:index.php');
}

/*-------------------------Update Profile information -----------------------------*/

if($source->Query("SELECT * FROM userregistration where id = ?",[$_SESSION['id']])){
    $row = $source->SingleRow();
    $id = $row->id;
    $name = $row->name;
    $email = $row->email;
    $password = $row->password;
    $phone = $row->phone;
    $address = $row->address;
    $dbimage = $row->image;
}

if(isset($_POST['update'])){
    $data=[
        'name' => $_POST['full_name'],
        'email' => $_POST['email'],
        'o_pass' => $_POST['o_pass'],
        'n_pass' => $_POST['n_pass'],
        'phone' => $_POST['phone'],
        'address' => $_POST['address'],

        'name_error' => '',
        'email_error' => '',
        'o_pass_error' => '',
        'n_pas_error' => '',
        'phone_error' => '',
        'address_error' => '',

        'update' => ''
    ];

    if(empty($data['name'])){
        $data['name_error'] = "*";
    }
    if(empty($data['email'])){
        $data['email_eror'] = "*";
    }else{
        if($source->CountRows()>1){
            $data['email_error'] = "Sorry, this email already exist";
        } 
    }
/* Currect password requirement*/
    if(!empty($data['o_pass'] && !password_verify($data['o_pass'],$password))
    || empty($data['o_pass']) && !empty($data['n_pass'])){
        $data['o_pass_error'] = "*";
    }
    if(!empty($data['o_pass'] && empty($data['n_pass']))){
        $data['n_pass_error'] = '*';
    }
    if(!empty($data['o_pass'] && !empty($data['n_pass']) && strlen($data['n_pass'])<5)){
        $data['n_pass_error'] = 'too short';
    }

    if(empty($data['phone'])){
        $data['phone_error'] = "*";
    }else if(strlen($data['phone'])!=11){
        $data['phone_error'] = "Enter your valid phone number";
    }

    if(empty($data['address'])){
        $data['address_error'] = "*";
    }

/*---------------------------Pushing data into database------------------------------------*/
    if(!empty($data['o_pass'] || !empty($data['n_pass']))){
        if(empty($data['name_error']) && empty($data['email_error']) && empty($data['o_pass_error']) &&
    empty($data['n_pass_error']) && empty($data['phone_error']) && empty($data['address_error'])){
        $pass = password_hash($data['n_pass'],PASSWORD_DEFAULT);
        if($source->Query("UPDATE userregistration SET name=?,email=?,password=?,phone=?,address=? where id=?",
        [$data['name'],$data['email'],$pass,$data['phone'],$data['address'],$_SESSION['id']])){
            $_SESSION['update'] = "Successfully updated. Reload the page";
            header('location:profile.php');
        }else{
            $_SESSION['update'] = "Something went wrong";
        }
    }
    }else if(empty($data['o_pass']) || empty($data['n_pass'])){
        if(empty($data['name_error']) && empty($data['email_error']) && empty($data['phone_error']) && empty($data['address_error'])){
        if($source->Query("UPDATE userregistration SET name=?,email=?,phone=?,address=? where id=?",
        [$data['name'],$data['email'],$data['phone'],$data['address'],$_SESSION['id']])){
            $_SESSION['update'] = "Successfully updated. Reload the page";
            header('location:profile.php');
        }else{
            $_SESSION['update'] = "Something went wrong";
        }
    }
    }

}


/*------------------------------upload profile picture ---------------------------------*/
if(isset($_POST['uploadbtn'])){
    if($_FILES['image']['name'] !=''){
        $allowed_ext = array("jpg","png","jpeg"); //allowed image extensions
        $extention = explode('.',$_FILES['image']['name']); //get uploaded file extension
        $ext = end($extention);
        if(in_array($ext,$allowed_ext)){
            if($_FILES['image']['size']<2097152){
                $img_name = $_SESSION['id']. '.' . $ext; //rename the file name
                $path = "assets/profilepic/".$img_name; //file upload loaction
                $image = $_FILES['image']['name'];
                $source->Query("UPDATE userregistration SET image=? where id=?",[$img_name,$_SESSION['id']]);
                move_uploaded_file($_FILES['image']['tmp_name'],$path);
                header("location:profile.php?file-name=".$img_name."");
            }else{
                $imageError = 'File is too big';
            }
        }else{
            $imageError = 'Invalid image file';
        }
    }else{
        $imageError = 'Please select a image file';
    }
    
}
// image retriving -------------------
    $imageRetrive = $source->Query("SELECT image FROM userregistration where id = ? ",[$_SESSION['id']]);





/*----------------------------------


echo $filename = $_FILES['image']['name'];
    echo $fileTmpN = $_FILES['image']['tmp_name'];
    echo $filesize = $_FILES['image']['size'];
    echo $fileerror = $_FILES['image']['error'];
    echo $filetype = $_FILES['image']['type'];

-----------------------*/

?>











<html>
    <head>
        <link href="assets/css/profile.css?v=<?php echo time(); ?>" rel="stylesheet" type="text/css">
    </head>

    <body>
        
        <form action="profile.php" method="post" enctype="multipart/form-data">
            <div class="topbar">
                
                <h1 class="dbtitle"><a href="home.php">Daily Bazar</a></h1>
                <div class="search">
                    <input type="search" name="searchinput">
                    <img src="assets/img/search.svg">
                </div>
                <div class="wishlist">
                    <img class="heart" src="assets/img/heart2.png">
                    <h3>Wishlist</h3>
                    <img class="shopping" src="assets/img/shopping.png">
                </div>
                <div class="profile">
                    <img src="assets/img/profile.svg" alt="">
                        <h4 id="profname" onclick="show_hideprof()"><?php 
                            echo $_SESSION['login_success'];
                        ?></h4>
                    <div class="subprof" style="display:none;" id="subprof">
                            <li > <a href="profile.php">Profile</a> </li>
                            <li> Orders </li>
                            <li> <a href="logout.php">Logout</a> </li>
                        </div>
                </div>

<!-- -------------------------------------------------------------Profile Edit ------------------------------------------------------------->
                <div class="profpic">
                    <?php 
                    if(!empty($dbimage)){
                        echo "<img src = 'assets/profilepic/".$dbimage."' alt=".'prfile.php'.">";
                    }else{
                        echo "<img src = '"."assets/img/profile.svg"."' alt="."prfile.php".">";
                    }
                    ?>



                    <div class="selectimg"><input type="file" name="image"></div>
                    <div class="uploadimg"><button type="submit" name="uploadbtn">Upload</button></div>
                    <div class="imageSucc">
                        <?php 
                            if(isset($_GET['file-name'])){
                                echo "Image uploaded successfully";
                                
                            }
                            ?>
                    </div>
                    <div class="imageError">
                        <?php
                            if(!empty($imageError)){
                                echo $imageError;
                            }
                        ?>
                    </div>

                    <?php if(!empty($msg)){
                    echo $msg;
                } ?>
                </div>

                <div class="userinfo">
                    <div class="input">
                        <h4>Full Name</h4> <input type="text" name="full_name" value = "<?php echo $name; ?>">
                        <h5 class="error"> <?php if(!empty($data['name_error'])){echo $data['name_error'];} ?></h5>
                    </div>
                    <div class="input">
                        <h4>Email</h4> <input type="email" name="email" value = "<?php echo $email; ?>">
                        <h5 class="error"> <?php if(!empty($data['email_error'])){echo $data['email_error'];} ?></h5>
                    </div>
                    <div class="input">
                        <h4>Old Password</h4> <input type="password" name="o_pass" value = "">
                        <h5 class="error"><?php if(!empty($data['o_pass_error'])){echo $data['o_pass_error'];} ?></h5>
                    </div>
                    <div class="input">
                        <h4>New Password</h4> <input type="password" name="n_pass" value = "">
                        <h5 class="error"> <?php if(!empty($data['n_pass_error'])){echo $data['n_pass_error'];} ?></h5>
                    </div>
                    <div class="input">
                        <h4>Phone</h4> <input type="number" name="phone" value = "<?php echo $phone; ?>">
                        <h5 class="error"> <?php if(!empty($data['phone_error'])){echo $data['phone_error'];} ?></h5>
                    </div>
                    <div class="input">
                        <h4>Address</h4> <input type="text" name="address" value = "<?php echo $address; ?>">
                        <h5 class="error"> <?php if(!empty($data['address_error'])){echo $data['address_error'];} ?></h5>
                    </div>
                    <div class="update">
                        <input type="submit" name="update" value="Update">
                        <?php
                            if(!empty($_SESSION['update'])){
                                echo $_SESSION['update'];
                            }
                            unset($_SESSION['update']);
                        ?>
                    </div>
                </div>
            </div>
        </form>








        <script>
            function show_hideprof() {
            var profclick = document.getElementById("subprof");
            
            if (profclick.style.display === "none") {
                profclick.style.display = "block";
            } else {
                profclick.style.display = "none";
            }
        }
        </script>
    </body>




















</html>