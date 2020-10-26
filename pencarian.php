<?php include 'koneksi.php'; ?>
	<?php
	$keyword = $_GET["keyword"];
	$semuadata=array();
$ambil = $koneksi->query("SELECT * FROM produk WHERE nama_produk LIKE '%$keyword%' OR deskripsi_produk LIKE '%$keyword%' ");
	while($pecah = $ambil->fetch_assoc())
	{
		$semuadata[]=$pecah;
	}
	?>

<!DOCTYPE html>
<html>
<head>
	<title>Pencarian</title>
	<link rel="stylesheet" href="admin/assets/css/bootstrap.css">
</head>
<body>
	<style>
    img:hover {
        box-shadow: blue 0 0 1px 1px;
        position: static;

    }
    .notify-badge{
    position: absolute;
    right:15px;
    top:234px;
    background:red;
    text-align: right;
    border-radius: 20px 0px 0px 20px;
    color:white;
    padding:0px 10px;
    font-size:15px;
}
</style>
<?php include 'menu.php'; ?>
<div class="container">
	<h3>Hasil Pencarian : <mark><?php echo $keyword?></mark></h3>

	<?php if (empty($semuadata)): ?>
	<div class="alert alert-danger">Produk <strong><?php echo $keyword ?></strong> Tidak Ditemukan</div>
    <?php endif ?>

	<div class="row">
		<?php foreach ($semuadata as $key => $value) : ?>
		
	<div class="col-md-3">
		<div class="thumbnail">
			<a href="detail.php?id=<?php echo $value['id_produk'] ?>">
			<img src="foto_produk/<?php echo $value["foto_produk"] ?>">
			<span class="notify-badge">Kaos Programmer</span>
		    </a>
		<div class="caption">
			<h3><?php echo $value["nama_produk"] ?></h3>
			<h5>Rp. <?php echo number_format($value['harga_produk']) ?></h5>
			<h5>Kota Surabaya</h5>
		</div>
	</div>
	</div>
    <?php endforeach ?>

</div>
</div>
</body>
</html>