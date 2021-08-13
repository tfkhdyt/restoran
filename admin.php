<!DOCTYPE html>
<html>
<head>
	<title>Halaman Admin | Warung Meetball</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
</head>
<body>
  
<?php
    session_start();
    include "koneksi.php";
    include "rupiah.php";
    if($_SESSION['id_level']==""){
      header("location:login.php?pesan=alert");
    }
    include "navbar_admin.php";
    if(isset($_GET['menu'])){
      if($_GET['menu']=="daftar_makanan"){
        include "daftar_makanan.php";
      }else if($_GET['menu']=="generate_laporan"){
        include "generate_laporan.php";
      }else if($_GET['menu']=="daftar_order"){
      include "daftar_order.php";
      }else if($_GET['menu']=="entri_transaksi"){
      include "entri_transaksi.php";
      }else if($_GET['menu']=="daftar_minuman"){
        include "daftar_minuman.php";
      }
    }
  ?>
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








<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" ></script>
    

    <script type="text/javascript">
        AOS.init();
    $(document).ready(function() {
        $('#myTable').DataTable();
        $('#diskon').on('keyup', function() {
            let hartot = $('#hartot').val();
            let diskon = $('#diskon').val();
            let diskonAkhir = hartot * diskon / 100;
            let anjay = hartot - diskonAkhir;
            $('#totbayar').val(anjay);
        })
        $('#uang').on('keyup', function() {
            let totbar = $('#totbayar').val();
            let uang = $('#uang').val();
            let kembalian = uang - totbar;
            $('#kembalian').val(kembalian);
            if (uang == 0) {
                $('#kembalian').val('');
            }
        })
    } );
  </script>
</body>
</html>