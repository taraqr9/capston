<?php
include '../../init.php';
include 'splitfile/headerfile.php' ?>


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
    <?php include 'splitfile/navbar.php' ?>

    <!-- All Sell lists -->
    <div class="container">
        <form action="" method="POST">
            <div class="container-fluid">
                <div class="row bg-light">
                    <div class="m-2 container ml-lg-auto">
                        <!-- category Dropdownlist -->
                        <div class="row">
                            <div class="mr-2">
                                <input type="submit" value="All Sell" name="allsell" class="btn btn-outline-info">
                            </div>
                            <!-- men -->
                            <div class="mr-2">
                                <input type="submit" value="Most Sold" name="mostsold" class="btn btn-outline-info">
                            </div>
                            <div class="mr-2">
                                <input type="submit" value="Low Quintaty" name="lowquintaty" class="btn btn-outline-info">
                            </div>
                            <div class="mr-2">
                                <input type="submit" value="Next Month Need" name="nmneed" class="btn btn-outline-info">
                            </div>
                            <div class="mr-2">
                                <input type="submit" value="Not Sold" name="notsold" class="btn btn-outline-info">
                            </div>
                            <div class="mr-2">
                                <input type="submit" value="Last Month" name="mostsold" class="btn btn-outline-info">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

    </div>

    <!-- show Products -->
    <div class="container-fluid">
        <div class="container ">
            <table class="table table-hover ">
                <thead>
                    <tr>
                        <th class="col-1 border-left border-right"></th>
                        <th class="col-1 border-right">ID</th>
                        <th class="col-1 border-right">Date</th>
                        <th class="col-1 border-right">Name</th>
                        <th class="col-1 border-right">Price</th>
                        <th class="col-1 border-right">Qty</th>
                        <th class="col-1 border-right">Category</th>
                        <th class="col-1 border-right">Sub Category</th>
                        <th class="col-1 border-right"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php

                   if (isset($_POST['allsell'])) {
                        $query = $source->Query("SELECT * from `order`");
                        $details = $source->SingleRow();
                        $numrow = $source->CountRows();
                        
                        if ($numrow > 0) {
                            foreach ($details as $row) :
    
                                echo "
                    <tr>
                    <td class='col-1 border-left border-right'> <img class='rounded m-1' style='height:60px;' src='../../assets/productsimg/" . $row->pid . ".jpg' alt='Sample'></td>
                    <td class='col-1 border-right'>" . $row->id . "</td>
                    <td class='col-1 border-right'>" . $row->name . "</td>
                    <td class='col-1 border-right'>" . $row->price . "</td>
                    <td class='col-1 border-right'>" . $row->qty . "</td>
                    <td class='col-1 border-right'>" . $row->category . "</td>
                    <td class='col-1 border-right'>" . $row->sub_category . "</td>";
                                if (!empty($_SESSION['admin_log'])) {
                                    if ($_SESSION['admin_log'] == '1') {
                                        echo "<td class='col-1 border-right'><a href='edit.php?approval=" . $row->id . "' class='btn btn-outline-info m-auto'> Edit</a>
                            </td>";
                                    }
                                }
    
                                echo "
                    </tr>";
    
                            endforeach;
                        }
                    }else{
                        echo "nothing";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    </form>
</body>

</html>