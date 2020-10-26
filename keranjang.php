<?php
session_start();
include 'koneksi.php';

if(empty($_SESSION["keranjang"]) OR !isset($_SESSION["keranjang"]))
{
	echo "<script>alert('keranjang belanja kosong');</script>";
	echo "<script>location='index.php';</script>";
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>PEKAPO | Keranjang Belanja</title>
	<link rel="stylesheet" href="admin/assets/css/bootstrap.css">
	<script src="admin/assets/js/jquery-1.10.2.js"></script>
	<script src="admin/assets/js/bootstrap.min.js"></script>
</head>
<body>
	<style>
		.parent {
			text-align: center;
		}
		input[type=number] {
			margin: auto;
		}
	</style>

<!-- navbar -->
<?php include 'menu.php'; ?>
	<section class="konten">
	<div class="container">
	<h1>Keranjang Belanja</h1>
	<hr>
	<table class="table table-bordered table-hover">
		<thead>
		 <tr class="info">
		  <th class="text-center">No</th>
		  <th class="text-center">Produk</th>
		  <th class="text-center">Harga</th>
		  <th class="text-center">Ukuran</th>
		  <th class="text-center">Jumlah</th>
		  <th class="text-center">Subharga</th>
		  <th class="text-center">Tindakan</th>
		 </tr>
		</thead>
		<tbody>
			 <?php $nomor=1; ?>
			 <!-- <?php var_dump($_SESSION["keranjang"]); ?> -->
			 <?php foreach ($_SESSION["keranjang"] as $id_produk => $jumlah): ?>
			<?php
			$ambil = $koneksi->query("SELECT * FROM produk 
				WHERE id_produk='$id_produk'");
			$pecah = $ambil->fetch_assoc();
			$subharga = $pecah["harga_produk"]*$jumlah;
				?>
				<tr>
				 <td class="text-center"><?php echo $nomor; ?></td>
			     <td class="text-center"><?php echo $pecah["nama_produk"]; ?></td>
                 <td class="text-center">Rp. <?php echo number_format ($pecah["harga_produk"]); ?></td>
                 <td class="text-center">
					<!-- UKURAN DEFINISI -->
				 	<?php echo $_SESSION["ukuran"][$id_produk]?>
					<!-- END Definisi -->
				 </td>
				  <td class="text-center">
					<?php echo $jumlah; ?>
				</td>
<td class="text-center" id="total<?php echo $id_produk; ?>">Rp. <?php echo number_format($subharga); ?></td>
			      <td class="text-center">
<button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-produk="<?php echo $pecah["nama_produk"]; ?>" data-id_produk="<?php echo $id_produk ?>" data-jumlah="<?php echo $jumlah; ?>" data-target="#myModal">Edit</button>
<a href="hapuskeranjang.php?id=<?php echo $id_produk ?>" class="btn btn-danger btn-sm" onclick="return confirm('apakah anda yakin menghapus produk ini?')">Hapus</a>
			    </td>
			    </tr>
				<?php $nomor++; ?>
<script>
var a = 0;
var harga = 100000;
$('#minus<?php echo $id_produk; ?>').click(function(){
a -= 1;
$('#hasil<?php echo $id_produk; ?>').val(a);
$('#total<?php echo $id_produk; ?>').html(addCommas(harga*a));
});
$('#tambah<?php echo $id_produk; ?>').click(function(){
a += 1;
$('#hasil<?php echo $id_produk; ?>').val(a);
$('#total<?php echo $id_produk; ?>').html(addCommas(harga*a));
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
return 'Rp. ' + x1 + x2;
}
</script>
<?php endforeach ?>
            </tbody>
            </table>
            <a href="index.php" class="btn btn-default">Lanjutkan Belanja</a>
            <a href="checkout.php" class="btn btn-success">Checkout</a>
        </div>
	</section><br>

	<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title text-center">Edit Jumlah</h4>
      </div>
      <div class="parent">
      <div class="modal-body">
	  	<form method="get" action="update_session.php">
			<div class="form-group">
				<label for="exampleInputEmail1" class="text-center">Produk</label>
				<p id="namaProduk" class="text-center"></p>
			</div>
			<div class="form-group">
				<label for="exampleInputPassword1" class="text-center">Jumlah</label>
<input type="number" class="form-control text-center" id="jumlahProduk" name="jumlah"
max="<?php echo $detail['stok_produk']?>" style="width: 100px; text-align: center;">
				<input type="hidden" class="form-control text-center" id="id_prod" name="id_produk" >
			</div>		
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-success">Simpan</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
      </div>
	  </form>
    </div>
  </div>
</div>

<script>
$('#myModal').on("show.bs.modal", function (e) {
	$("#namaProduk").html($(e.relatedTarget).data('produk'));
	$('#myModal ').find('input#jumlahProduk').val($(e.relatedTarget).data('jumlah'));
	$('#myModal ').find('input#id_prod').val($(e.relatedTarget).data('id_produk'));
	
});
</script>
</body>
</html>