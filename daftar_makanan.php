<div class="container"><br>
  <div class="row">
    <div class="col-md-3">
      <h2>Daftar Makanan</h2>
    </div>
    <div class="col-md-9">
      <a href="admin.php?menu=daftar_minuman" class="btn btn-secondary float-right">Lihat Daftar Minuman</a>
    </div>
    <div class="col-md-12">
      <?php if (isset($_SESSION['pesan'])) : ?>
          <?= $_SESSION['pesan'] ?>
      <?php
          unset($_SESSION['pesan']);
      endif;
      ?>
  </div>
  <?php  
    error_reporting(0);
    include "koneksi.php";
    $query = "SELECT * FROM masakan WHERE kategori_masakan = 'Makanan' ORDER BY id_masakan DESC";
    $masakan = $query;
    $result = mysqli_query($koneksi, $query);
    while($data = mysqli_fetch_assoc($result))
    {
  ?>
  
  <div class="col-md-3">
    <div class="card" style="width: 16rem;">
      <img src="asset/gambar/makanan/<?= $data['foto'];  ?>" class="img-thumbnail">
        <div class="card-body">
          <?php if ($data['status_masakan'] == '1'): ?>
            <span class="badge badge-success">Tersedia</span>
          <?php else: ?>
            <span class="badge badge-danger">Habis</span>
          <?php endif ?>
          <h5 class="card-title"><p><?= $data['nama_masakan'];  ?></p></h5>
          <p class="card-text"><?= $data['deskripsi']; ?></p>
          <!-- <button class="btn btn-primary col-sm-12" data-toggle="modal" data-target="#order"><?= rupiah($data['harga']);  ?></button> -->
          <button type="button" data-target="#dMasakan_<?= $data['id_masakan'] ?>" data-toggle="modal" class="btn btn-primary col-sm-12" >Rp <?php if($_SESSION['id_level'] == ''){ echo rupiah($data['harga'] + 5000); }else{echo rupiah($data['harga']);} ?></button>
          <?php 
            if ($_SESSION['id_level'] == "1") {
              echo "<a href='ubah_makanan.php?id_masakan=$data[id_masakan]' class='btn btn-success col-sm-6'>Ubah</a>";
              echo "<a href='proses/proses_hapus_makanan.php?id_masakan=$data[id_masakan]' class='btn btn-danger col-sm-6'>Hapus</a>";
            }
           ?>
          
        </div>
      </div>
  </div>
  <!-- modal -->
    <div class="modal fade" id="dMasakan_<?= $data['id_masakan'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-tittle" style="font-size:16px;" id="exampleModalLabel"><?= $data['nama_masakan'] ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="order/tambah_pesan.php" method="POST">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-4">
                                <img src="asset/gambar/makanan/<?= $data['foto'];  ?>" alt="..." width="350">

                            </div>
                            <div class="col-md-8">
                                <input type="hidden" name="id_masakan" value="<?= $data['id_masakan'] ?>">
                                <div class="form-group">
                                    <label for="">Menu</label>
                                    <input type="text" readonly class="form-control" value="<?= $data['nama_masakan'] ?>">
                                </div>
                                <div class="form-group">
                                    <label for="">Harga</label>
                                    <input type="text" readonly class="form-control" value="Rp <?= rupiah($data['harga']) ?>">
                                </div>
                                <div class="form-group">
                                    <label for="">Jumlah Pesanan</label>
                                    <input type="number" name="jumlah" min="1" max="20" value="1" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">Keterangan</label>
                                    <textarea name="keterangan" class="form-control text-small"></textarea>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary text-small" data-dismiss="modal">Tutup <i class="fas fa-times"></i></button>
                        <button type="submit" class="btn btn-primary text-small">Simpan <i class="fas fa-save"></i></button>
                    </div>
                </form>
            </div>
        </div>
    </div>

        
  <?php } ?>
  </div>
</div> 

<script type="text/javascript">
  $(document).ready( function () {
    $('#myTable').DataTable();
} );
</script>