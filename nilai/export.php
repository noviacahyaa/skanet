<?php

include "koneksi.php";

/* =========================================
   NAMA FILE EXCEL
========================================= */

$filename = "Data_Nilai_Siswa.xls";

header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=\"$filename\"");
header("Pragma: no-cache");
header("Expires: 0");


/* =========================================
   CARI KOLOM NAMA MAPEL
========================================= */

$kolom_mapel = "";

$cek_kolom = mysqli_query($koneksi, "
    SELECT COLUMN_NAME
    FROM INFORMATION_SCHEMA.COLUMNS
    WHERE TABLE_SCHEMA = DATABASE()
    AND TABLE_NAME = 'mapel'
");


if (!$cek_kolom) {
    die("Gagal mengecek tabel mapel: " . mysqli_error($koneksi));
}


while ($kolom = mysqli_fetch_assoc($cek_kolom)) {

    $nama_kolom = $kolom['COLUMN_NAME'];

    if (
        $nama_kolom == "nama_mapel" ||
        $nama_kolom == "mapel" ||
        $nama_kolom == "nama" ||
        $nama_kolom == "nama_pelajaran" ||
        $nama_kolom == "mata_pelajaran"
    ) {

        $kolom_mapel = $nama_kolom;

        break;
    }
}


/* =========================================
   JIKA KOLOM MAPEL TIDAK DITEMUKAN
========================================= */

if ($kolom_mapel == "") {

    die("
        <h2>Kolom Mata Pelajaran Tidak Ditemukan</h2>
        <p>
            Silakan cek struktur tabel <b>mapel</b>
            di phpMyAdmin.
        </p>
    ");
}


/* =========================================
   QUERY DATA
========================================= */

$sql = "
    SELECT
        nilai.nis,
        siswa.nama AS namasiswa,
        mapel.`$kolom_mapel` AS namamapel,
        guru.nama AS namaguru,
        nilai.nilai AS nilai

    FROM nilai

    JOIN siswa
        ON nilai.nis = siswa.nis

    JOIN guru
        ON nilai.nip = guru.nip

    JOIN mapel
        ON nilai.id_mapel = mapel.id_mapel

    ORDER BY
        siswa.nama ASC,
        mapel.`$kolom_mapel` ASC
";


$query = mysqli_query($koneksi, $sql);


/* =========================================
   CEK QUERY
========================================= */

if (!$query) {

    die(
        "Query gagal: " .
        mysqli_error($koneksi)
    );
}

?>


<table border="1">

    <tr>

        <th colspan="5">
            DATA NILAI SISWA
        </th>

    </tr>


    <tr>

        <th>
            No
        </th>

        <th>
            Nama Siswa
        </th>

        <th>
            Mata Pelajaran
        </th>

        <th>
            Nama Guru
        </th>

        <th>
            Nilai
        </th>

    </tr>


    <?php

    $no = 1;

    while ($data = mysqli_fetch_assoc($query)) {

    ?>

        <tr>

            <td>
                <?php echo $no++; ?>
            </td>

            <td>
                <?php
                echo htmlspecialchars(
                    $data['namasiswa']
                );
                ?>
            </td>

            <td>
                <?php
                echo htmlspecialchars(
                    $data['namamapel']
                );
                ?>
            </td>

            <td>
                <?php
                echo htmlspecialchars(
                    $data['namaguru']
                );
                ?>
            </td>

            <td>
                <?php
                echo htmlspecialchars(
                    $data['nilai']
                );
                ?>
            </td>

        </tr>

    <?php

    }

    ?>

</table>     