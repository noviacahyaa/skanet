<?php

include "../koneksi.php";

if (!isset($_GET['id_mapel']) || $_GET['id_mapel'] == "") {

    die("
        ID mapel tidak ditemukan.
        <br><br>
        <a href='index.php'>← Kembali ke Data Mapel</a>
    ");

}

$id_mapel = intval($_GET['id_mapel']);

$query = mysqli_query(
    $koneksi,
    "DELETE FROM mapel WHERE id_mapel = $id_mapel"
);

if ($query) {

    header("Location: index.php");
    exit;

} else {

    echo "Gagal menghapus data: " . mysqli_error($koneksi);

}

?>