<?php
session_start();
include 'koneksi.php';

//jika tidak ada session pelanggan(belum login)
if (!isset($_SESSION["pelanggan"]) OR empty($_SESSION["pelanggan"]))
{
   echo "<script>alert('silahkan masuk');</script>";
   echo "<script>location='login.php';</script>";
   exit();
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>PEKAPO | Riwayat Belanja</title>
	<link rel="stylesheet" href="admin/assets/css/bootstrap.css">
</head>
<body>

<?php include 'menu.php'; ?>

<section class="riwayat">
	<div class="container">
		<h3>Riwayat belanja <?php echo $_SESSION["pelanggan"]["nama_pelanggan"] ?>
		</h3>
		<hr>
		<table class="table table-bordered table-hover">
			<thead>
				<tr class="info">
					<th class="text-center">No</th>
					<th class="text-center">Tanggal</th>
					<th class="text-center">Status</th>
					<th class="text-center">Total</th>
					<th class="text-center">Opsi</th>
				</tr>
			</thead>
			<tbody>
				<?php
				$nomor=1;
				//mendapatkan id_pelanggan yang login dari session
				$id_pelanggan = $_SESSION["pelanggan"]['id_pelanggan'];
				$ambil = $koneksi->query("SELECT * FROM pembelian WHERE id_pelanggan='$id_pelanggan'");
				while($pecah = $ambil->fetch_assoc()){
				?>
				<tr>
					<td class="text-center"><?php echo $nomor;?></td>
					<td class="text-center"><?php echo $pecah["tanggal_pembelian"] ?></td>
					<td class="text-center"><?php echo $pecah["status_pembelian"] ?>
						<br>
						<?php if (!empty($pecah['resi_pengiriman'])): ?>
							Resi: <?php echo $pecah['resi_pengiriman']; ?>
						<?php endif ?>
					</td>
				<td class="text-center">Rp. <?php echo number_format($pecah["total_pembelian"]) ?></td>
					<td class="text-center">
						<a href="nota.php?id=<?php echo $pecah["id_pembelian"] ?>" class="btn btn-info">Nota</a>
						<?php if ($pecah['status_pembelian']=="pending"): ?> 
						<a href="pembayaran.php?id=<?php echo $pecah["id_pembelian"];?>"
						class="btn btn-success">Input Pembayaran</a>
						<?php else: ?>
						<a href="lihat_pembayaran.php?id=<?php echo $pecah["id_pembelian"];?>" 
						class="btn btn-warning">Lihat Pembayaran</a>
			<?php endif ?>
					</td>
				</tr>
				<?php $nomor++ ?>
			<?php } ?>
			</tbody>
		</table>
	</div>
</section>
</body>
</html>