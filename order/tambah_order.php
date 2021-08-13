<?php
session_start();
require '../koneksi.php';
$meja = htmlspecialchars($_POST['meja']);
$id_order = htmlspecialchars($_POST['id_order']);
$keterangan = htmlspecialchars($_POST['keterangan']);
$id_user = $_SESSION['id_user'];
$tanggal = time();
$tanggal2 = date('d-m-Y');
if ($meja < 1) {
    $_SESSION['pesan'] = '
            <div class="alert alert-success mb-2 alert-dismissible text-small " role="alert">
            <b>Gagal!</b> Meja belum dipilih
            <button type="button" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times;</span></button>
            </div>
            ';
    header('Location:../admin.php?menu=daftar_makanan');
    return false;
}

mysqli_query($koneksi, "UPDATE tb_detail_order set dorder_status = 1 WHERE id_order = '$id_order'");

mysqli_query($koneksi, "UPDATE tb_meja set status = 1 WHERE meja_id = '$meja'");

$queryTambah = "INSERT INTO tb_order VALUES('$id_order', '$meja', '$tanggal', '$tanggal2', '$id_user', '$keterangan', 0)";
$query = mysqli_query($koneksi, $queryTambah);

if ($query > 0) {
    $_SESSION['pesan'] = '
            <div class="alert alert-success mb-2 alert-dismissible text-small " role="alert">
            <b>Berhasil!</b> Pesanan sedang di proses mohon tunggu sampai masakan matang
            <button type="button" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times;</span></button>
            </div>
            ';
    header('Location:../admin.php?menu=daftar_makanan');
} else {
    $_SESSION['pesan'] = '
            <div class="alert alert-success mb-2 alert-dismissible text-small " role="alert">
            <b>Gagal!</b> Pesanan gagal di proses
            <button type="button" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times;</span></button>
            </div>
            ';
    header('Location:../admin.php?menu=daftar_makanan');
}
