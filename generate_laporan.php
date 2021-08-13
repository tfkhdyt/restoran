<?php

$transaksi = mysqli_query($koneksi, "SELECT * FROM tb_transaksi ORDER BY id_transaksi DESC");


?>
<section class="list-menu">
    <div class="container">
        <div class="card shadow-sm">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <h3>Generate Laporan</h3>
                                <?php if (isset($_SESSION['pesan'])) : ?>
                                    <?= $_SESSION['pesan'] ?>
                                <?php
                                    unset($_SESSION['pesan']);
                                endif;
                                ?>
                                <a href="semua_laporan.php" target="_blank" class="btn btn-sm btn-primary py-2 px-3 text-small">
                                    Cetak Semua Laporan
                                </a>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-hover" id="myTable">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>No Order</th>
                                                <th>No Meja</th>
                                                <th>Member</th>
                                                <th>Tanggal Transaksi</th>
                                                <th>Total Bayar</th>
                                                <th>Diskon</th>
                                                <th>Total Bayar (Diskon)</th>
                                                <th>Option</th>
                                            </tr>

                                        </thead>
                                        <tbody>
                                            <?php $i = 1;
                                            foreach ($transaksi as $orow) :
                                                $user_query =  mysqli_query($koneksi, "SELECT * FROM user WHERE id_user = '$orow[id_user]'");
                                                $usr = mysqli_fetch_assoc($user_query);
                                                $order_query =  mysqli_query($koneksi, "SELECT * FROM tb_order WHERE id_order = '$orow[id_order]'");
                                                $oq = mysqli_fetch_assoc($order_query);

                                            ?>
                                                <tr class="text-small">
                                                    <td><?= $i; ?></td>
                                                    <td><?= $orow['id_order'] ?></td>
                                                    <td><?= $oq['order_meja'] ?></td>
                                                    <td><?= $usr['nama_user'] ?></td>
                                                    <td><?= date('d-m-Y H:i', $orow['transaksi_tanggal']) ?></td>
                                                    <td>Rp. <?= rupiah($orow['transaksi_hartot']) ?></td>
                                                    <td><?= $orow['transaksi_diskon'] ?>%</td>
                                                    <td>Rp. <?= rupiah($orow['transaksi_totbar']) ?></td>
                                                    <td>
                                                        <a href="print_struk.php?id_order=<?= $orow['id_order'] ?>" target="_blank" class="btn btn-primary text-white btn-sm text-small">Print</a>
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