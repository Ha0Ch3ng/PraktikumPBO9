
<?php
require_once '../Product.php';

$product = new Product();

if (isset($_POST['simpan'])) {
    $berhasil = $product->save(
        $_POST['nama'],
        $_POST['harga'],
        $_POST['stok']
    );

    if ($berhasil) {
        header("Location: ../index.php");
        exit;
    } else {
        echo "Produk gagal ditambahkan!";
    }
}
?>

<form method="POST">
    Nama Produk:
    <input type="text" name="nama" required><br><br>

    Harga:
    <input type="number" name="harga" required><br><br>

    Stok:
    <input type="number" name="stok" required><br><br>

    <button type="submit" name="simpan">Simpan</button>
</form>

<br><br>
<a href="../index.php">Kembali ke Tabel</a>
