<?php  
include '../koneksi.php';
$nama_makanan = $_POST['nama'];
$deskripsi = $_POST['deskripsi'];
$harga = $_POST['harga'];
// $status_masakan = "Tersedia";
$foto = $_FILES['foto']['name'];
$kategori_masakan = $_POST['kategori_masakan'];


if ($foto != "") {
	$ekstensi_diperbolehkan = array('png', 'jpg');
	$x = explode('.', $foto);
	$ekstensi = strtolower(end($x));
	$file_tmp = $_FILES['foto']['tmp_name'];
	$angka_acak = rand(1,999);
	$nama_gambar_baru = $angka_acak.'-'.$foto;

	if (in_array($ekstensi, $ekstensi_diperbolehkan) === true) {
		move_uploaded_file($file_tmp, '../asset/gambar/Makanan/'.$nama_gambar_baru);
		$query = "INSERT INTO masakan VALUES ('', '$nama_makanan', '$deskripsi', '$harga', '1', '$nama_gambar_baru', '$kategori_masakan')";
        $result = mysqli_query($koneksi, $query);
        if(!$result){
        	die("Query gagal dijalankan : ".mysqli_errno($koneksi));
        }else if($kategori_masakan == 'Makanan'){
        	echo"<script>alert('Data berhasil ditambah.');window.location='../admin.php?menu=daftar_makanan';</script>";
		}else if($kategori_masakan == 'Minuman'){
        	echo"<script>alert('Data berhasil ditambah.');window.location='../admin.php?menu=daftar_minuman';</script>";
		}
	}else{
		echo"<script>alert('Ekstensi gambar yang boleh hanya jpg atau png.');window location='entri_makanan.php';</script>";
	}
	}else{
		$query ="INSERT INTO masakan VALUES ('', '$nama_makanan', '$deskripsi', '$harga', '1', null, '$kategori_masakan')";
	        $result = mysqli_query($koneksi, $query);
	        if(!$result){
	            die ("Query gagal dijalankan: ".mysqli_errno($koneksi)." - ".mysqli_error($koneksi));
	         } else {
	         	echo "<script>alert('Data berhasil ditambah.');window.location='../admin.php?menu=daftar_makanan';</script>";
	                  }

}
?>