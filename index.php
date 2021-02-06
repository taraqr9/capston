<?php
include "init.php";

if(isset($_SESSION['id'])){
    header('location:home.php');
}

if(isset($_POST['login'])){
    $data = [
        'email' => $_POST['email'],
        'password' =>$_POST['password'],
        'email_error' => '',
        'password_error' =>''
    ];

    if(empty($data['email'])){
        $data['email_error'] = "Email is required";
    }
    if(empty($data['password'])){
        $data['password_error'] = "Password is required";
    }

    if(empty($data['email_error']) && empty($data['password_error'])){
        if($source->Query("SELECT * FROM userregistration where email = ?",[$data['email']])){
            if($source->CountRows()>0){
                $row = $source->SingleRow();
                $id = $row->id;
                $email = $row->email;
                $db_password = $row->password;
                $name = $row->name;
                if(password_verify($data['password'],$db_password)){
                    $_SESSION['login_success'] = $name;
                    $_SESSION['id'] = $id;
                    $_SESSION['email'] = $email;
                    header("location:home.php");
                }else{
                    $data['password_error'] = "Please enter correct password";
                }
            }else{
                $data['email_error'] = "Invalid email";
            }
        }
    }
}
?>

<html>
<head>
    <title>Login</title>
    <meta name="viewpost" content="width=device-width, initial-scale=1.0">
    <link href="assets/css/login.css?v=<?php echo time(); ?>" rel="stylesheet" type="text/css">
</head>
<body>
    <div class="all">
        <div class="bkimg">
            <img src="assets/img/bg.svg">
        </div>
        <div class="success">
                <p> <?php
                    if(isset($_SESSION['account_created'])){
                        echo $_SESSION['account_created'];
                    }
                    unset($_SESSION['account_created']);
                ?> </p>
            </div>
        
        <form action="" method="POST">
            <div class="login">
            
                <h1>Login</h1>
                <div class="profile">
                    <img src="assets/img/profile.svg">
                </div>
                <div class="inputall">
                    <div class="input">
                        <h4>Email</h4> <input type="email" name="email"
                        value="<?php if(!empty($data['email'])){
                            echo $data['email'];
                        } ?>">
                    </div>
                    <div class="error">
                        <?php if(!empty($data['email_error'])){ echo $data['email_error'];} ?>
                    </div>
                    <div class="input">
                        <h4>Password</h4> <input type="password" name="password">
                    </div>
                    <div class="error">
                        <?php if(!empty($data['password_error'])){ echo $data['password_error'];} ?>
                    </div>
                    <p class="forgotpass">Forgot your password ?</p>
                    <div class="loginbtn">
                        <input type="submit" name="login" value="Login">
                    </div>
                </div>
                <p class="signup"><a href="signup.php">Don't have account? Signup here</a></p>

                <p class="signup"><a href="admin/admin.php" >Goto Admin Panel</a></p>
            </div>

        </form>
    </div>
</body>
</html>