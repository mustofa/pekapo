<h3>Data Pelanggan</h3>

<table class="table table-bordered table-hover">
	<hr>
	<thead>
		<tr class="info">
			<th class="text-center">No</th>
			<th class="text-center">Nama</th>
			<th class="text-center">Email</th>
			<th class="text-center">Password</th>
			<th class="text-center">Alamat</th>
			<th class="text-center">Telepon</th>
		</tr>
	</thead>
	<tbody>
		<?php $nomor=1; ?>
		<?php $ambil=$koneksi->query("SELECT * FROM pelanggan"); ?>
		<?php while($pecah =$ambil->fetch_assoc()){ ?>
		<tr>
			<td class="text-center"><?php echo $nomor; ?></td>
			<td class="text-center"><?php echo $pecah['nama_pelanggan']; ?></td>
			<td class="text-center"><?php echo $pecah['email_pelanggan']; ?></td>
			<td class="text-center"><?php echo $pecah['password_pelanggan']; ?></td>
			<td class="text-center"><?php echo $pecah['alamat_pelanggan']; ?></td>
			<td class="text-center"><?php echo $pecah['telepon_pelanggan']; ?></td>
			</td>
		</tr>
		<?php $nomor++; ?>
		<?php } ?>
	</tbody>
</table>