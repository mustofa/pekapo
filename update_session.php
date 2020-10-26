<?php
session_start();
$id_produk=$_GET["id_produk"];
$jumlah=$_GET["jumlah"];
unset($_SESSION["keranjang"][$id_produk]);
// unset($_SESSION["hapus"][$id_produk]);
$_SESSION["keranjang"]["$id_produk"] = $jumlah;
// echo $jumlah;
echo "<script>location='keranjang.php';</script>";
?>