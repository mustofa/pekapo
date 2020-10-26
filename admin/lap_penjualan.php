<?php
$tgl_mulai="-";
$tgl_selesai="-";
if (isset($_POST["kirim"]))
{
	$tgl_mulai = $_POST["tglm"];
	$tgl_selesai = $_POST['tgls'];
	$ambil = $koneksi->query("SELECT * FROM pembelian pm LEFT JOIN pelanggan pl ON 
		pm.id_pelanggan=pl.id_pelanggan WHERE tanggal_pembelian BETWEEN '$tgl_mulai' AND '$tgl_selesai' ");
		while($pecah = $ambil->fetch_assoc())
		{
		$semuadata[]=$pecah;
		}
}
?>
<h3>Laporan Penjualan dari <?php echo $tgl_mulai ?> sampai <?php echo $tgl_selesai ?></h3>
<hr>
<form method="post">
	<div class="row">
		<div class="col-md-5">
			<div class="form-group">
			<label>Tanggal mulai</label>
<input type="date" class="form-control" name="tglm" value="<?php echo $tgl_mulai ?>">
		</div>
	    </div>
<div class="col-md-5">
			<div class="form-group">
			<label>Tanggal selesai</label>
<input type="date" class="form-control" name="tgls" value="<?php echo $tgl_selesai ?>">
		</div>
		</div>
	</form>
<div class="col-md-2">
	<label>&nbsp;</label><br>
	<button class="btn-btn-primary" name="kirim">Lihat</button>
</div>
</div>
</form>
<table class="table table-bordered">
	<thead>
		<tr>
			<th class="text-center">No</th>
			<th class="text-center">Pelanggan</th>
			<th class="text-center">Tanggal</th>
			<th class="text-center">Status</th>
			<th class="text-center">Jumlah</th>
		</tr>
	</thead>
	<tbody>
		<?php $total=0; ?>
	<?php foreach ($semuadata as $key => $value): ?>
		<?php $total+=$value['total_pembelian'] ?>
	<tr>
	<td class="text-center"><?php echo $key+1; ?></td>
    <td class="text-center"><?php echo $value["nama_pelanggan"] ?></td>
    <td class="text-center"><?php echo $value["tanggal_pembelian"] ?></td>
    <td class="text-center"><?php echo $value["status_pembelian"] ?></td>
	<td class="text-center"> Rp. <?php echo number_format ($value["total_pembelian"]) ?></td>
	</td>
	</tr>
<?php endforeach ?>
	</tbody>
	<tfoot>
		<tr>
			<th colspan="4">Total</th>
	<th class="text-center"> Rp. <?php echo number_format($total) ?></th>
		</tr>
	</tfoot>
</table>