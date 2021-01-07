<!-- navbar -->
<div class="container-fluid sticky-top">
    <div class="row bg-light">
      <div class=" col-6 text-center m-auto"><a href="../../admin.php" class="btn">
          <h1 class="text-info">ADMIN PANEL</h1>
        </a> </div>
      <div class="col-6  mt-3">
        <form action="" method="POST">



          <div class="row ml-5">
            <div class="mr-2">
              <button class="btn btn-outline-info dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Admin
              </button>
              <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                <button class="dropdown-item" type="button"><input type="submit" value="Admins" name="admin" class="btn btn-outline-info col-12" /></button>
                <button class="dropdown-item" type="button"><input type="submit" value="Users" name="users" class="btn btn-outline-info col-12" /></button>
              </div>
            </div>



            <div class="mr-2">
              <button class="btn btn-outline-info dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Product
              </button>
              <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                <button class="dropdown-item" type="button"><input type="submit" value="Products" name="product" class="btn btn-outline-info col-12" /></button>
                <button class="dropdown-item" type="button"><input type="submit" value="Add Products" name="addproduct" class="btn btn-outline-info col-12" /></button>
              </div>
            </div>

            <div class="mr-2">
              <button class="btn btn-outline-info dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Order
              </button>
              <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                <button class="dropdown-item" type="button"><input type="submit" value="Approved" name="approved" class="btn btn-outline-info col-12" /></button>
                <button class="dropdown-item" type="button"><input type="submit" value="Pending" name="pending" class="btn btn-outline-info col-12" /></button>
              </div>
            </div>
            <a href="logout.php" class="btn btn-outline-info mr-2">Logout</a>
          </div>

        </form>
      </div>
    </div>
  </div>