
<?php
require_once '../Product.php';

$id = $_GET['id'] ?? 1;

$product = new Product();
$data = $product->findById($id);

if ($data) {
    echo "ID: " . $data['id'] . "<br>";
    echo "Nama: " . htmlspecialchars($data['nama']) . "<br>";
    echo "Harga: Rp" . number_format($data['harga'], 0, ',', '.') . "<br>";
    echo "Stok: " . $data['stok'];
} else {
    echo "Produk tidak ditemukan.";
}
?>

<br><br>
<a href="../index.php">Kembali ke Daftar Produk</a>

