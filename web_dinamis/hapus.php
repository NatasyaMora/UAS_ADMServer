<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}
include 'koneksi.php';

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($id > 0) {
    $query_delete = "DELETE FROM produk WHERE id_produk = $id";
    
    if (mysqli_query($koneksi, $query_delete)) {
        echo "<script>alert('Produk berhasil dihapus!'); window.location='dashboard.php';</script>";
    } else {
        echo "<script>alert('Gagal menghapus produk!'); window.location='dashboard.php';</script>";
    }
} else {
    header("Location: dashboard.php");
}
?>