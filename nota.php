<?php 
session_start();
include 'koneksi.php'; ?>
<!DOCTYPE html>
<html>
<head>
	<title>Nota Pembelian</title>
	<link rel="stylesheet" href="admin/assets/css/bootstrap.css">
</head>
<body>
	<script>
function myFunction() {
  window.print();
}
</script>
<style>
	@media print {
  #printPageButton {
    display: none;
  }
}
</style>

<!-- navbar -->
<?php include 'menu.php'; ?>

	<section class="konten">
	<div class="container">
<h2>Detail Pembelian</h2><hr>
<?php
$ambil = $koneksi->query("SELECT * FROM pembelian JOIN pelanggan
	ON pembelian.id_pelanggan=pelanggan.id_pelanggan
	WHERE pembelian.id_pembelian='$_GET[id]'");
$detail = $ambil->fetch_assoc();
?>

<!-- jika pelanggan yang beli tidak sama dengan pelanggan yang lain, maka dilarikan ke riwayat.php karena dia tidak berhak melihat nota orang lain-->
<!-- pelanggan yg beli harus pelanggan yang login -->
<?php
// mendapatkan id_pelanggan yang beli
$idpelangganyangbeli = $detail["id_pelanggan"];
// mendapatkan id_pelanggan yg login
$idpelangganyanglogin = $_SESSION["pelanggan"]["id_pelanggan"];
if ($idpelangganyangbeli!==$idpelangganyanglogin)
{
	echo "<script>alert('jangan nakal');</script>";
	echo "<script>location='riwayat.php';</script>";
	exit();
}
?>

	<div class="row">
		<div class="col-md-4">
			<h3>Pembelian</h3>
	<strong>No. Pembelian : <?php echo $detail['id_pembelian'] ?></strong><br>
	Tanggal : <?php echo $detail['tanggal_pembelian']; ?> <br>
	Total Tagihan : Rp. <?php echo number_format($detail['total_pembelian']) ?>
		</div>
		<div class="col-md-4">
			<h3>Pelanggan</h3>
			<strong><?php echo $detail['nama_pelanggan']; ?> </strong><br>
			<p>
	    <?php echo $detail['telepon_pelanggan']; ?> <br>
	    <?php echo $detail['email_pelanggan']; ?>
     </p>		
</div>
<div class="col-md-4">
	<h3>Pengiriman</h3>
	<strong><?php echo $detail['nama_kota'] ?></strong><br>
	Ongkos Kirim : Rp. <?php echo number_format($detail['tarif']); ?><br>
	Alamat : <?php echo $detail['alamat_pengiriman'] ?>
</div>
</div>
	<table class="table table-bordered table-hover">
		<thead>
			<tr class="info">
				<th class="text-center">No</th>
				<th class="text-center">Nama Produk</th>
				<th class="text-center">Harga</th>
				<th class="text-center">Ukuran</th>
				<th class="text-center">Berat</th>
				<th class="text-center">Jumlah</th>
				<th class="text-center">Subberat</th>
                <th class="text-center">Subtotal</th>
			</tr>
		</thead>
		<tbody>
			<?php $nomor=1; ?>
			<?php $ambil=$koneksi->query("SELECT * FROM pembelian_produk WHERE id_pembelian='$_GET[id]'"); ?>
				<?php while($pecah=$ambil->fetch_assoc()){ ?>
			<tr>
				<td class="text-center"><?php echo $nomor; ?></td>
				<td class="text-center"><?php echo $pecah['nama']; ?></td>
				<td class="text-center">Rp. <?php echo number_format($pecah['harga']); ?></td>
				<td class="text-center"><?php echo $pecah['ukuran']; ?></td>
				<td class="text-center"><?php echo $pecah['berat']; ?> gr</td>
				<td class="text-center"><?php echo $pecah['jumlah']; ?></td>
				<td class="text-center"><?php echo $pecah['subberat']; ?> gr</td>
				<td class="text-center">Rp. <?php echo number_format($pecah['subharga']) ?></td>
			</tr>
			<?php $nomor++; ?>
			<?php } ?>
		</tbody>
	</table>


	<div class="row">
		<div class="col-md-6">
			<div class="alert alert-success">
				<p>
					Silahkan anda melakukan pembayaran Rp. <?php echo number_format($detail['total_pembelian']); ?> ke <br>
					<strong>BANK MANDIRI 123-456-78 AN. Mustofa</strong>

				</p>
			</div>
			<button id="printPageButton" onclick="myFunction()">Cetak</button>
		</div>
	</div>

	</section>
</div>
</body>
</html>