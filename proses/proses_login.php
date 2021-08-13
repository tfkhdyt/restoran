<?php
session_start();
include '../koneksi.php';
$username= $_POST['username'];
$password= $_POST['password'];

$login= mysqli_query($koneksi,"select * from user where username='$username' and password='$password'");

$cek = mysqli_num_rows($login);

if($cek > 0){
	$data = mysqli_fetch_assoc($login);
	if($data["id_level"]=="1"){
		$_SESSION['id_level'] = $data['id_level'];
		$_SESSION['id_user'] = $data['id_user'];
		header("location:../admin.php?menu=daftar_makanan");
	}else if($data["id_level"]=="2"){
		$_SESSION['id_level'] = $data['id_level'];
		$_SESSION['id_user'] = $data['id_user'];
		header("location:../waiter.php?menu=daftar_makanan");
	}else if($data['id_level']=="3"){
		$_SESSION['id_level'] = $data['id_level'];
		$_SESSION['id_user'] = $data['id_user'];
		header("location:../kasir.php?menu=entri_transaksi");
	}else if($data['id_level']=="4"){
		$_SESSION['id_level'] = $data['id_level'];
		$_SESSION['id_user'] = $data['id_user'];
		header("location:../owner.php?menu=generate_laporan");
	}else if($data['id_level']=="5"){
		$_SESSION['id_level'] = $data['id_level'];
		$_SESSION['id_user'] = $data['id_user'];
		header("location:../pelanggan.php?menu=daftar_makanan");
	}else{
		header("location:../login.php?pesan=gagal");
	}
}else{
	header("location:../login.php?pesan=gagal");
}
?>