<h3>Data Pembayaran</h3><hr>
<?php 
//id pembelian dari url
$id_pembelian = $_GET['id'];

//mengambil data pembayaran berdasarkan id pembelian
$ambil = $koneksi->query("SELECT*FROM pembayaran WHERE id_pembelian = '$id_pembelian'");
$detail = $ambil->fetch_assoc();
?>

<div class="row">
	<div class="col-md-12">
		<table class="table table-bordered table-hover">
		<div class="table table-image">
			<thead>
				<tr class="info">
				<th scope="col" class="text-center">Nama </th>
			    <th scope="col" class="text-center">Bank </th>
			    <th scope="col" class="text-center">Tanggal </th>
			    <th scope="col" class="text-center">Jumlah </th>
			    <th scope="col" class="text-center">Bukti</th>
				</tr>
			</thead>
		    <tbody>
		    <tr>
		        <td class="text-center"><?php echo $detail['nama'] ?></td>
                <td class="text-center"><?php echo $detail['bank'] ?></td>
                <td class="text-center"><?php echo $detail['tanggal'] ?></td>
                <td class="text-center"> Rp. <?php echo number_format($detail['jumlah']) ?></td>
                <td>
                <center>
                <img src="../bukti_pembayaran/<?php echo $detail['bukti']?>" class="img-fluid img-thumbnail" width="150" height="150">
		        </center>
		        </td>
		    </tr>
	</tbody>
</table>
	<div class="col-12">
<form method="post">
	<div class="form-group">
		<label>No. Resi Pengiriman :</label>
		<input type="text" class="form-control" name="resi">
	</div>
	<div class="form-group">
		<label>Status :</label>
		<select class="form-control" name="status">
			<option value="Pilih Status"></option>
			<option value="Belum lunas">Belum lunas</option>
			<option value="Barang dikirim">Barang dikirim</option>
		</select>
	</div>
	<button class="btn btn-primary" name="proses">Proses</button>
</form>

<?php 
if (isset($_POST["proses"])) 
{
	$resi = $_POST["resi"];
	$status = $_POST["status"];
	$koneksi->query("UPDATE pembelian SET resi_pengiriman= '$resi', status_pembelian= '$status' WHERE id_pembelian= '$id_pembelian'");
	echo "<script>alert('data pembelian diperbarui');</script>";
	echo "<script>location='index.php?halaman=pembelian';</script>";
}
?>