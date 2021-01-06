<?php
include '../../../init.php';

if(!empty($_GET['sub_category'])){
    $_SESSION['sub_cate'] = $_GET['sub_category'];
    header('location:../addproducts.php');
}

?>