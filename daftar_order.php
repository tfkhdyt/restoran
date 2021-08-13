
<section class="list-menu">
    <div class="container">
        <div class="card shadow-sm">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <h3>Daftar Order</h3>
                                <?php if (isset($_SESSION['pesan'])) : ?>
                                    <?= $_SESSION['pesan'] ?>
                                <?php
                                    unset($_SESSION['pesan']);
                                endif;
                                ?>
                                
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-hover" id="myTable">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>No Order</th>
                                                <th>No Meja</th>
                                                <th>Tanggal Order</th>
                                                <th>Total Bayar</th>
                                                <th>Keterangan</th>
                                                <th>Option</th>
                                            </tr>

                                        </thead>
                                        <tbody>
                                            <?php $i = 1;
                                            $order = mysqli_query($koneksi, "SELECT * FROM tb_order WHERE order_status = 0 ORDER BY id_order DESC");
                                            foreach ($order as $orow) :
                                                $user_query =  mysqli_query($koneksi, "SELECT * FROM user WHERE id_user = '$orow[id_user]'");
                                                $usr = mysqli_fetch_assoc($user_query);
                                                $q_hartot = mysqli_query($koneksi, "SELECT sum(dorder_hartot) as hartot FROM tb_detail_order WHERE id_order = '$orow[id_order]'");
                                                $hartot = mysqli_fetch_assoc($q_hartot);
                                            ?>
                                                <tr class="text-small">
                                                    <td><?= $i; ?></td>
                                                    <td><?= $orow['id_order'] ?></td>
                                                    <td><?= $orow['order_meja'] ?></td>
                                                    <td><?= date('d-m-Y H:i', $orow['order_tanggal']) ?></td>
                                                    <td>Rp. <?= rupiah($hartot['hartot']) ?></td>
                                                    <td><?= $orow['order_keterangan'] ?></td>

                                                    <td>
                                                        <a href="order/hapus_order.php?id=<?= $orow['id_order'] ?>" class="btn btn-danger btn-sm text-small" onclick="return confirm('Yakin ingin menghapus data ini ?')">Hapus</a>
                                                        <button type="button" title="Detail Order" class="btn btn-sm btn-secondary text-small text-white" data-toggle="modal" data-target="#detailOrder_<?= $orow['id_order'] ?>">Lihat</button>
                                                        <?php if ($orow['order_status'] == 1) : ?>
                                                            <a href="print_struk.php?id_order=<?= $orow['id_order'] ?>" target="_blank" class="btn btn-warning text-white btn-sm text-small"><i class="fas fa-print"></i></a>
                                                        <?php endif; ?>
                                                    </td>
                                                </tr>
                                            <?php $i++;
                                            endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
</section>
<!-- modal -->
<?php foreach ($order as $detRow) : ?>
    <div class="modal fade" id="detailOrder_<?= $detRow['id_order'] ?>" tabindex="1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <b class="modal-title">List Pesanan</b>
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?php
                    $detail_order = mysqli_query($koneksi, "SELECT * FROM tb_detail_order WHERE id_order = '$detRow[id_order]'");
                    $q_hartot = mysqli_query($koneksi, "SELECT sum(dorder_hartot) as hartot FROM tb_detail_order WHERE id_order = '$detRow[id_order]'");
                    $hartot = mysqli_fetch_assoc($q_hartot);
                    ?>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive" style="height:400px;overflow-y:scroll;">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th width="10">No</th>
                                            <th>Foto</th>
                                            <th>Nama</th>
                                            <th width="200">Deskripsi</th>
                                            <th>Harga</th>
                                            <th width="10">Jumlah</th>
                                            <th>Harga Akhir</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no = 1;
                                        foreach ($detail_order as $list_row) :
                                            $masakan = mysqli_query($koneksi, "SELECT * FROM masakan WHERE id_masakan = '$list_row[id_masakan]' ");
                                            $q_masakan = mysqli_fetch_assoc($masakan);

                                        ?>
                                            <tr>
                                                <td><?= $no ?></td>
                                                <td><img height="100" src="asset/gambar/Makanan/<?= $q_masakan['foto'] ?>"></td>
                                                <td><?= $q_masakan['nama_masakan'] ?></td>
                                                <td><?= $list_row['dorder_keterangan'] ?></td>
                                                <td>Rp. <?= rupiah($q_masakan['harga']) ?></td>
                                                <td><?= $list_row['dorder_jumlah'] ?></td>
                                                <td>Rp. <?= rupiah($q_masakan['harga'] * $list_row['dorder_jumlah']) ?></td>
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
            </div>
        </div>
    </div>
<?php endforeach; ?>
<script type="text/javascript">
  $(document).ready( function () {
    $('#myTable').DataTable();
} );
</script>