<?php

include "koneksi.php";

$nis = isset($_GET['nis']) ? $_GET['nis'] : "";

?>

<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <title>Data Nilai</title>

    <style>

        * {
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            margin: 30px;
        }

        h2 {
            text-align: center;
            margin-bottom: 5px;
        }

        .nama {
            text-align: center;
            margin-bottom: 25px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            background: #7c3aed;
            color: white;
            padding: 10px;
            border: 1px solid black;
        }

        td {
            padding: 8px;
            border: 1px solid black;
        }

        .center {
            text-align: center;
        }

        .error {
            text-align: center;
            color: red;
            margin: 20px;
        }

        .no-print {
            padding: 10px 18px;
            border: none;
            border-radius: 8px;
            background: #7c3aed;
            color: white;
            cursor: pointer;
        }

        @media print {

            .no-print {
                display: none;
            }

            body {
                margin: 10px;
            }

        }

    </style>

</head>

<body>

<?php

/* =====================================================
   CETAK SATU SISWA
   ===================================================== */

if ($nis != "") {

    $query = mysqli_query($koneksi, "
        SELECT
            nis,
            nama,
            mapel,
            nilai
        FROM nilai
        WHERE nis = '$nis'
        ORDER BY mapel ASC
    ");

    // Cek apakah query berhasil
    if (!$query) {

        die("Query gagal: " . mysqli_error($koneksi));

    }

    // Ambil data siswa
    $siswa_data = mysqli_fetch_assoc($query);

    ?>

    <h2>DATA NILAI SISWA</h2>

    <?php if ($siswa_data) { ?>

        <div class="nama">
            Nama Siswa:
            <strong>
                <?php echo htmlspecialchars($siswa_data['nama']); ?>
            </strong>
        </div>

        <table>

            <tr>
                <th>No</th>
                <th>Mata Pelajaran</th>
                <th>Nilai</th>
            </tr>

            <?php

            // Kembali ke data pertama
            mysqli_data_seek($query, 0);

            $no = 1;

            while ($data = mysqli_fetch_assoc($query)) {

            ?>

                <tr>

                    <td class="center">
                        <?php echo $no++; ?>
                    </td>

                    <td>
                        <?php echo htmlspecialchars($data['mapel']); ?>
                    </td>

                    <td class="center">
                        <?php echo htmlspecialchars($data['nilai']); ?>
                    </td>

                </tr>

            <?php } ?>

        </table>

    <?php } else { ?>

        <div class="error">
            Data nilai siswa tidak ditemukan.
        </div>

    <?php } ?>


<?php

/* =====================================================
   CETAK SEMUA SISWA
   ===================================================== */

} else {

    ?>

    <h2>DATA NILAI SISWA</h2>

    <div class="nama">
        Semua Data Nilai
    </div>

    <?php

    $query = mysqli_query($koneksi, "
        SELECT
            nis,
            nama,
            mapel,
            nilai
        FROM nilai
        ORDER BY nama ASC, mapel ASC
    ");

    // Cek query
    if (!$query) {

        die("Query gagal: " . mysqli_error($koneksi));

    }

    ?>

    <table>

        <tr>
            <th>No</th>
            <th>Nama Siswa</th>
            <th>Mata Pelajaran</th>
            <th>Nilai</th>
        </tr>

        <?php

        $no = 1;

        while ($data = mysqli_fetch_assoc($query)) {

        ?>

            <tr>

                <td class="center">
                    <?php echo $no++; ?>
                </td>

                <td>
                    <?php echo htmlspecialchars($data['nama']); ?>
                </td>

                <td>
                    <?php echo htmlspecialchars($data['mapel']); ?>
                </td>

                <td class="center">
                    <?php echo htmlspecialchars($data['nilai']); ?>
                </td>

            </tr>

        <?php } ?>

    </table>

<?php } ?>


<br>

<button class="no-print" onclick="window.print()">
    🖨 Print
</button>

</body>

</html>