<?php
if (empty($_SESSION['email'])) {
    header("location:index.php");
  }
  if (isset($_POST['admin'])) {
    header("location:admin.php");
  }
  if (isset($_POST['users'])) {
    header("location:users.php");
  }
  if (isset($_POST['product'])) {
    header("location:product/product.php");
  }
  if (isset($_POST['addproduct'])) {
    header("location:product/addproducts.php");
  }
  if (isset($_POST['pending'])) {
    header("location:pending.php");
  }
  if (isset($_POST['approved'])) {
    header("location:approved.php");
  }
?>