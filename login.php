<?php
session_start();
include 'koneksi.php';?>
<!DOCTYPE html>
<html>
<head>
	<title>Login Pelanggan</title>
	<link rel="stylesheet" href="admin/assets/css/bootstrap.css">
</head>
<body>
<style>
  .panel-heading {
    text-align: center;
    background-color: #808080 !important;
}
   .masuk {
  	color: white;
  }
</style>
<!-- navbar -->
<?php include 'menu.php'; ?>

<div class="container">
	<div class="row">
	<div class="col-md-4 col-md-offset-4">
		<div class="panel panel-default">
			<div class="panel-heading">
				<div class="panel-title text-center">
					<label class="masuk">Masuk</label>
				</div>
			</div>
	<div class="panel-body">
	<form method="post">
	<div class="form-group">
		<label>Email :</label>
	<input type="email" class="form-control" required name="email">
	</div>
	<div class="form-group">
		<label>Password :</label>
		<input type="password" class="form-control" required name="password">
	</div>
	<button class="btn btn-info btn-block" name="login">Masuk</button>
	<br>
	<p>Daftar sebagai pelanggan ? <a href="daftar.php" style="text-decoration: none;"><b>Daftar</b></a></p>
</form>
</div>
</div>
</div>
</div>
</div>

<?php 
//jika ada tombol login(tombol login ditekan)
if (isset($_POST["login"]))
{

	$email = $_POST["email"];
	$password = $_POST["password"];
//lakukan kuery ngecek akun di tabel pelanggan di db
	$ambil = $koneksi->query("SELECT * FROM Pelanggan
		WHERE email_pelanggan='$email' AND password_pelanggan='$password'");
//ngitung akun yang terambil
	$akunyangcocok = $ambil->num_rows;
//jika 1 akun yang cocok, maka diloginkan
	if ($akunyangcocok==1)
	{
      //anda sukses login
	  //mendapatkan akun dalam bentuk array
		$akun = $ambil->fetch_assoc();
	 //simpan di session pelanggan
		$_SESSION["pelanggan"] = $akun;
		echo "<script>alert('login berhasil');</script>";

		//jika sudah belanja
		if (isset($_SESSION["keranjang"])OR !empty($_SESSION["keranjang"]))
		{
           echo "<script>location='checkout.php';</script>";
		}
		else
		{
           echo "<script>location='riwayat.php';</script>";
		}
		
	}
	else
	{
		//anda gagal login
		echo "<script>alert('anda gagal login');</script>";
		echo "<script>location='login.php';</script>";
	}
}

?>

</body>
</html>