<?php
include "koneksi.php";

if (!isset($_GET['id_nilai'])) {
    die("ID nilai tidak ditemukan.");
}

$id_nilai = (int) $_GET['id_nilai'];

$query = mysqli_query(
    $koneksi,
    "DELETE FROM nilai WHERE id_nilai=$id_nilai LIMIT 1"
);

if ($query) {
    header("Location: index.php");
    exit;
} else {
    echo "Gagal menghapus data: " . mysqli_error($koneksi);
}
?>