<?php 
include 'koneksi.php'; 

// Mendapatkan ID produk dari URL
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Query berdasarkan ID produk
$query = "SELECT produk.*, kategori.nama_kategori 
          FROM produk 
          JOIN kategori ON produk.id_kategori = kategori.id_kategori 
          WHERE produk.id_produk = $id";
$result = mysqli_query($koneksi, $query);
$produk = mysqli_fetch_assoc($result);

// Jika produk tidak ditemukan, kembalikan ke index
if (!$produk) {
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $produk['nama_produk']; ?> - Pinkish Accessories</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

    <header>
        <h1>Pinkish Accessories</h1>
    </header>

    <nav>
        <a href="index.php">⬅ Kembali ke Katalog</a>
    </nav>

    <div class="container">
        <div class="detail-wrapper">
            <img class="detail-img" src="https://via.placeholder.com/450x450/FFE4E1/D81B60?text=<?php echo urlencode($produk['nama_produk']); ?>" alt="<?php echo $produk['nama_produk']; ?>">
            
            <div class="detail-info">
                <h2><?php echo $produk['nama_produk']; ?></h2>
                <p style="color: #999; font-size: 0.9rem; margin-bottom: 10px;">Kategori: <?php echo $produk['nama_kategori']; ?></p>
                <p class="harga">Rp <?php echo number_format($produk['harga'], 0, ',', '.'); ?></p>
                
                <p><strong>Stok Tersedia:</strong> <?php echo $produk['stok']; ?> pcs</p>
                <p><strong>Deskripsi Produk:</strong><br><?php echo nl2br($produk['deskripsi']); ?></p>
                
                <a href="#" class="btn-detail" style="display: block; text-align: center; padding: 12px;">Tambah ke Keranjang 🛍️</a>
            </div>
        </div>
    </div>

</body>
</html>