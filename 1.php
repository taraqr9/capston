<?php 
    include 'init.php';
    
?>



<html>
<head>
<meta name="viewpost" content="width=device-width, initial-scale=1.0">
<link href="assets/css/home.css?v=<?php echo time(); ?>" rel="stylesheet" type="text/css">

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
	    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
	    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
	    <script src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script>
</head>
<body>
<?php 
    $data = $source->Query("SELECT * FROM userregistration");
    $totalrow = $source->CountRows();
    $datas = $source->FetchAll();
    echo $totalrow."<br>";
    foreach($datas as $d){
        echo $d->name."<br>";
    }
    

?> 

</body>

</html>