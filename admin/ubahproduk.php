<h3>Ubah Produk</h3><hr>
<?php
$ambil=$koneksi->query("SELECT * FROM produk WHERE id_produk='$_GET[id]'");
$pecah= $ambil->fetch_assoc();
?>

<form method="POST" enctype="multipart/form-data">
	<div class="form-group">
		<label>Nama Produk :</label>
		<input type="text" required name="nama" class="form-control" value="<?php echo $pecah
		['nama_produk']; ?>">
	</div>
	<div class="form-group">
		<label>Harga Rp :</label>
		<input type="number" required name="harga" class="form-control" value="<?php echo $pecah
		['harga_produk']; ?>">
	<div class="form-group">
		<label>Stok :</label>
		<input type="number" required name="stok" class="form-control" value="<?php echo $pecah
		['stok_produk']; ?>">
	</div>
	<div class="form-group">
		<label>Berat (gr) :</label>
		<input type="number" required name="berat" class="form-control" value="<?php echo $pecah
		['berat_produk']; ?>">
	</div>
	<div class="form-group"></div>
	<img src="../foto_produk/<?php echo $pecah['foto_produk'] ?>" width="100">
	</div>
	<div class="form-group">
		<label>Ganti Foto :</label>
		<input type="file" class="form-control">
	</div>
	<div class="form-group">
		<label>Deskripsi :</label>
		<textarea name="deskripsi" class="form-control rows="10><?php echo $pecah['deskripsi_produk']; ?></textarea>
	</div>
	<button class="btn btn-primary btn-lg fa fa-edit" name="ubah"> Ubah</button>
</form>

<?php
if (isset($_POST['ubah']))
{
	$namafoto=$_FILES['foto']['name'];
	$lokasifoto = $_FILES['foto']['tmp_name'];
	//Jika foto dirubah
	if (!empty($lokasifoto))
	{
      move_uploaded_file($lokasifoto, "../foto_produk/$namafoto" );

      $koneksi->query("UPDATE produk SET nama_produk='$_POST[nama]',
harga_produk='$_POST[harga]',stok_produk='$_POST[stok]',berat_produk='$_POST[berat]',
foto_produk='$namafoto',deskripsi_produk='$_POST[deskripsi]'
WHERE id_produk='$_GET[id]'");   
	}
	else
	{
      $koneksi->query("UPDATE produk SET nama_produk='$_POST[nama]',
harga_produk='$_POST[harga]',stok_produk='$_POST[stok]',berat_produk='$_POST[berat]',deskripsi_produk='$_POST[deskripsi]' 
WHERE id_produk='$_GET[id]'");
	}
	echo "<script>alert('Data produk telah diubah');</script>";
	echo "<script>location='index.php?halaman=produk';</script>"; 
}
?>