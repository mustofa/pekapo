<!-- navbar -->
<style>
	.navbar .navbar-brand {
  padding-top: 0px;
}
.navbar .navbar-brand img {
  height: 0px auto;

}
</style>
<nav class="navbar navbar-default" style="background-color: #808080;">
		<div class="container">
		<ul class="nav navbar-nav navbar-left">
<a class ="navbar-brand" href="index.php" data-toggle="tooltip" title="Beranda">
	<img src="foto_produk/logo.png">
</a>
<link rel="stylesheet" href="admin/assets/css/bootstrap.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script>
$(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();   
});
</script>
<!-- jika sudah login(ada session pelanggan) -->
	<?php if (isset($_SESSION['pelanggan'])): ?>
	<form action="pencarian.php" method="get" class="navbar-form navbar-left" style="margin-left:65px;">
		 <div class="form-group">
 <input type="text" placeholder="cari produk" style="width: 400px" name="keyword" class="form-control">
 <button class="btn btn-light" type="submit"><i class="glyphicon glyphicon-search" data-toggle="tooltip" title="Cari"></i></button>
		 </form>
		    </li>
	        </ul>
	   		<ul class="nav navbar-nav">
	   	 <li><a href="keranjang.php" data-toggle="tooltip" title="Keranjang">
		    <span class="glyphicon glyphicon-shopping-cart" style="font-size:17px; transform: scaleX(-1);">
		    </span></a></li>
		</ul>
		   <ul class="nav navbar-nav navbar-right">
		 <li class="navbar-brand dropdown">
      <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $_SESSION['pelanggan']['nama_pelanggan'];?> <span class="caret">
		</span></a>
		<ul class="dropdown-menu dropdown-menu-right">
			<li><a href="riwayat.php" class="dropdown-item">Riwayat Belanja</a></li>
			<li><a href="logout.php" class="dropdown-item">Keluar</a></li>
		</ul>
<!-- Jika belum login(tidak ada session pelanggan)-->
	<?php else: ?>
	<form action="pencarian.php" method="get" class="navbar-form navbar-left" style="margin-left:65px;">
<input type="text" placeholder="cari produk" style="width: 400px" name="keyword" class="form-control"> 
<button class="btn btn-outline-info" type="submit"><i class="glyphicon glyphicon-search" data-toggle="tooltip" title="Cari"></i></button>
        </form>
            <li><a href="keranjang.php" data-toggle="tooltip" title="Keranjang">
	   		<span class="glyphicon glyphicon-shopping-cart" style="font-size:17px; transform: scaleX(-1);"></span></a></li>
     <li><a href="daftar.php" data-toggle="tooltip" title="Daftar" style="margin-left: 15.2em;">Daftar</a></li>
             <li><a href="login.php" data-toggle="tooltip" title="Masuk">Masuk</a></li>
		<?php endif ?>
	       </ul>
		   </div>
		   </nav>
