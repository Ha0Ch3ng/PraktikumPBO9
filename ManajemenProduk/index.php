
<?php
require_once 'Product.php';

$product = new Product();
$pesan = '';

// Tambah produk
if (isset($_POST['simpan'])) {
    $berhasil = $product->save(
        $_POST['nama'],
        $_POST['harga'],
        $_POST['stok']
    );

    if ($berhasil) {
        header('Location: index.php?status=berhasil');
        exit;
    } else {
        $pesan = 'Produk gagal ditambahkan.';
    }
}

if (isset($_GET['status']) && $_GET['status'] === 'berhasil') {
    $pesan = 'Produk berhasil ditambahkan!';
}

// Ambil semua produk
$data = $product->findAll();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Manager</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            padding: 30px 20px;
            font-family: Arial, sans-serif;
            background: #f5f3ff;
            color: #292344;
        }

        .container {
            max-width: 1050px;
            margin: auto;
        }

        .header {
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 25px;
            margin-bottom: 25px;
            background: white;
            border: 1px solid #e9e3f5;
            border-radius: 14px;
        }

        .logo {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 52px;
            height: 52px;
            flex-shrink: 0;
            background: #6d28d9;
            color: white;
            border-radius: 12px;
            font-size: 25px;
        }

        h1 {
            margin: 0 0 7px;
            font-size: 25px;
        }

        .subtitle {
            margin: 0;
            color: #817995;
            font-size: 14px;
        }

        .layout {
            display: grid;
            grid-template-columns: 320px minmax(0, 1fr);
            gap: 22px;
            align-items: start;
        }

        .card {
            padding: 23px;
            margin-bottom: 22px;
            background: white;
            border: 1px solid #e9e3f5;
            border-radius: 14px;
        }

        h2 {
            margin: 0 0 8px;
            font-size: 19px;
        }

        .description {
            margin: 0 0 22px;
            color: #817995;
            font-size: 13px;
            line-height: 1.5;
        }

        .form-group {
            margin-bottom: 17px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-size: 13px;
            font-weight: bold;
        }

        input {
            width: 100%;
            padding: 11px;
            border: 1px solid #ddd6fe;
            border-radius: 7px;
            font-size: 14px;
        }

        input:focus {
            outline: none;
            border-color: #7c3aed;
        }

        .btn {
            display: inline-block;
            padding: 10px 13px;
            border: none;
            border-radius: 7px;
            text-decoration: none;
            text-align: center;
            font-size: 13px;
            cursor: pointer;
        }

        .btn-primary {
            background: #6d28d9;
            color: white;
        }

        .btn-primary:hover {
            background: #5b21b6;
        }

        .btn-submit {
            width: 100%;
            padding: 12px;
            font-weight: bold;
        }

        .status {
            padding: 12px;
            margin-bottom: 18px;
            border-radius: 7px;
            background: #ede9fe;
            color: #5b21b6;
            font-size: 13px;
        }

        .table-heading {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 10px;
            margin-bottom: 20px;
        }

        .count {
            padding: 7px 10px;
            background: #f3e8ff;
            color: #6d28d9;
            border-radius: 7px;
            font-size: 12px;
            white-space: nowrap;
        }

        .table-container {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 13px;
        }

        th {
            padding: 13px 10px;
            background: #6d28d9;
            color: white;
            text-align: left;
            white-space: nowrap;
        }

        td {
            padding: 13px 10px;
            border-bottom: 1px solid #eee9f7;
        }

        tbody tr:hover {
            background: #faf8ff;
        }

        .product-name {
            font-weight: bold;
        }

        .price {
            white-space: nowrap;
            color: #5b21b6;
        }

        .aksi {
            white-space: nowrap;
        }

        .aksi a {
            display: inline-block;
            padding: 6px 8px;
            margin: 2px;
            border-radius: 5px;
            text-decoration: none;
            font-size: 12px;
        }

        .detail {
            background: #ede9fe;
            color: #6d28d9;
        }

        .edit {
            background: #e0e7ff;
            color: #3730a3;
        }

        .hapus {
            background: #fee2e2;
            color: #b91c1c;
        }

        .empty {
            padding: 30px;
            text-align: center;
            color: #817995;
        }

        .footer {
            padding: 15px;
            text-align: center;
            color: #817995;
            font-size: 12px;
        }

        @media (max-width: 760px) {
            .layout {
                grid-template-columns: 1fr;
            }

            body {
                padding: 18px 12px;
            }

            .header, .card {
                padding: 18px;
            }
        }
    </style>
</head>

<body>
<div class="container">

    <header class="header">
       
        <div>
            <h1>Product Manager</h1>
            <p class="subtitle">
                Kelola produk dan pantau stok dalam satu halaman.
            </p>
        </div>
    </header>

    <main class="layout">

        <section class="card">
            <h2>Tambah Produk</h2>
            <p class="description">
                Masukkan informasi produk baru ke dalam daftar inventaris.
            </p>

            <?php if ($pesan !== ''): ?>
                <div class="status">
                    <?= htmlspecialchars($pesan) ?>
                </div>
            <?php endif; ?>

            <form method="POST" action="index.php">
                <div class="form-group">
                    <label for="nama">Nama Produk</label>
                    <input
                        type="text"
                        id="nama"
                        name="nama"
                        placeholder="Contoh: Gimbab"
                        required
                    >
                </div>

                <div class="form-group">
                    <label for="harga">Harga (Rp)</label>
                    <input
                        type="number"
                        id="harga"
                        name="harga"
                        min="0"
                        step="0.01"
                        placeholder="Contoh: 50000"
                        required
                    >
                </div>

                <div class="form-group">
                    <label for="stok">Stok Produk</label>
                    <input
                        type="number"
                        id="stok"
                        name="stok"
                        min="0"
                        placeholder="Contoh: 10"
                        required
                    >
                </div>

                <button
                    type="submit"
                    name="simpan"
                    class="btn btn-primary btn-submit"
                >
                    + Simpan Produk
                </button>
            </form>
        </section>

        <section class="card">
            <div class="table-heading">
                <div>
                    <h2>Daftar Inventaris</h2>
                    <p class="description" style="margin: 7px 0 0;">
                        Data produk yang tersimpan di database.
                    </p>
                </div>

                <span class="count">
                    <?= count($data) ?> produk
                </span>
            </div>

            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Produk</th>
                            <th>Harga</th>
                            <th>Stok</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                    <?php if (count($data) > 0): ?>
                        <?php foreach ($data as $item): ?>
                            <tr>
                                <td>
                                    <?= htmlspecialchars((string) $item['id']) ?>
                                </td>

                                <td class="product-name">
                                    <?= htmlspecialchars($item['nama']) ?>
                                </td>

                                <td class="price">
                                    Rp<?= number_format(
                                        (float) $item['harga'],
                                        0,
                                        ',',
                                        '.'
                                    ) ?>
                                </td>

                                <td>
                                    <?= htmlspecialchars((string) $item['stok']) ?>
                                </td>

                                <td class="aksi">
                                    <a
                                        class="detail"
                                        href="CRUD/read.php?id=<?= (int) $item['id'] ?>"
                                    >Detail</a>

                                    <a
                                        class="edit"
                                        href="CRUD/update.php?id=<?= (int) $item['id'] ?>"
                                    >Edit</a>

                                    <a
                                        class="hapus"
                                        href="CRUD/delete.php?id=<?= (int) $item['id'] ?>"
                                        onclick="return confirm('Yakin ingin menghapus produk ini?')"
                                    >Hapus</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" class="empty">
                                Belum ada produk. Silakan tambahkan produk baru.
                            </td>
                        </tr>
                    <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </section>

    </main>

    <footer class="footer">
        Product Manager &copy; 2026
    </footer>

</div>
</body>
</html>
