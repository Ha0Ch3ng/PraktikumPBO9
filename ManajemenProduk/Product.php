
<?php
require_once 'DatabaseConnection.php';

class Product
{
    private $id;
    private $nama;
    private $harga;
    private $stok;
    private $db;

    public function __construct()
    {
        $this->db = DatabaseConnection::getInstance()
                                      ->getConnection();
    }

    public function setNama($nama)
    {
        $this->nama = $nama;
        return $this;
    }

    public function setHarga($harga)
    {
        $this->harga = $harga;
        return $this;
    }

    public function setStok($stok)
    {
        $this->stok = $stok;
        return $this;
    }


    public function save($nama, $harga, $stok)
    {
        $sql = "INSERT INTO products (nama, harga, stok)
                VALUES (:nama, :harga, :stok)";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            'nama' => $nama,
            'harga' => $harga,
            'stok' => $stok
        ]);
    }

    public static function findAll()
    {
        $db = DatabaseConnection::getInstance()
                                ->getConnection();

        $stmt = $db->query(
            "SELECT * FROM products ORDER BY id DESC"
        );

        return $stmt->fetchAll();
    }

    public static function findById($id)
    {
        $db = DatabaseConnection::getInstance()
                                ->getConnection();

        $stmt = $db->prepare(
            "SELECT * FROM products WHERE id = :id"
        );

        $stmt->execute(['id' => $id]);

        return $stmt->fetch();
    }


    public function update($id, $nama, $harga, $stok)
    {
        $sql = "UPDATE products
                SET nama = :nama, harga = :harga,
                    stok = :stok
                WHERE id = :id";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            'nama'  => $nama,
            'harga' => $harga,
            'stok'  => $stok,
            'id'    => $id
        ]);
    }


    public static function delete($id)
    {
        $db = DatabaseConnection::getInstance()
                                ->getConnection();

        $stmt = $db->prepare(
            "DELETE FROM products WHERE id = :id"
        );

        return $stmt->execute(['id' => $id]);
    }
}
