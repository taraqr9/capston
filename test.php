<?php
  if(isset($_POST['searchbtn']) && !empty($_POST['search'])){
    $query = $source->Query("SELECT * FROM products where name like=?",[$_POST['search']]);
}
?>

<html>

<body>
  <a href="admin/product/1.php">Hi</a>
</body>

</html>