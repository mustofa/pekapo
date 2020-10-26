<?php session_start(); ?>
<?php include 'koneksi.php'; ?>
<?php 
$id_produk = $_GET["id"];
$ambil = $koneksi->query("SELECT * FROM produk WHERE id_produk='$id_produk'");
$detail = $ambil->fetch_assoc();
?>
<!DOCTYPE html>
<html>
<head>
	<title>PEKAPO | Detail</title>
	<link rel="stylesheet" href="admin/assets/css/bootstrap.css">
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	<style>
		textarea {
			resize: none;
		}
		.mySlides{
			display:none;
			margin-left: -55px;
		}
		.header h2 {
            margin-top: -5px;
        }

</style>
</head>
<body>
<script>
$(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();   
});
</script>
<!-- navbar -->
<?php include 'menu.php'; ?>
<section class="konten">
	<div class="w3-content w3-display-container">
		<div class="row">
		<div class="col-md-5">
			<div align="center">
<button class="w3-button w3-gray w3-display-left" onclick="plusDivs(-1)">&#10094;</button>
<img class="mySlides"  src="foto_produk/<?php echo $detail['foto_produk']; ?>" 
data-toggle="tooltip" title="Depan">
			<img class="mySlides"  src="foto_produk/back.png" data-toggle="tooltip" title="Belakang">
            <button class="w3-button w3-gray w3-display-right" onclick="plusDivs(1)">&#10095;</button>
        </div>
		</div>
		<div class="col-md-5 col-md-offset-2">
			<div class="header">
			<h2><?php echo $detail["nama_produk"] ?></h2>
			<h4>Rp. <?php echo number_format($detail["harga_produk"]); ?></h4>
			<h6><b>Ukuran</b></h6>
			<form method="post">
			<select class="form-control" style="width: 150px;" required name="ukuran">
			<option value="" disable selected>Pilih ukuran</option>
			<option value="S">S</option>
			<option value="M">M</option>
			<option value="L">L</option>
		    </select>
			<h6><b>Jumlah</b></h6>
            <div onclick="addCommas();return false">
	        <div class="form-group">
			<div class="input-group">
			<button id="minus"> - </button>
<input type="number" id="hasil" value="1" min="1" name="jumlah" max="<?php echo $detail['stok_produk']?>"
 style="width: 50px; text-align: center;">
			<button id="tambah"> + </button>
			 <p>Total harga : Rp. <a id="total">0</a></p>
<textarea style="overflow: auto;" rows="13" cols="60" readonly><?php echo $detail["deskripsi_produk"]; ?>
</textarea>
<div class="input-group-btn">
		</div>
		</div>
		</div>
	    </div>
	<button class="btn btn-default" name="tambah">Tambah Ke Keranjang</button>
	<button class="btn btn-success" name="beli">Beli</button>
</form>

<?php
// jika ada tombol beli
if (isset($_POST["beli"]))
{
	$jumlah = $_POST["jumlah"];
	$_SESSION["keranjang"]["$id_produk"] = $jumlah;

	// Session UKURAN
	$ukuran = $_POST["ukuran"];
	$_SESSION["ukuran"]["$id_produk"] = $ukuran;
	echo "<script>location='checkout.php';</script>";
}
?>
<?php
//jika ada tombol tambah
if (isset($_POST["tambah"])) 
{
	$jumlah = $_POST["jumlah"];
	$_SESSION["keranjang"]["$id_produk"] = $jumlah;

	// Session UKURAN
	$ukuran = $_POST["ukuran"];
	$_SESSION["ukuran"]["$id_produk"] = $ukuran;
	echo "<script>alert('berhasil ditambahkan');window.location='keranjang.php'</script>";
}
?>
	</div>
	</div>
</section>
<script>
var slideIndex = 1;
showDivs(slideIndex);

function plusDivs(n) {
  showDivs(slideIndex += n);
}

function showDivs(n) {
  var i;
  var x = document.getElementsByClassName("mySlides");
  if (n > x.length) {slideIndex = 1}
  if (n < 1) {slideIndex = x.length}
  for (i = 0; i < x.length; i++) {
    x[i].style.display = "none";  
  }
  x[slideIndex-1].style.display = "block";  
}
</script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script>
var a = 0;
var harga = 100000;
$('#minus').click(function(){
a -= 1;
$('#hasil').val(a);
$('#total').html(addCommas(harga*a));
});
$('#tambah').click(function(){
a += 1;
$('#hasil').val(a);
$('#total').html(addCommas(harga*a));
});
function addCommas(nStr)
{
nStr += '';
x = nStr.split('.');
x1 = x[0];
x2 = x.length > 1 ? '.' + x[1] : '';
var rgx = /(\d+)(\d{3})/;
while (rgx.test(x1)) {
x1 = x1.replace(rgx, '$1' + ',' + '$2');
}
return x1 + x2;
}
 </script>
</body>
</html>