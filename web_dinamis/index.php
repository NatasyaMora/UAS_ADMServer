<?php 
include 'koneksi.php'; 

// Mengambil data produk dari database
$query = "SELECT * FROM produk";
$result = mysqli_query($koneksi, $query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pinkish Accessories - Katalog</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>

    <div class="top-nav">
        <div class="nav-container">
            <div class="logo">
                <a href="index.php">ACCESSORIES<span>BYTASYA</span></a>
            </div>
            <div class="search-bar">
                <input type="text" placeholder="Masukkan kata kunci">
                <button><i class="fa-solid fa-magnifying-glass"></i></button>
            </div>
            <div class="nav-icons">
                <a href="login.php" title="Login Admin"><i class="fa-regular fa-user"></i></a>
                <a href="#"><i class="fa-regular fa-heart"></i></a>
                <a href="#"><i class="fa-solid fa-bag-shopping"></i></a>
            </div>
        </div>
    </div>

    <nav class="main-menu">
        <a href="#" class="active">WANITA</a>
        <a href="#">PRIA</a>
        <a href="#">ANAK</a>
        <a href="#">PROMO</a>
    </nav>

    <div class="content-container">
        
        <aside class="sidebar">
            <h2 class="main-cat-title">WANITA</h2>
            
            <div class="menu-group">
                <div class="group-title">AKSESORIS <i class="fa-solid fa-chevron-up"></i></div>
                <ul class="sub-menu">
                    <li><a href="#" class="active">Koleksi Semua Atasan</a></li>
                    <li><a href="#">Kalung Kalem</a></li>
                    <li><a href="#">Anting Minimalis</a></li>
                    <li><a href="#">Gelang Serut</a></li>
                    <li><a href="#">Jepit Rambut Pearl</a></li>
                    <li><a href="#">Cincin Aesthetic</a></li>
                </ul>
            </div>

            <div class="menu-group">
                <div class="group-title">KOLEKSI LAIN <i class="fa-solid fa-chevron-down"></i></div>
            </div>
        </aside>

        <main class="main-content">
            <div class="filter-header">
                <span class="items-count">HASIL: 3 Items</span>
                <div class="sort-by">
                    <label>PILIH BERDASARKAN</label>
                    <select>
                        <option>Produk unggulan</option>
                        <option>Harga terendah</option>
                        <option>Harga tertinggi</option>
                    </select>
                </div>
            </div>

            <div class="grid-produk">
                <?php 
                // Array gambar aksesoris riil berlatar belakang polos/clean agar mirip Uniqlo
                $gambar_aksesoris = [
                    1 => 'https://images.unsplash.com/photo-1599643478518-a784e5dc4c8f?w=500&auto=format&fit=crop&q=60', // Kalung
                    2 => 'https://images.unsplash.com/photo-1630019852942-f89202989a59?w=500&auto=format&fit=crop&q=60', // Anting
                    3 => 'https://images.unsplash.com/photo-1611591437281-460bfbe1220a?w=500&auto=format&fit=crop&q=60'  // Gelang
                ];

                while($row = mysqli_fetch_assoc($result)): 
                    // Menentukan gambar berdasarkan id_produk, jika tidak ada pakai fallback placeholder
                    $img_src = isset($gambar_aksesoris[$row['id_produk']]) ? $gambar_aksesoris[$row['id_produk']] : 'https://via.placeholder.com/500x500/FFE4E1/1A2E40?text=Aksesoris';
                ?>
                <div class="card-produk">
                    <div class="img-wrapper">
                        <img src="<?php echo $img_src; ?>" alt="<?php echo $row['nama_produk']; ?>">
                        <button class="wishlist-btn"><i class="fa-regular fa-heart"></i></button>
                    </div>
                    
                    <div class="info-produk">
                        <div class="color-palette">
                            <span class="dot-color" style="background-color: #F3A3B7;"></span>
                            <span class="dot-color" style="background-color: #1A2E40;"></span>
                            <span class="dot-color" style="background-color: #E5E5E5;"></span>
                        </div>

                        <div class="gender-tag">WANITA</div>
                        <h3 class="prod-title">
                            <a href="detail.php?id=<?php echo $row['id_produk']; ?>"><?php echo $row['nama_produk']; ?></a>
                        </h3>
                        
                        <div class="harga">Rp <?php echo number_format($row['harga'], 0, ',', '.'); ?></div>
                        
                        <div class="rating">
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <span class="rating-count">(<?php echo rand(10, 250); ?>)</span>
                        </div>
                    </div>
                </div>
                <?php endwhile; ?>
            </div>
        </main>

    </div>

</body>
</html>