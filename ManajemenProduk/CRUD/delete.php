
<?php
require_once '../Product.php';

$product = new Product();

if (isset($_GET['id'])) {
    $berhasil = $product->delete($_GET['id']);

    if ($berhasil) {
        echo "Produk berhasil dihapus!";
    } else {
        echo "Produk gagal dihapus!";
    }
} else {
    echo "ID produk belum ditentukan.";
}
?>

<br><br>
<a href="../index.php">Kembali ke daftar produk</a>
