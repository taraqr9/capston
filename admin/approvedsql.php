<?php
include("../init.php");

$approval = "Approved";

$query = $source->Query("UPDATE `order` SET status=?,approvedby=? where oid=?",[$approval,$_SESSION['admin_log'],$_GET['approval']]);
if($query){
    $_SESSION['approve_user'] = "Product Approved Successfully";
    header("location:approved.php");
}else{
    $_SESSION['approve_user'] = "Failed To Approved";
    header("location:approved.php");
}
?>