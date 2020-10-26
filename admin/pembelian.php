<h3>Data Pembelian</h3>
<hr>
<table class="table table-bordered table-hover">
	<thead>
		<tr class="info">
			<th class="text-center">No</th>
			<th class="text-center">Nama Pelanggan</th>
			<th class="text-center">Tanggal</th>
			<th class="text-center">Status</th>
			<th class="text-center">Total</th>
			<th class="text-center">Opsi</th>
		</tr>
	</thead>
	<tbody>
		<?php $nomor=1; ?>
		<?php $ambil=$koneksi->query("SELECT * FROM pembelian JOIN pelanggan ON pembelian.id_pelanggan=pelanggan.id_pelanggan"); ?>
		<?php while ($pecah = $ambil->fetch_assoc()){ ?>
		<tr>
		    <td class="text-center"><?php echo $nomor; ?></td>
		    <td class="text-center"><?php echo $pecah['nama_pelanggan']; ?></td>
		    <td class="text-center"><?php echo $pecah['tanggal_pembelian']; ?></td>
		    <td class="text-center"><?php echo $pecah['status_pembelian']; ?></td>
	        <td class="text-center">Rp. <?php echo number_format($pecah['total_pembelian']); ?></td>
	        <td class="text-center">
	    	 <a href="index.php?halaman=detail&id=<?php echo $pecah['id_pembelian']?>" 
	    	 	class="btn btn-default fa fa-info-circle"> Detail</a>
	    	 <?php if ($pecah['status_pembelian']!=="pending"): ?>
	    	 	<a href="index.php?halaman=pembayaran&id=<?php echo $pecah['id_pembelian']?>" 
	    	 	class="btn btn-success fa fa-dollar"> Pembayaran</a>
	    	 <?php endif ?>
	     </td>
	</tr>
	<?php $nomor++; ?>
	<?php } ?>
	</tbody>
</table>