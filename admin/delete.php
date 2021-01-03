<?php
include("../init.php");


$query = $source->Query("DELETE FROM userregistration where id=?",[$_GET['deleteuser']]);
if($query){
    $_SESSION['delete_user'] = "User Delete Successfully";
    header("location:users.php");
}else{
    $_SESSION['delete_user'] = "Failed To Delete";
    header("location:users.php");
}

if(!empty($_GET['deleteorder'])){
    $query = $source->Query("DELETE FROM `order` where oid=?",[$_GET['deleteorder']]);
if($query){
    $_SESSION['delete_order'] = "Order Delete Successfully";
    header("location:approved.php");
}else{
    $_SESSION['delete_order'] = "Failed To Delete";
    header("location:approved.php");
}
}
?>