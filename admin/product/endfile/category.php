<?php
include "../../../init.php";

if(!empty($_GET['category'])){
    $_SESSION['category'] = $_GET['category'];
    header("location:../product.php");
}
if(!empty($_GET['mcategory'])){
    $_SESSION['mcategory'] = $_GET['mcategory'];
    header("location:../product.php");
}
if(!empty($_GET['all'])){
    $_SESSION['all'] = 1;
    header("location:../product.php");
}
?>