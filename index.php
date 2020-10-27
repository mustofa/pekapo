<?php
session_start();
include 'koneksi.php';
?>
<!DOCTYPE html>
<html>
<head>
	<title>PEKAPO | Beranda</title>
	<link rel="stylesheet" href="admin/assets/css/bootstrap.css">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet"/>
   <body>
</head>
<style>
    img:hover {
        box-shadow: blue 0 0 1px 1px;
       position: static;

    }
    .header h1 {
            margin-top: 5px;
        }
</style>
<!-- navbar -->
<?php include 'menu.php'; ?>

<!-- konten -->
<section class="konten">
	<div class="container">
        <div class="header" style="margin-top: 70px">
        <h1>Produk Terbaru</h1><hr>
		<div class="row">
            <?php $ambil = $koneksi->query("SELECT * FROM produk"); ?>
            <?php while ($perproduk = $ambil->fetch_assoc()){; ?>
			<div class="col-md-3">
            <div class="thumbnail">
            	<a href="detail.php?id=<?php echo $perproduk['id_produk'] ?>">
        <img src="foto_produk/<?php echo $perproduk['foto_produk']; ?>" data-toggle="tooltip" title="Beli">
                </a>
            	<div class="caption">
            		<h3><?php echo $perproduk['nama_produk'] ?></h3>
            		<h5>Rp. <?php echo number_format($perproduk['harga_produk']); ?></h5>
                    <h5>Warna Putih</h5>
        </div>
        </div>
		</div>
		<?php } ?>
	</div>
	</div>
</section>
</div>
</body>
</html>