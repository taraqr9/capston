<?php
include("../init.php");

$approval = "Pending";
$query = $source->Query("UPDATE event SET approval=? where id=?",[$approval,$_GET['pending']]);
if($query){
    $_SESSION['pending_user'] = "User Pending Successfully";
    header("location:pending.php");
}else{
    $_SESSION['pending_user'] = "Failed To Pending";
    header("location:pending.php");
}
?>