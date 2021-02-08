<!-- ***** header-section start***** -->
<section class="headerSection sticky-top">
    <div class="container">
        <div class="row" style="align-items: center;">
            <!-- logo-column -->
            <div class="col-3 col-sm-3 col-xsm-2">
                <h2><a href="home.php" style="text-decoration: none; color: white;">DailyBazar</a></h2>
            </div>
            <!-- search box column -->
            <div class="col-5 col-sm-4 col-xsm-3">
                <div class="searchTextField">
                    <form class="d-flex" method="POST" action="home.php">
                        <input class="form-control me-2 w-75 d-inline" type="text" name="search" required>
                        <input type="submit" name="searchBtn" value="SEARCH" class=" btn btn-outline-light rounded-pill">
                    </form>
                </div>

            </div>
            <div class="col-1 col-sm-1 col-xsm-1">
                <a href="cart.php"><img src="assets/img/shopping.png" alt=""></a>
            </div>
            <div class="col-3 col-sm-4 col-xsm-6">
                <div class="row">
                    <div class="profile">
                        <div class="profileDrop dropdown">
                            <button class="btn shadow-none dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img src="assets/img/profile.svg" style="width: 40px; margin-bottom:10px">
                                <span class="h3"><?php echo $_SESSION['login_success']; ?></span>
                            </button>
                            <div class="ddr dropdown-menu rounded" style="margin-left:200px;" aria-labelledby="dropdownMenu2">
                                <a href="profile.php" class=" h5 rounded-pill dropdown-item">Profile</a>
                                <a href="order.php" class="h5 rounded-pill dropdown-item ">Order</a>
                                <a href="logout.php" class="h5 rounded-pill dropdown-item">Logout</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>