<?php
session_start();
include 'koneksi.php';
$id_pembelian = $_GET["id"];

$ambil = $koneksi->query("SELECT * FROM pembayaran
	LEFT JOIN pembelian ON pembayaran.id_pembelian=pembelian.id_pembelian
	WHERE pembelian.id_pembelian='$id_pembelian'");
$detbay = $ambil->fetch_assoc();

//jika belum ada data pembayaran
if (empty ($detbay))
{
	echo "<script>alert('belum ada data pembayaran')</script>";
	echo "<script>location='riwayat.php';</script>";
	exit();
}

//jika data pelanggan tidak sesuai dengan yang login

if ($_SESSION["pelanggan"]["id_pelanggan"]!==$detbay["id_pelanggan"])
 {
	echo "<script>alert('anda tidak berhak melihat pembayaran orang lain')</script>";
	echo "<script>location='riwayat.php';</script>";
	exit();
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Bukti pembayaran</title>
	<link rel="stylesheet" href="admin/assets/css/bootstrap.css">
</head>
<body>
<?php include 'menu.php'; ?>
<div class="container">
<h3>Bukti Pembayaran</h3><hr>
<div class="row">
	<div class="col-md-12">
		<div align="justify">
		<table class="table table-bordered table-hover">
		<div class="table table-image">
		<thead>
		<tr class="info">
			<th scope="col" class="text-center">Nama </th>
			<th scope="col" class="text-center">Bank </th>
			<th scope="col" class="text-center">Tanggal </th>
			<th scope="col" class="text-center">Jumlah </th>
			<th scope="col" class="text-center">Bukti </th>
		</tr>
		</thead>
		<tbody>
		<tr>
<td class="text-center"><?php echo $detbay["nama"] ?></td>
<td class="text-center"><?php echo $detbay["bank"] ?></td>
<td class="text-center"><?php echo $detbay["tanggal"] ?></td>
<td class="text-center">Rp. <?php echo number_format($detbay["jumlah"]) ?></td>
<td>
<center>
<img src="bukti_pembayaran/<?php echo $detbay["bukti"] ?>" class="img-fluid img-thumbnail" width="200" height="200">
</td></center>
</tr>
</tbody>
</table>
</div>
</div>
</div>
<a href="riwayat.php" class="btn btn-default">Kembali</a>
</body>
</html>