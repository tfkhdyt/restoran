<div class="container"><br>
  <div class="row">
		<div class="col-md-12">
      		<h2>Order Makanan</h2>
    	</div>
	</div>	
	
	<div class="row">
		<div class="col-md-12">
			<table id="myTable" class="table table-bordered table-hover">
          <thead>
            <tr>
              <th>No</th>
              <th>Produk</th>
              <th>Nama Produk</th>
              <th>Nomor Meja</th>
              <th>Jumlah</th>
              <th>Harga</th>
              <th>Sub Total</th>
            </tr>
          </thead>
          <tbody>
          	<form action="proses/proses_entri_order.php" method="post">
          	<?php  
			         include "koneksi.php";
			         include "rupiah.php";
			         $id_masakan = $_GET['id_masakan'];
			         $query = "SELECT * FROM masakan WHERE id_masakan = '$id_masakan'";
			         $result = mysqli_query($koneksi, $query);
			         while($data = mysqli_fetch_assoc($result))
			         {
			     ?>
            <tr>
              <td><?php $i = 1; echo $i; ?>
              	<input type="hidden" name="id_masakan" value="<?= $data['id_masakan'];  ?>">
              </td>
              <td><img height="100" src="asset/gambar/makanan/<?= $data['foto']; ?>"></td>
              <td><?= $data['nama_masakan'];  ?>
              	<input type="hidden" name="nama_masakan" value="<?= $data['nama_masakan'];  ?>">
              </td>
              <td>
              	<select name="no_meja" class="form-control">
              		<option value="-">-</option>
              		<option value="1">1</option>
              		<option value="2">2</option>
              		<option value="3">3</option>
              		<option value="4">4</option>
              		<option value="5">5</option>
              		<option value="6">6</option>
              		<option value="7">7</option>
              		<option value="8">8</option>
              		<option value="9">9</option>
              		<option value="10">10</option>
              	</select>
              </td>
              <td><input class="form-control col-sm-3" type="text" name="jumlah" id="txt1" onkeyup="sum();" value="1"></td>
              <td><input readonly class="form-control" type="text" name="harga" id="txt2" onkeyup="sum();" value="<?php if($_SESSION['id_level'] == ''){ echo $data['harga'] + 5000; }else{echo $data['harga'];}?>"></td>
              <td>
              	<input readonly class="form-control" name="subtotal" id="txt3" value="<?php if($_SESSION['id_level'] == ''){ echo $data['harga'] + 5000; }else{echo $data['harga'];}?>">
              </td>
            </tr>
            <?php } $i++;?>
            
          </tbody>
        </table><br>
        <button class="btn btn-primary float-right" type="submit">Tambah ke Cart</button>
        </form>
		</div>
	</div>

	<script>
		function sum(){
			var txtFirstNumberValue = document.getElementById('txt1').value;
			var txtSecondNumberValue = document.getElementById('txt2').value;
			var result = (parseInt(txtFirstNumberValue) * parseInt(txtSecondNumberValue));
			if (!isNaN(result)) {
				document.getElementById('txt3').value = result;
			}
		}
	</script>
	
  