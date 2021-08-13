<?php

if (isset($_GET['meja'])) {
    $q_order = mysqli_query($koneksi, "SELECT * FROM tb_order WHERE order_meja = '$_GET[meja]' ORDER BY id_order DESC");
    $order = mysqli_fetch_assoc($q_order);
    $detail_order = mysqli_query($koneksi, "SELECT * FROM tb_detail_order WHERE id_order = '$order[id_order]'");
}

$member = mysqli_query($koneksi, "SELECT * FROM user WHERE id_level = 5");
// $ses = $_SESSION['role'];

// if ($ses == 1 || $ses == 3 || $ses == 5) {
//     header('Location:hayuu.php');
// }


?>
<section class="list-menu">
    <div class="container">
        <div class="card shadow-sm">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <?php if (isset($_SESSION['pesan'])) : ?>
                                    <?= $_SESSION['pesan'] ?>
                                <?php
                                    unset($_SESSION['pesan']);
                                endif;
                                ?>
                                <?php if (isset($_GET['meja'])) : ?>
                                    <span class="text-small mr-3">No Order : <?= $order['id_order'] ?></span><br>
                                    <span class="text-small mr-3">No Meja : <?= $order['order_meja'] ?></span><br>
                                    <span class="text-small mr-3">Tanggal Pesan : <?= date('d-m-Y', $order['order_tanggal']) ?></span><br>
                                    <span class="text-small mr-3">Keterangan : <?= $order['order_keterangan'] ?></span>
                                <?php endif; ?>
                                <div class="row mt-4">
                                    <div class="col-md-8">
                                        <div class="table-responsive">
                                            <table class="table table-hover" id="myTable">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Nama Masakan</th>
                                                        <th>Jumlah</th>
                                                        <th>Harga</th>
                                                        <th>Harga Total</th>
                                                    </tr>

                                                </thead>
                                                <?php if (isset($_GET['meja'])) : ?>
                                                    <tbody>
                                                        <?php $i = 1;
                                                        foreach ($detail_order as $orow) :
                                                            $q_masakan = mysqli_query($koneksi, "SELECT * FROM masakan WHERE id_masakan = '$orow[id_masakan]'");
                                                            $masakan = mysqli_fetch_assoc($q_masakan);
                                                        ?>
                                                            <tr class="text-small">
                                                                <td><?= $i; ?></td>
                                                                <td><?= $masakan['nama_masakan'] ?></td>
                                                                <td><?= $orow['dorder_jumlah'] ?></td>
                                                                <td>Rp. <?= rupiah($masakan['harga']) ?></td>
                                                                <td>Rp. <?= rupiah($masakan['harga'] * $orow['dorder_jumlah']) ?></td>
                                                            </tr>

                                                        <?php $i++;
                                                        endforeach; ?>

                                                    </tbody>
                                                <?php else : ?>
                                                    <tbody></tbody>
                                                <?php endif; ?>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <form action="transaksi/proses_transaksi.php" method="POST">
                                            <?php
                                            $its_kursi = mysqli_query($koneksi, "SELECT * FROM tb_meja WHERE status != 0");

                                            ?>

                                            <div class="form-group">
                                                <label for="">No Meja</label>
                                                <select class="form-control text-small" onchange='location=this.value' required>
                                                    <option selected disabled>-- Nomor Meja --</option>
                                                    <?php if (isset($_GET['meja'])) : ?>

                                                        <?php foreach ($its_kursi as $it_rk) : ?>
                                                            <option value="admin.php?menu=entri_transaksi&meja=<?= $it_rk['meja_id'] ?>" <?= $it_rk['meja_id'] == $_GET['meja'] ? 'selected' : '' ?>><?= $it_rk['meja_id'] ?></option>
                                                        <?php endforeach; ?>
                                                    <?php else : ?>
                                                        <?php foreach ($its_kursi as $it_rk) : ?>
                                                            <option value="admin.php?menu=entri_transaksi&meja=<?= $it_rk['meja_id'] ?>"><?= $it_rk['meja_id'] ?></option>
                                                        <?php endforeach; ?>
                                                    <?php endif; ?>
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label for="">Member</label>
                                                <select name="member" class="form-control text-small">
                                                    <option selected value=""></option>
                                                    <?php foreach ($member as $m) : ?>
                                                        <option value="<?= $m['id_user'] ?>"><?= $m['nama_user'] ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="">Total Harga</label>
                                                <?php
                                                if (isset($_GET['meja'])) {
                                                    $q_hartot = mysqli_query($koneksi, "SELECT sum(dorder_hartot) as hartot FROM tb_detail_order WHERE id_order = '$order[id_order]'");
                                                    $hartot = mysqli_fetch_assoc($q_hartot);
                                                    $toto = $hartot['hartot'];
                                                    $id_order = $order['id_order'];
                                                    $meja_url = $_GET['meja'];
                                                } else {
                                                    $meja_url = '';
                                                    $toto = '';
                                                    $id_order = '';
                                                }
                                                ?>
                                                <input type="hidden" name="meja" value="<?= $meja_url ?>">
                                                <input type="hidden" name="id_order" value="<?= $id_order ?>">

                                                <input type="text" name="total_harga" readonly required value="<?= $toto ?>" class="form-control" id="hartot" placeholder="Total Harga">
                                            </div>
                                            <div class="form-group">
                                                <label for="">Diskon</label>
                                                <input type="number" class="form-control" id="diskon" min="0" max="100" name="diskon" value="0" placeholder="Diskon">
                                            </div>
                                            <div class="form-group">
                                                <label for="">Total Bayar</label>

                                                <input type="number" readonly class="form-control" id="totbayar" required value="<?= $toto ?>" name="total_bayar" placeholder="Total Bayar">
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <input type="number" min="1" class="form-control" id="uang" required name="uang" placeholder="Uang">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <input type="number" readonly class="form-control" id="kembalian" required name="kembalian" placeholder="Kembalian">
                                                    </div>
                                                </div>
                                            </div>
                                            <button class="btn btn-block btn-btn-sm btn-primary text-small">Bayar <i class="fas fa-money-bill"></i></button>
                                        </form>
                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
</section>
<script src="https://unpkg.com/aos@next/dist/aos.js"></script>
<script>
    AOS.init();
    $(document).ready(function() {
        $('#myTable').DataTable();

        
    })
</script>
