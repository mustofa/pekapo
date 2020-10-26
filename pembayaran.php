<?php
session_start();
include 'koneksi.php';

//jika tidak ada session pelanggan(belum login)
if (!isset($_SESSION["pelanggan"]) OR empty($_SESSION["pelanggan"]))
{
   echo "<script>alert('silahkan login');</script>";
   echo "<script>location='login.php';</script>";
   exit();
}

//mendapatkan id_pembelian dari url
$idpem = $_GET["id"];
$ambil = $koneksi->query("SELECT * FROM pembelian WHERE id_pembelian='$idpem'");
$detpem = $ambil->fetch_assoc();
//mendapatkan id_pelanggan yang beli
$id_pelanggan_beli = $detpem["id_pelanggan"];
//mendapatkan id_pelanggan yang login
$id_pelanggan_login = $_SESSION["pelanggan"]["id_pelanggan"];
if ($id_pelanggan_login !== $id_pelanggan_beli)
{
	echo "<script>alert('jangan curang');</script>";
   echo "<script>location='riwayat.php';</script>";
   exit();
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Pembayaran</title>
	<link rel="stylesheet" href="admin/assets/css/bootstrap.css">
</head>
<body>
<?php include 'menu.php'; ?>
<div class="container">
	<h2>Konfirmasi Pembayaran</h2><hr>
	<p>kirim bukti pembayaran anda disini</p>
	<div class="alert alert-danger">total tagihan Anda <strong>Rp. <?php echo number_format($detpem["total_pembelian"]) ?></strong></div>

	<form method="post" enctype="multipart/form-data">
		<div class="form-group">
			<label>Nama Penyetor :</label>
			<input type="text" class="form-control" name="nama" required="">
		</div>
		<div class="form-group">
			<label>Bank :</label>
			<input type="text" class="form-control" name="bank" required="">
		</div>
		<div class="form-group">
			<label>Jumlah :</label>
			<input type="number" class="form-control" name="jumlah" min="1" required="">
		</div>
		<div class="form-group">
		<label>Foto Bukti :</label>
		<input type="file" class="form-control" name="bukti" required="">
	</div>
	<button class="btn btn-info" name="kirim"> Kirim</button>
	</form>
</div>

<?php
//jika ada tombol kirim
if (isset($_POST["kirim"]))
{
	//upload dulu foto bukti
	$namabukti = $_FILES["bukti"]["name"];
	$lokasibukti = $_FILES["bukti"]["tmp_name"];
	$namafiks =  date("YmdHis").$namabukti;
	move_uploaded_file($lokasibukti, "bukti_pembayaran/$namafiks");

		$nama = $_POST["nama"];
        $bank = $_POST["bank"];
        $jumlah = $_POST["jumlah"];
        $tanggal = date("Y-m-d");

        //simpan pembayaran
		$koneksi->query("INSERT INTO pembayaran(id_pembelian,nama,bank,jumlah,tanggal,bukti) VALUES ('$idpem','$nama','$bank','$jumlah','$tanggal','$namafiks')");

		//update dong pembeliannya dari pending menjadi sudah kirim pembayaran
		$koneksi->query("UPDATE pembelian SET status_pembelian='sudah kirim pembayaran' WHERE id_pembelian='$idpem'");
		echo "<script>alert('terimakasih sudah mengirimkan bukti pembayaran');</script>";
        echo "<script>location='riwayat.php';</script>";
   exit();
}
?>
</body>
</html>