
<?php
require_once '../Product.php';

$product = new Product();
$pesan = "";

$id = $_GET['id'] ?? $_POST['id'] ?? null;

$data = $id ? $product->findById($id) : null;

if (isset($_POST['update'])) {
    $berhasil = $product->update(
        $_POST['id'],
        $_POST['nama'],
        $_POST['harga'],
        $_POST['stok']
    );

    $pesan = $berhasil
        ? "Produk berhasil diperbarui!"
        : "Produk gagal diperbarui!";

    $id = $_POST['id'];
    $data = $product->findById($id);
}
?>

<h2>Edit Produk</h2>

<p><?= htmlspecialchars($pesan) ?></p>

<?php if ($data): ?>
<form method="POST">
    <input type="hidden" name="id"
           value="<?= $data['id'] ?>">

    Nama Produk:<br>
    <input type="text" name="nama"
           value="<?= htmlspecialchars($data['nama']) ?>" required>
    <br><br>

    Harga:<br>
    <input type="number" name="harga" min="0" step="0.01"
           value="<?= $data['harga'] ?>" required>
    <br><br>

    Stok:<br>
    <input type="number" name="stok" min="0"
           value="<?= $data['stok'] ?>" required>
    <br><br>

    <button type="submit" name="update">Update Produk</button>
</form>
<?php else: ?>
<p>Produk tidak ditemukan.</p>
<?php endif; ?>

<br>
<a href="../index.php">Kembali ke daftar produk</a>
