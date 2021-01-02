<?php
include("../init.php");

$approval = "Approved";
$query = $source->Query("UPDATE event SET approval=? where id=?",[$approval,$_GET['approval']]);
if($query){
    $_SESSION['approve_user'] = "User Approved Successfully";
    header("location:approved.php");
}else{
    $_SESSION['approve_user'] = "Failed To Approved";
    header("location:approved.php");
}
?>