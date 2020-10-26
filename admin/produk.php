<h3>Data Produk</h3>

<table class="table table-bordered table-hover">
	<hr>
	<thead>
		<tr class="info">
			<th class="text-center">No</th>
			<th class="text-center">Nama</th>
			<th class="text-center">Harga</th>
			<th class="text-center">Stok</th>
			<th class="text-center">Berat</th>
			<th class="text-center">Foto</th>
			<th class="text-center">Tindakan</th>
		</tr>
	</thead>
	<tbody>
		<?php $nomor=1; ?>
		<?php $ambil=$koneksi->query("SELECT * FROM produk"); ?>
		<?php while ($pecah = $ambil->fetch_assoc()){ ?>
		<tr>
			<td class="text-center"><?php echo $nomor; ?></td>
			<td class="text-center"><?php echo $pecah['nama_produk']; ?></td>
			<td class="text-center">Rp. <?php echo number_format($pecah['harga_produk']); ?></td>
			<td class="text-center"><?php echo number_format($pecah['stok_produk']); ?></td>
			<td class="text-center"><?php echo $pecah['berat_produk']; ?> gr</td>
			<td class="text-center">
				<img src="../foto_produk/<?php echo $pecah['foto_produk']; ?>" width="60">
			</td>
			<td class="text-center">
				  <a href="index.php?halaman=ubahproduk&id=<?php echo $pecah['id_produk']; ?>" class="btn btn-warning btn-md fa fa-edit"> Ubah</a>
				<a href="index.php?halaman=hapusproduk&id=<?php echo $pecah['id_produk']; ?>" class="btn btn-danger btn-md fa fa-trash"> Hapus</a>
            </td>
		</tr>
		<?php $nomor++; ?>
		<?php } ?>
	</tbody>
</table>
<a href="index.php?halaman=tambahproduk" class="btn btn-primary btn-lg fa fa-pencil"> Tambah Data</a>
