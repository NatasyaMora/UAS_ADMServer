<?php
session_start();
// Proteksi halaman: jika belum login, kembalikan ke login.php
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

include 'koneksi.php';

// Query untuk mengambil data produk beserta nama kategorinya
$query = "SELECT produk.*, kategori.nama_kategori 
          FROM produk 
          JOIN kategori ON produk.id_kategori = kategori.id_kategori
          ORDER BY produk.id_produk DESC";
$result = mysqli_query($koneksi, $query);

// Menghitung jumlah total produk untuk ringkasan info (stats card)
$total_produk = mysqli_num_rows($result);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - Pinkish Accessories</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-dashboard">

    <div class="dash-nav">
        <div class="dash-nav-container">
            <div class="dash-logo">
                <a href="dashboard.php">PINKIS<span>Natasya2388010011</span></a>
            </div>
            <div class="dash-user">
                <span><i class="fa-solid fa-circle-user"></i> <?php echo $_SESSION['nama']; ?> (Admin)</span>
                <a href="logout.php" class="btn-logout-top" title="Keluar"><i class="fa-solid fa-right-from-bracket"></i></a>
            </div>
        </div>
    </div>

    <div class="dash-container">
        
        <aside class="dash-sidebar">
            <div class="sidebar-box">
                <ul class="dash-menu">
                    <li><a href="dashboard.php" class="active"><i class="fa-solid fa-box"></i> Manajemen Produk</a></li>
                    <li><a href="index.php" target="_blank"><i class="fa-solid fa-store"></i> Lihat Toko Utama</a></li>
                    <li class="menu-divider"></li>
                    <li><a href="logout.php" class="logout-link"><i class="fa-solid fa-power-off"></i> Keluar / Logout</a></li>
                </ul>
            </div>
        </aside>

        <main class="dash-content">
            
            <div class="dash-stats">
                <div class="stat-card">
                    <div class="stat-icon"><i class="fa-solid fa-boxes-stacked"></i></div>
                    <div class="stat-info">
                        <h3>Total Produk</h3>
                        <p><?php echo $total_produk; ?> Items</p>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon pink-variant"><i class="fa-solid fa-tags"></i></div>
                    <div class="stat-info">
                        <h3>Role Akun</h3>
                        <p>Super Admin</p>
                    </div>
                </div>
            </div>

            <div class="table-container">
                <div class="table-header">
                    <h2>Daftar Produk Toko</h2>
                    <a href="tambah.php" class="btn-tambah"><i class="fa-solid fa-plus"></i> Tambah Produk Baru</a>
                </div>
                
                <table class="table-admin">
                    <thead>
                        <tr>
                            <th width="5%">No</th>
                            <th width="35%">Nama Produk</th>
                            <th width="15%">Kategori</th>
                            <th width="15%">Harga</th>
                            <th width="10%">Stok</th>
                            <th width="20%">Tindakan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $no = 1;
                        if ($total_produk > 0):
                            while($row = mysqli_fetch_assoc($result)): 
                        ?>
                        <tr>
                            <td class="text-center"><?php echo $no++; ?></td>
                            <td><strong><?php echo $row['nama_produk']; ?></strong></td>
                            <td><span class="badge-kategori"><?php echo $row['nama_kategori']; ?></span></td>
                            <td>Rp <?php echo number_format($row['harga'], 0, ',', '.'); ?></td>
                            <td class="text-center"><?php echo $row['stok']; ?></td>
                            <td>
                                <div class="action-buttons">
                                    <a href="edit.php?id=<?php echo $row['id_produk']; ?>" class="btn-action btn-edit" title="Ubah Data"><i class="fa-solid fa-pen-to-square"></i> Edit</a>
                                    <a href="hapus.php?id=<?php echo $row['id_produk']; ?>" class="btn-action btn-hapus" title="Hapus Data" onclick="return confirm('Apakah Anda yakin ingin menghapus produk ini?')"><i class="fa-solid fa-trash"></i> Hapus</a>
                                </div>
                            </td>
                        </tr>
                        <?php 
                            endwhile; 
                        else:
                        ?>
                        <tr>
                            <td colspan="6" class="text-center" style="padding: 30px; color: #777;">Belum ada data produk di database.</td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
            
        </main>
    </div>

</body>
</html>