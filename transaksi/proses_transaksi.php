<?php
session_start();
require '../koneksi.php';

$id_order = htmlspecialchars($_POST['id_order']);
$meja = htmlspecialchars($_POST['meja']);
$member = htmlspecialchars($_POST['member']);
$total_harga = htmlspecialchars($_POST['total_harga']);
$diskon = htmlspecialchars($_POST['diskon']);
$total_bayar = htmlspecialchars($_POST['total_bayar']);
$uang = htmlspecialchars($_POST['uang']);
$kembalian = htmlspecialchars($_POST['kembalian']);
$tanggal = time();
$tanggal2 = date('d-m-Y');

$q_detailOrder = mysqli_query($koneksi, "SELECT * FROM tb_detail_order WHERE id_order = '$id_order'");
foreach ($q_detailOrder as $detailOrder) {
    $q_bestSeller = mysqli_query($koneksi, "SELECT * FROM tb_best_seller WHERE masakan_id = '$detailOrder[masakan_id]'");
    $bestSeller = mysqli_fetch_array($q_bestSeller);
    $jumlah_bs = $bestSeller['jumlah_jual'] + $detailOrder['dorder_jumlah'];
    mysqli_query($koneksi, "UPDATE tb_best_seller SET jumlah_jual = '$jumlah_bs' WHERE masakan_id = '$detailOrder[masakan_id]'");
}
if ($uang < $total_bayar) {
    $_SESSION['pesan'] = '
            <div class="alert alert-danger mb-2 alert-dismissible text-small " role="alert">
            <b>Pembayaran gagal!</b> Uang kurang
            <button type="button" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times;</span></button>
            </div>
            ';
    header('Location:../admin.php?menu=entri_transaksi&meja=' . $meja);
} else {
    mysqli_query($koneksi, "UPDATE tb_order set order_status = 1 WHERE id_order = '$id_order'");

    mysqli_query($koneksi, "UPDATE tb_meja set status = 0 WHERE meja_id = '$meja'");

    $queryTambah = "INSERT INTO tb_transaksi VALUES(NULL, '$member', '$id_order', '$tanggal', '$tanggal2', '$total_harga', '$diskon', '$total_bayar', '$uang', '$kembalian')";
    $query = mysqli_query($koneksi, $queryTambah);
    if ($query > 0) {
        $_SESSION['pesan'] = '
                <div class="alert alert-success mb-2 alert-dismissible text-small " role="alert">
                <b>Berhasil!</b> Pembayaran berhasil <a href="print_struk.php?id_order=' . $id_order . '" target="_blank" class="btn ml-2 btn-sm text-small btn-outline-primary text-small">Print Struk <i class="fas fa-print"></i></a>
                <button type="button" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times;</span></button>
                </div>
                ';
        header('Location:../admin.php?menu=entri_transaksi');
    } else {
        $_SESSION['pesan'] = '
                <div class="alert alert-success mb-2 alert-dismissible text-small " role="alert">
                <b>Gagal!</b> Pembayaran gagal
                <button type="button" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times;</span></button>
                </div>
                ';
        header('Location:../admin.php?menu=entri_transaksi');
    }
}
