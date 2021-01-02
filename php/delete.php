<?php
include "../init.php";

//Removing Order.php Pending order.
if(!empty($_GET['delete'])){
    if($source->Query("DELETE FROM `order` where oid=?",[$_GET['delete']])){
        $_SESSION['delete'] = "Order Deleted Successfully";
        header("location:../order.php");
    }else{
        $_SESSION['delete'] = "Failed To Delete";
        header("location:../order.php");
    }
}


// Removing items from cart.php

if(!empty($_GET['remove'])){
    if($source->Query("DELETE FROM `cart` where oid=?",[$_GET['remove']])){
    
        header("location:../cart.php");
    }else{
        header("location:../cart.php");
    }
}
?>