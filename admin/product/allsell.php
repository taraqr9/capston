<html>
<head>
    <title>Products</title>
    <meta name="viewpost" content="width=device-width, initial-scale=1.0" />

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>


</head>

<body>
    <!-- navbar -->
    <?php include '../splitfile/navbar.php' ?>
    
    <!-- All Sell lists -->
    <div class="container">
        <form action="" method="POST">
            <div class="container-fluid">
                <div class="row bg-light">
                    <div class="m-2 container ml-lg-auto">
                        <!-- category Dropdownlist -->
                        <div class="row">
                            <div class="mr-2">
                                <a href="endfile/category.php?all=999" class="btn btn-outline-info col-12">All Sell</a>
                            </div>
                            <!-- men -->
                            <div class="mr-2">
                                <button class="btn btn-outline-info">
                                    <input type="submit" value="Most Sold" name="mostsold"> 
                                </button>
                            </div>
                            <div class="mr-2">
                                <button class="btn btn-outline-info">
                                    Low Quintaty
                                </button>
                            </div>
                            <div class="mr-2">
                                <button class="btn btn-outline-info">
                                    Next Month Buy
                                </button>
                            </div>
                            <div class="mr-2">
                                <button class="btn btn-outline-info">
                                    Not Sold Last 15 Days
                                </button>
                            </div>
                            <div class="mr-2">
                                <button class="btn btn-outline-info">
                                    Last Month Sell
                                </button>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</body>
</html>