<h3>Detail Produk</h3>
<hr>
<?php
$ambil = $koneksi->query("SELECT * FROM pembelian JOIN pelanggan
	ON pembelian.id_pelanggan=pelanggan.id_pelanggan
	WHERE pembelian.id_pembelian='$_GET[id]'");
$detail = $ambil->fetch_assoc();
?>
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
			<?php $ambil=$koneksi->query("SELECT * FROM pembelian_produk JOIN produk ON pembelian_produk.id_produk=produk.id_produk WHERE pembelian_produk.id_pembelian='$_GET[id]'"); ?>
				<?php while($pecah=$ambil->fetch_assoc()){ ?>
			<tr>
				<td class="text-center"><?php echo $nomor; ?></td>
				<td class="text-center"><?php echo $pecah['nama_produk']; ?></td>
				<td class="text-center">Rp. <?php echo number_format($pecah['harga_produk']); ?></td>
				<td class="text-center"><?php echo $pecah['ukuran']; ?></td>
				<td class="text-center"><?php echo $pecah['jumlah']; ?></td>
				<td class="text-center">
				    Rp. <?php echo number_format($pecah['harga_produk']*$pecah['jumlah']); ?>
				</td>
			</tr>
			<?php $nomor++; ?>
			<?php } ?>
		</tbody>
	</table>
