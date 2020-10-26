<h3>Tambah Produk</h3><hr>

<form method="post" enctype="multipart/form-data">
	<div class="form-group">
		<label>Nama</label>
		<input type="text" class="form-control" required name="nama">
	</div>
	<div class="form-group">
		<label>Harga (Rp)</label>
		<input type="number" class="form-control" required name="harga">
	</div>
	<div class="form-group">
		<label>Stok</label>
		<input type="number" class="form-control" required name="stok">
	</div>
	<div class="form-group">
		<label>Berat (gr)</label>
		<input type="number" class="form-control" required name="berat">
	</div>
	<div class="form-group">
		<label>Deskripsi</label>
		<textarea class="form-control" required name="deskripsi" rows="8"></textarea>
	</div> 
    <div class="form-group">
    	<label>Foto</label>
    	<input type="file" class="form-control" required name="foto">
    </div>
    <button class="btn btn-primary btn-lg fa fa-save" name="save"> Simpan</button>
</form>

<?php
if (isset($_POST['save']))
{
	$nama = $_FILES['foto']['name'];
	$lokasi =$_FILES['foto']['tmp_name'];
	move_uploaded_file($lokasi, "../foto_produk/" .$nama);
	$koneksi->query("INSERT INTO produk
		(nama_produk,harga_produk,stok_produk,berat_produk,foto_produk,deskripsi_produk)
		VALUES('$_POST[nama]','$_POST[harga]','$_POST[stok]','$_POST[berat]','$nama','$_POST[deskripsi]')");

	echo "<script>alert('Data telah disimpan');</script>";
	echo "<meta http-equiv='refresh' content='1;url=index.php?halaman=produk'>";
}

?>
