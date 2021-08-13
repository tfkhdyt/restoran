<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <a class="navbar-brand ml-5" href="#"><img src="asset/gambar/logo_meetball.png" height="50" class="navbar-brand"></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="index.php">Home</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Cart
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <div class="container">
            <div class="row">
              <div class="col">
                <table class="table table-striped table-bordered">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Produk</th>
                      <th>Nama Produk</th>
                      <th>Nomor Meja</th>
                      <th>Jumlah</th>
                      <th>Harga</th>
                      <th>Sub Total</th>
                    </tr>
                  </thead>
                  <tbody>
                    <form action="proses/proses_entri_order.php" method="post">
                    <?php 
                      include "koneksi.php"

                    ?>
                    <tr>
                      <td>No</td>
                      <td>Produk</td>
                      <td>Nama Produk</td>
                      <td>Nomor Meja</td>
                      <td>Jumlah</td>
                      <td>Harga</td>
                      <td>Sub Total</td>
                    </tr>
                    </form>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </li>
    </ul>
    <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-warning my-2 my-sm-0" type="submit">Search</button>&nbsp;&nbsp;
      <a href="login.php" class="btn btn-success my-2 my-sm-0">Login</a>
    </form>
  </div>
</nav>