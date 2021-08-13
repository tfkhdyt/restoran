<?php
$koneksi = mysqli_connect("0.0.0.0","root","root","restoran");
if (mysqli_connect_errno()){
	echo"Koneksi database gagal : ".mysqli_connect_error();
}
?>