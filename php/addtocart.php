<?php
include "../init.php";
$query = $source->Query("SELECT * FROM `cart` WHERE pid LIKE ? AND uid LIKE ?", [$_GET['addtocart'],$_SESSION['id']]);
$number = $source->FetchAll();
$row = $source->CountRows();
// echo "<pre>";
// var_dump($_GET, $_SESSION);
// echo "</pre>";

if(!empty($_SESSION['size'])){
    $size = $_SESSION['size'];
}


if($row>0){
    header('location:../productdetails.php');
            $_SESSION['pid'] = $_GET['addtocart'];
            $_SESSION['addtocart'] = "
            <div class='alert'>
                    <span class='closebtn ' onclick='this.parentElement.style.display='none';'>&times;</span><span class = 'h5'>Already Added on your cart</span>
                </div>
                ";
}
else{
    if(!empty($_GET['addtocart'])){
        $query = $source->Query("SELECT * FROM products WHERE id=?", [$_GET['addtocart']]);
        $product = $source->SingleRow();
        $pname = $product->name;
        $price = $product->price;
        $sub_cate = $product->sub_category;
        $category = $product->category;
        
        if ($sub_cate == '2' || $sub_cate == '5' || $sub_cate == '9'){
            if ($source->Query("INSERT INTO `cart` (`pid`, `uid`,`pname`,`size`,`category`,`sub_category`,`price`) VALUES (?,?,?,?,?,?,?)", [$_GET['addtocart'],$_SESSION['id'],$pname,$size,$category,$sub_cate,$price])){
                
                
                $_SESSION['size'] = "";
                header('location:../productdetails.php');
                $_SESSION['pid'] = $_GET['addtocart'];
                $_SESSION['addtocart'] = "
                <div class='alert'>
                    <span class='closebtn ' onclick='this.parentElement.style.display='none';'>&times;</span><span class = 'h5'>Already Added on your cart</span>
                </div>
                ";
            }
        }else{
            if ($source->Query("INSERT INTO `cart` (`pid`, `uid`,`pname`,`category`,`sub_category`,`price`) VALUES (?,?,?,?,?,?)", [$_GET['addtocart'],$_SESSION['id'],$pname,$category,$sub_cate,$price])){
                header('location:../productdetails.php');
                $_SESSION['pid'] = $_GET['addtocart'];
                $_SESSION['addtocart'] = "
                <div class='alert'>
                    <span class='closebtn ' onclick='this.parentElement.style.display='none';'>&times;</span><span class = 'h5'>Product added successfully</span>
                </div>
                ";
            }
        }
}
    
}
    
?>

