<div class="container"><br>
  <div class="row">
    <div class="col-md-3">
      <h2>Daftar Minuman</h2>
    </div>
    <div class="col-md-9">
      <a href="admin.php?menu=daftar_makanan" class="btn btn-secondary float-right">Lihat Daftar Makanan</a>
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
    $query = "SELECT * FROM masakan WHERE kategori_masakan = 'Minuman' ORDER BY id_masakan DESC";
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
    <?php if (isset($_SESSION['login'])) : ?>

        <div class="modal fade" id="modalKeranjang" tabindex="-1" role="dialog" aria-labelledby="modalKeranjangLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document">

                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" style="font-size:16px;" id="modalKeranjangLabel">Keranjang</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <?php
                    $query_order = mysqli_query($koneksi, "SELECT count(id_order) as no_order FROM tb_order");
                    $order = mysqli_fetch_assoc($query_order);
                    $no_order = $order['no_order'] + 1;
                    $no_meja = mysqli_query($koneksi, "SELECT * FROM tb_meja WHERE status != 1");
                    $list_pesanan = mysqli_query($koneksi, "SELECT * FROM tb_detail_order WHERE id_order = 'ORD000$no_order' AND id_user = '$_SESSION[id_user]'");
                    $nono = 'ORD000' . $no_order;
                    $q_hartot = mysqli_query($koneksi, "SELECT sum(dorder_hartot) as hartot FROM tb_detail_order WHERE id_order = '$nono'");
                    $hartot = mysqli_fetch_assoc($q_hartot);
                    ?>
                    <form action="order/tambah_order.php" method="POST">

                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Order No</label>
                                        <input type="text" class="form-control" name="id_order" readonly value="ORD000<?= $no_order ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="">No Meja</label>
                                        <select name="meja" class="form-control text-small" required>
                                            <option selected value="0">-- Pilih no meja --</option>
                                            <?php foreach ($no_meja as $r_nmeja) : ?>
                                                <option value="<?= $r_nmeja['meja_id'] ?>"><?= $r_nmeja['meja_id'] ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Keterangan</label>
                                        <textarea name="keterangan" class="form-control text-small"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <p>List Pesanan</p>
                                    <div class="table-responsive" style="height:400px;overflow-y:scroll;">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th width="10">No</th>
                                                    <th>Nama</th>
                                                    <th width="170">Deskripsi</th>
                                                    <th width="100">Harga</th>
                                                    <th width="50">Jml</th>
                                                    <th width="130">Harga Akhir</th>
                                                    <th width="10">Option</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $no = 1;
                                                foreach ($list_pesanan as $list_row) :
                                                    $masakan = mysqli_query($koneksi, "SELECT * FROM masakan WHERE id_masakan = '$list_row[id_masakan]' ");
                                                    $q_masakan = mysqli_fetch_assoc($masakan);
                                                ?>
                                                    <tr>
                                                        <td><?= $no ?></td>
                                                        <td><?= $q_masakan['nama_masakan'] ?></td>
                                                        <td><?= $list_row['dorder_keterangan'] ?></td>
                                                        <td>Rp. <?= rupiah($q_masakan['harga']) ?></td>
                                                        <td><?= $list_row['dorder_jumlah'] ?></td>
                                                        <td>Rp. <?= rupiah($q_masakan['harga'] * $list_row['dorder_jumlah']) ?></td>
                                                        <td><a href="order/hapus_pesan.php?id=<?= $list_row['dorder_id'] ?>" onclick="return confirm('Apakah anda yakin ?')" class="btn btn-sm btn-danger text-small">Hapus</a></td>
                                                    </tr>
                                                <?php $no++;
                                                endforeach; ?>
                                                <tr>
                                                    <td colspan="7">
                                                        Total Harga : Rp. <?= rupiah($hartot['hartot']) ?>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary text-small" data-dismiss="modal">Tutup <i class="fas fa-times"></i></button>
                            <button type="submit" class="btn btn-primary text-small">Proses <i class="fas fa-check"></i></button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    <?php endif; ?>
  <?php } ?>
  </div>
</div> 