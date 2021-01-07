<?php
include 'init.php';

$row = $source->Query("SELECT * FROM products WHERE id = (SELECT MAX(id) FROM products)");
    $fetch = $source->SingleRow();
    $numrow = $row;
    $jpg = ".jpg";
    echo $imagedbname = $numrow + 1 . $jpg;
    echo $imagename = $numrow + 1;





// $imagename = 11+1;
// if (isset($_POST['uploadbtn'])) {
//   if (!empty($_FILES['image']['name'])) {
//       $allowed_ext = array("jpg", "JPG"); //allowed image extensions
//       $extention = explode('.', $_FILES['image']['name']); //get uploaded file extension
//       $ext = end($extention);
//       if (in_array($ext, $allowed_ext)) {
//               $path = "assets/" . $imagename. '.' . $ext; //file upload loaction
//               $image = $_FILES['image']['name'];
//               move_uploaded_file($_FILES['image']['tmp_name'], $path);
          
//       } else {
//           $imageError = 'Invalid image file';
//       }
//   } else {
//       $imageError = 'Please select a image file';
//   }
// }

?>

<html>

<body>
  <?php
  if (!empty($imageError)) {
    echo $imageError;
  }
  ?>
  <!-- product pricture -->
  <!-- <form action="" method="POST"  enctype="multipart/form-data">
  <div class="selectimg"><input type="file" name="image"></div>
                <div class="uploadimg"><button type="submit" name="uploadbtn">Upload</button></div>
  </form> -->
</body>

</html>