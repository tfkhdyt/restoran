<?php
session_start();
require '../koneksi.php';

$id_masakan = htmlspecialchars($_POST['id_masakan']);
$jumlah = htmlspecialchars($_POST['jumlah']);
$keterangan = htmlspecialchars($_POST['keterangan']);
$id_user = $_SESSION['id_user'];

$query_order = mysqli_query($koneksi, "SELECT count(id_order) as no_order FROM tb_order");
$order = mysqli_fetch_assoc($query_order);
$no_order = $order['no_order'] + 1;
$a_no = 'ORD000' . $no_order;
// var_dump($a_no);
// die;

$q_masakan = mysqli_query($koneksi, "SELECT * FROM masakan WHERE id_masakan = '$id_masakan'");
$masakan_harga = mysqli_fetch_assoc($q_masakan);
$hartot = $masakan_harga['harga'] * $jumlah;

$validasi_dupllikat_menu = mysqli_query($koneksi, "SELECT * FROM tb_detail_order WHERE id_masakan = '$id_masakan' AND check_available = '$no_order'");
$q_validasi = mysqli_fetch_assoc($validasi_dupllikat_menu);


if ($q_validasi > 0) {
    $_SESSION['pesan'] = '
        <div class="alert alert-danger mb-2 alert-dismissible text-small " role="alert">
        <b>Gagal!</b> Menu sudah ada dikeranjang
        <button type="button" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times;</span></button>
        </div>
        ';
    header('Location:../admin.php?menu=daftar_makanan');
    return false;
} else {
    $queryTambah = "INSERT INTO tb_detail_order VALUES(NULL, '$no_order', '$a_no', '$id_masakan',  '$keterangan', '$jumlah', '$hartot', '$id_user', 0)";
    $query = mysqli_query($koneksi, $queryTambah);

    if ($query > 0) {
        $_SESSION['pesan'] = '
            <div class="alert alert-success mb-2 alert-dismissible text-small " role="alert">
            <b>Berhasil!</b> Menu disimpan dikeranjang
            <button type="button" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times;</span></button>
            </div>
            ';
        header('Location:../admin.php?menu=daftar_makanan');
    } else {
        $_SESSION['pesan'] = '
            <div class="alert alert-success mb-2 alert-dismissible text-small " role="alert">
            <b>Gagal!</b> Menu gagal disimpan dikeranjang
            <button type="button" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times;</span></button>
            </div>
            ';
        header('Location:../admin.php?menu=daftar_makanan');
    }
}
