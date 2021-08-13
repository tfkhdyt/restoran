<nav class="navbar navbar-expand-lg navbar-dark bg-danger">
  <a class="navbar-brand ml-5" href="#"><img src="asset/gambar/logo_meetball.png" height="50" class="navbar-brand"></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      
      <li class="nav-item <?php
                        session_start();
                        if(isset($_GET['menu'])){
                          if($_GET['menu']=='daftar_makanan'){
                            echo "active";
                          }else if($_GET['menu']=='daftar_minuman'){
                            echo "active";
                          }
                        }
                      ?>">
        <a class="nav-link" href="admin.php?menu=daftar_makanan">Daftar Makanan</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Entri Referensi
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="register.php">User</a>
          <a class="dropdown-item" href="entri_makanan.php">Masakan</a>
        </div>
      </li>
      <li class="nav-item <?php
                        if(isset($_GET['menu'])){
                          if($_GET['menu']=='daftar_order'){
                            echo "active";
                          }
                        }
                      ?>">
        <a class="nav-link" href="admin.php?menu=daftar_order">Daftar Order</a>
      </li>
      <li class="nav-item <?php
                        if(isset($_GET['menu'])){
                          if($_GET['menu']=='entri_transaksi'){
                            echo "active";
                          }
                        }
                      ?>">
        <a class="nav-link" href="admin.php?menu=entri_transaksi">Entri Transaksi</a>
      </li>
      <li class="nav-item <?php
                        if(isset($_GET['menu'])){
                          if($_GET['menu']=='generate_laporan'){
                            echo "active";
                          }
                        }
                      ?>">
        <a class="nav-link" href="admin.php?menu=generate_laporan">Generate Laporan</a>
      </li>
    </ul>
    <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-success my-2 my-sm-0" type="submit">Search</button>&nbsp;&nbsp;
      <a href="logout.php" class="btn btn-warning my-2 my-sm-0">Sign Out</a>&nbsp;&nbsp;
      <button type="button" data-toggle="modal" data-target="#modalKeranjang" class="btn btn-primary my-2 my-sm-0">Cart</button>
    </form>
  </div>
</nav>
