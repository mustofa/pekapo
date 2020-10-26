<?php
session_start();
include 'koneksi.php';

if(!isset($_SESSION['pelanggan']))
{
	echo "<script>alert('silahkan login dahulu');</script>";
	echo "<script>location='login.php';</script>";
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>PEKAPO | Checkout</title>
	<link rel="stylesheet" href="admin/assets/css/bootstrap.css">
</head>
<body>

<!-- navbar -->
<?php include 'menu.php'; ?>
	<section class="konten">
		<div class="container">
			<h1>Checkout</h1>
			<hr>
			<table class="table table-bordered table-hover">
				<thead>
					<tr class="info">
						<th class="text-center">No</th>
						<th class="text-center">Produk</th>
						<th class="text-center">Harga</th>
            <th class="text-center">Ukuran</th>
						<th class="text-center">Jumlah</th>
						<th class="text-center">Subtotal</th>
					</tr>
				</thead>
				<tbody>
				<?php $nomor=1; ?>
				<?php $totalbelanja = 0; ?>
        <?php foreach ($_SESSION['keranjang'] as $id_produk => $jumlah): ?>
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
	<?php echo $_SESSION["ukuran"][$id_produk]?>
	</td>
				  <td class="text-center"><?php echo $jumlah; ?></td>
			      <td class="text-center">Rp. <?php echo number_format($subharga); ?></td>
			</tr>
				<?php $nomor++; ?>
				<?php $totalbelanja+=$subharga; ?>
                <?php endforeach ?>
               </tbody>
               <tfoot>
               	<tr>
               		<th class="text-center" colspan="5">Total Belanja</th>
               		<th class="text-center">Rp. <?php echo number_format($totalbelanja) ?></th>
               	</tr>
               </tfoot>
            </table>

            <form method="post">

            	<div class="row">
            <div class="col-md-4">
            <div class="form-group">
<input type="text" readonly value="<?php echo $_SESSION["pelanggan"]['nama_pelanggan'] ?>" 
class="form-control">
            	</div>
            </div>
            <div class="col-md-4">
                  <div class="form-group">
<input type="text" readonly value="<?php echo $_SESSION["pelanggan"]['telepon_pelanggan'] ?>" 
class="form-control">
            	</div>
            </div>
            <div class="col-md-4">
                <select class="form-control" required name="id_ongkir"> 
                	<option value="">Pilih Ongkos Kirim</option>
                	<?php 
                	$ambil = $koneksi->query("SELECT * FROM ongkir");
                	while($perongkir = $ambil->fetch_assoc()) {
                		?>
                	<option value="<?php echo $perongkir["id_ongkir"] ?>">
                		<?php echo $perongkir['nama_kota'] ?> -
                		Rp. <?php echo number_format($perongkir['tarif']) ?> 

                	</option>
                	<?php } ?>
                </select>
            </div>
            </div>
            <div class="form-group">
            	<label>Alamat Lengkap Pengiriman :</label>
<textarea style="overflow: auto;" class="form-control" required name="alamat_pengiriman" placeholder="masukkan alamat lengkap pengiriman(termasuk kode pos)"></textarea>
            </div>
            <button class="btn btn-success" name="checkout">Checkout
            </button>
        </div>
      </form>
          
          <?php
          if (isset($_POST['checkout']))
          {
          	$id_pelanggan = $_SESSION['pelanggan']['id_pelanggan'];
          	$id_ongkir = $_POST["id_ongkir"];
          	$tanggal_pembelian = date("Y-m-d");
            $alamat_pengiriman = $_POST['alamat_pengiriman'];
          	$ambil = $koneksi->query("SELECT * FROM ongkir WHERE id_ongkir='$id_ongkir'");
          	$arrayongkir = $ambil->fetch_assoc();
          	$nama_kota = $arrayongkir['nama_kota'];
          	$tarif = $arrayongkir['tarif'];

          	$total_pembelian = $totalbelanja + $tarif; 

            //menyimpan data ke tabel pembelian
          	$koneksi->query("INSERT INTO pembelian (id_pelanggan,id_ongkir,tanggal_pembelian,total_pembelian,nama_kota,tarif,alamat_pengiriman)
          	VALUES ('$id_pelanggan','$id_ongkir','$tanggal_pembelian','$total_pembelian','$nama_kota','$tarif','$alamat_pengiriman') ");

          	$id_pembelian_barusan = $koneksi->insert_id;

          	foreach ($_SESSION['keranjang'] as $id_produk => $jumlah)
          	 {
          	 $ambil=$koneksi->query("SELECT * FROM produk WHERE id_produk='$id_produk'");
          	 $perproduk = $ambil->fetch_assoc();

           $nama = $perproduk['nama_produk'];
           $harga = $perproduk['harga_produk'];
		       $berat = $perproduk['berat_produk'];
		       $UK = $_SESSION["ukuran"][$id_produk];
           $subberat = $perproduk['berat_produk']*$jumlah;
           $subharga = $perproduk['harga_produk']*$jumlah;
           $koneksi->query("INSERT INTO pembelian_produk (id_pembelian,id_produk,nama,harga,berat,subberat,subharga,jumlah,ukuran)
          			VALUES ('$id_pembelian_barusan','$id_produk','$nama','$harga','$berat','$subberat','$subharga','$jumlah','$UK') ");

           //skrip update stok
           $koneksi->query("UPDATE produk SET stok_produk=stok_produk -$jumlah
            WHERE id_produk='$id_produk'");
          	}
          //Mengkosongkan keranjang belanja
          	unset($_SESSION['keranjang']);
          //Tampilan dialihkan ke nota
          	echo "<script>alert('pembelian sukses');</script>";
          	echo "<script>location='nota.php?id=$id_pembelian_barusan';</script>";
          }

          ?>
      </div>
	</section><br>
</body>
</html>