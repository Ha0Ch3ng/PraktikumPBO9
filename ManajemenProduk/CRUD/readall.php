
<?php
require_once '../Product.php';

$product = new Product();
$data = $product->findAll();

if ($data) {
    foreach ($data as $item) {
        echo "ID: " . $item['id'] . "<br>";
        echo "Nama: " . htmlspecialchars($item['nama']) . "<br>";
        echo "Harga: Rp" . number_format($item['harga'], 0, ',', '.') . "<br>";
        echo "Stok: " . $item['stok'] . "<br><br>";
    }
} else {
    echo "Belum ada produk.";
}
?>
