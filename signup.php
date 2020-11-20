<?php
include "init.php";

if(isset($_POST['signup'])){
    
    $data=[
        'name' => $_POST['full_name'],
        'email' => $_POST['email'],
        'password' => $_POST['password'],
        'phone' => $_POST['phone'],
        'address' => $_POST['address'],
        'gender' => $_POST['gender'],
        'name_error' => '',
        'email_error' => '',
        'password_error' => '',
        'phone_error' => '',
        'address_error' => '',
        'gender_error' => ''
    ];
/* ------------------------------------Checking validations-------------------------- */
    if(empty($data['name'])){
        $data['name_error'] = "*";
    }

    if(empty($data['email'])){
        $data['email_error'] = "*"; 
    }else{
        if($source->Query("SELECT * FROM userregistration where email = ?",[$data['email']])){
            if($source->CountRows()>0){
                $data['email_error'] = "Sorry, this email already exist";
            }
        }
    }

    if(empty($data['password'])){
        $data['password_error'] = "*";
    }else if(strlen($data['password'])<5){
        $data['password_error'] = "Password is too short";
    }
    if(empty($data['phone'])){
        $data['phone_error'] = "*";
    }else if(strlen($data['phone'])!=11){
        $data['phone_error'] = "Enter your valid phone number";
    }

    if(empty($data['address'])){
        $data['address_error'] = "*";
    }

    /* --------------------------------------------submitting form -----------------------------*/
    if(empty($data['name_error']) && empty($data['email_error']) && empty($data['password_error']) 
    && empty($data['phone_error']) && empty($data['address_error']) && empty($data['gender_error'])){
        
        $password = password_hash($data['password'],PASSWORD_DEFAULT);
        if($source->Query("INSERT INTO userregistration (name,email,password,phone,address,gender) VALUES (?,?,?,?,?,?)",
        [$data['name'],$data['email'],$password,$data['phone'],$data['address'],$data['gender']]
        )){
            $_SESSION['account_created'] = "Your account created successfully";
            header("location:index.php");
        }
    }else{
        $error = "Something went wrong";
    }
}
?>
<html>
<head>
    <title>Login</title>
    <meta name="viewpost" content="width=device-width, initial-scale=1.0">
    <link href="assets/css/signup.css?v=<?php echo time(); ?>" rel="stylesheet" type="text/css">
</head>
<body>
    <div class="all">
        <div class="bkimg">
            <img src="assets/img/bg.svg">
        </div>
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="login">
                <h1>Registration</h1>
                <div class="inputall">
                    <div class="input">
                        <h4>Full Name</h4> <input type="text" name="full_name" value = "<?php if(!empty($data['name'])){echo $data['name'];} ?>">
                    </div>
                        <h5 class="error"> <?php if(!empty($data['name_error'])){echo $data['name_error'];} ?> </h5>
                    <div class="input">
                        <h4>Email</h4> <input type="email" name="email" value = "<?php if(!empty($data['email'])){echo $data['email'];} ?>">
                    </div>
                    <h5 class="error"> <?php if(!empty($data['email_error'])){echo $data['email_error'];} ?> </h5>
                    <div class="input">
                        <h4>Password</h4> <input type="password" name="password">
                    </div>
                    <h5 class="error"> <?php if(!empty($data['password_error'])){echo $data['password_error'];} ?> </h5>
                    <div class="input">
                        <h4>Phone</h4> <input type="number" name="phone" value = "<?php if(!empty($data['phone'])){echo $data['phone'];} ?>">
                    </div>
                    <h5 class="error"> <?php if(!empty($data['phone_error'])){echo $data['phone_error'];} ?> </h5>
                    <div class="input">
                        <h4>Address</h4> <input type="text" name="address" value = "<?php if(!empty($data['address'])){echo $data['address'];} ?>">
                    </div>
                    <h5 class="error"> <?php if(!empty($data['address_error'])){echo $data['address_error'];} ?> </h5>

                    <div class="gender">
                        <input type="radio" name="gender" value="male" checked> Male <input type="radio" name="gender" value="female"> Female
                    </div>
                        <h5 class="error"> <?php if(!empty($data['gender_error'])){echo $data['gender_error'];} ?> </h5>
                        
                    <div class="signupbtn">
                        <input type="submit" name="signup" value="Signup">
                    </div>
                </div>
                <p style="background-image:"></p>
                <p class="loginbtn"><a href="index.php">Already have account? Login</a></p>
            </div>
        </form>
    </div>
</body>
</html> 

