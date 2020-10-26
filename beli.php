<?php
session_start();
// mendapatkan id_produk dari url
$id_produk = $_GET['id'];

if(isset($_SESSION['keranjang'][$id_produk]))
{
	$_SESSION['keranjang'][$id_produk]+=1;
}
else
{
	$_SESSION['keranjang'][$id_produk] = 1;
}

?>