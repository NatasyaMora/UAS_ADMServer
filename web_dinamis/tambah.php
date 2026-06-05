<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}
include 'koneksi.php';

// Ambil data kategori untuk dropdown select
$query_kat = "SELECT * FROM kategori";
$result_kat = mysqli_query($koneksi, $query_kat);

if (isset($_POST['simpan'])) {
    $nama_produk = mysqli_real_escape_string($koneksi, $_POST['nama_produk']);
    $id_kategori = intval($_POST['id_kategori']);
    $harga       = intval($_POST['harga']);
    $stok        = intval($_POST['stok']);
    $deskripsi   = mysqli_real_escape_string($koneksi, $_POST['deskripsi']);

    // Query insert data
    $query_insert = "INSERT INTO produk (nama_produk, id_kategori, harga, stok, deskripsi) 
                     VALUES ('$nama_produk', $id_kategori, $harga, $stok, '$deskripsi')";
    
    if (mysqli_query($koneksi, $query_insert)) {
        echo "<script>alert('Produk berhasil ditambahkan!'); window.location='dashboard.php';</script>";
    } else {
        echo "<script>alert('Gagal menambahkan produk: " . mysqli_error($koneksi) . "');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Produk - Pinkish Panel</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-dashboard">

    <div class="dash-nav">
        <div class="dash-nav-container">
            <div class="dash-logo"><a href="dashboard.php">PINKISH<span>PANEL</span></a></div>
        </div>
    </div>

    <div class="dash-container" style="max-width: 700px; margin-top: 40px;">
        <div class="table-container" style="width: 100%; padding: 30px;">
            <div class="table-header" style="padding: 0 0 20px 0; margin-bottom: 20px;">
                <h2><i class="fa-solid fa-plus"></i> Tambah Produk Baru</h2>
                <a href="dashboard.php" class="btn-action btn-edit"><i class="fa-solid fa-arrow-left"></i> Kembali</a>
            </div>

            <form action="" method="POST">
                <div class="form-group">
                    <label>Nama Produk</label>
                    <input type="text" name="nama_produk" class="form-control" required autocomplete="off">
                </div>
                <div class="form-group">
                    <label>Kategori Aksesoris</label>
                    <select name="id_kategori" class="form-control" style="height: 42px;" required>
                        <option value="">-- Pilih Kategori --</option>
                        <?php while($kat = mysqli_fetch_assoc($result_kat)): ?>
                            <option value="<?php echo $kat['id_kategori']; ?>"><?php echo $kat['nama_kategori']; ?></option>
                        <?php endstyle; ?>
                        <?php endwhile; ?>
                    </select>
                </div>
                <div class="form-group" style="display: flex; gap: 20px;">
                    <div style="flex: 1;">
                        <label>Harga (Rp)</label>
                        <input type="number" name="harga" class="form-control" required min="0">
                    </div>
                    <div style="flex: 1;">
                        <label>Stok Awal</label>
                        <input type="number" name="stok" class="form-control" required min="0">
                    </div>
                </div>
                <div class="form-group">
                    <label>Deskripsi Produk</label>
                    <textarea name="deskripsi" class="form-control" rows="5" required></textarea>
                </div>
                <button type="submit" name="simpan" class="btn-tambah" style="width: 100%; justify-content: center; padding: 12px; font-size: 1rem; border: none; cursor: pointer;">
                    <i class="fa-solid fa-floppy-disk"></i> Simpan Produk
                </button>
            </form>
        </div>
    </div>

</body>
</html>