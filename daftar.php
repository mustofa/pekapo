<?php include 'koneksi.php'; ?>
<!DOCTYPE html>
<html>
<head>
	<title>Daftar Pelanggan</title>
	<link rel="stylesheet" href="admin/assets/css/bootstrap.css">
</head>
<body>
<style>
  .panel-heading {
    text-align: center;
    background-color: #808080 !important;
}
  .pelanggan {
  	color: white;
  }
</style>
<!-- navbar -->
<?php include 'menu.php'; ?>

<div class="container">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">
					<div class="panel-title text-center" style="font color: white">
						<label class="pelanggan">Pelanggan baru</label>
					</div>
				</div>
<div class="panel-body">
	<form method="post" class="form-horizontal">
		<div class="form-group">
			<label class="col-md-3 control-label">Nama :</label>
			<div class="col-md-7">
				<input type="text" class="form-control" name="nama" required>
			</div>
		</div>
		<div class="form-group">
			<label class="col-md-3 control-label">Email :</label>
			<div class="col-md-7">
				<input type="email" class="form-control" name="email" required>
			</div>
		</div>
		<div class="form-group">
			<label class="col-md-3 control-label">Password :</label>
			<div class="col-md-7">
				<input type="password" class="form-control" name="password" required>
			</div>
		</div>
		<div class="form-group">
			<label class="col-md-3 control-label">Alamat :</label>
			<div class="col-md-7">
				<textarea name="alamat" rows="2" class="form-control" style="resize: none;" required></textarea>
			</div>
		</div>
		<div class="form-group">
			<label class="col-md-3 control-label">No. Telp :</label>
			<div class="col-md-7">
				<input type="number" class="form-control" name="telepon" required>
			</div>
		</div>
		<div class="form-group">
			<div class="col-md-7 col-md-offset-3">
				<button class="btn btn-info btn-block btn-md" name="daftar">Daftar</button>
			</div>
		</div>
	</form>

	<?php
	//jika ada tombol daftar(ditekan tombol daftar)
	if (isset($_POST["daftar"]))
	{
		//mengambil isian nama, email, password, telepon, alamat
		$nama = $_POST["nama"];
		$email = $_POST["email"];
		$password = $_POST["password"];
		$alamat = $_POST["alamat"];
		$telepon = $_POST["telepon"];
		
		//cek apakah email sudah digunakan
		$ambil = $koneksi->query("SELECT*FROM pelanggan WHERE email_pelanggan='$email'");
		$yangcocok = $ambil->num_rows;
		if ($yangcocok==1)
			{
				echo "<script>alert('pendaftaran gagal, email sudah digunakan');</script>";
				echo "<script>location='daftar.php';</script>";
			}
			else
			{
			//query insert ke tabel pelanggan
				$koneksi->query("INSERT INTO pelanggan
					(email_pelanggan,password_pelanggan,nama_pelanggan,telepon_pelanggan,alamat_pelanggan)
				VALUES('$email','$password','$nama','$telepon','$alamat') ");
		
			echo "<script>alert('pendaftaran berhasil, silahkan login');</script>";
			echo "<script>location='login.php';</script>";
			}
		}
	
	?>
</div>
</div>
</div>
</div>
</div>
</body>
</html>