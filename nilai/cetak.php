<?php
include "koneksi.php";

$nis = isset($_GET['nis']) ? $_GET['nis'] : "";

/* =====================================================
   AMBIL DATA NILAI
===================================================== */

if ($nis != "") {

    // Cetak nilai satu siswa
    $query = mysqli_query($koneksi, "
        SELECT
            siswa.nama AS namasiswa,
            mapel.nama_mapel AS namamapel,
            mapel.guru AS namaguru,
            nilai.nilai AS nilai
        FROM nilai
        JOIN siswa
            ON nilai.nis = siswa.nis
        JOIN mapel
            ON nilai.id_mapel = mapel.id_mapel
        WHERE nilai.nis = '$nis'
        ORDER BY mapel.nama_mapel ASC
    ");

} else {

    // Cetak semua data nilai
    $query = mysqli_query($koneksi, "
        SELECT
            siswa.nama AS namasiswa,
            mapel.nama_mapel AS namamapel,
            mapel.guru AS namaguru,
            nilai.nilai AS nilai
        FROM nilai
        JOIN siswa
            ON nilai.nis = siswa.nis
        JOIN mapel
            ON nilai.id_mapel = mapel.id_mapel
        ORDER BY siswa.nama ASC, mapel.nama_mapel ASC
    ");
}

/* =====================================================
   CEK QUERY
===================================================== */

if (!$query) {
    die("Query gagal: " . mysqli_error($koneksi));
}

/* =====================================================
   SIMPAN DATA KE ARRAY
===================================================== */

$data_nilai = [];

while ($data = mysqli_fetch_assoc($query)) {
    $data_nilai[] = $data;
}

/* =====================================================
   NAMA SISWA
===================================================== */

$nama_siswa = "";

if ($nis != "" && count($data_nilai) > 0) {
    $nama_siswa = $data_nilai[0]['namasiswa'];
}

/* =====================================================
   TANGGAL DAN WAKTU
===================================================== */

date_default_timezone_set('Asia/Jakarta');

$tanggal_cetak = date("d-m-Y");
$waktu_cetak = date("H:i");

?>

<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Cetak Data Nilai - SKANET NOVIANAA</title>

    <style>

        * {
            box-sizing: border-box;
        }

        /* =================================================
           BODY
        ================================================= */

        body {
            margin: 0;
            padding: 0;

            font-family: Arial, sans-serif;

            background: #eeeeee;

            color: #333;
        }


        /* =================================================
           KERTAS A4
        ================================================= */

        .page {

            width: 210mm;

            min-height: 297mm;

            margin: 20px auto;

            padding: 15mm 14mm;

            background: white;

            box-shadow:
                0 0 8px rgba(0, 0, 0, 0.25);

            position: relative;
        }


        /* =================================================
           HEADER
        ================================================= */

        .header {

            text-align: center;

            border-bottom: 3px solid #e83e91;

            padding-bottom: 8px;

            margin-bottom: 15px;
        }


        .header h1 {

            margin: 0;

            color: #d92d7d;

            font-size: 20px;

            font-weight: 700;
        }


        .header h2 {

            margin: 4px 0 0;

            color: #d92d7d;

            font-size: 12px;

            font-weight: 600;
        }


        /* =================================================
           INFORMASI SISWA
        ================================================= */

        .info {

            margin-bottom: 10px;

            font-size: 11px;

            color: #555;
        }


        .info strong {

            color: #d92d7d;
        }


        /* =================================================
           TABLE
        ================================================= */

        table {

            width: 100%;

            border-collapse: collapse;

            font-size: 10px;
        }


        th {

            background: #e83e91;

            color: white;

            border: 1px solid #d52d7d;

            padding: 7px 6px;

            text-align: left;

            font-weight: 700;

            text-transform: uppercase;
        }


        td {

            border: 1px solid #e8a5c4;

            padding: 7px 6px;

            color: #444;
        }


        tbody tr:nth-child(even) {

            background: #fff4f9;
        }


        /* =================================================
           KOLOM
        ================================================= */

        .no {

            width: 45px;

            text-align: center;
        }


        .nilai {

            width: 65px;

            text-align: center;

            font-weight: 700;

            color: #d92d7d;
        }


        /* =================================================
           BAGIAN BAWAH
        ================================================= */

        .bottom {

            display: flex;

            justify-content: space-between;

            margin-top: 12px;

            font-size: 9px;

            color: #9a496d;
        }


        .total {

            font-weight: 600;
        }


        .tanggal {

            text-align: right;
        }


        /* =================================================
           TOMBOL PRINT
        ================================================= */

        .button-area {

            margin-top: 20px;

            text-align: center;
        }


        .print-button {

            border: none;

            background: #e83e91;

            color: white;

            padding: 10px 20px;

            border-radius: 8px;

            cursor: pointer;

            font-size: 12px;

            font-weight: 600;

            transition: 0.2s;
        }


        .print-button:hover {

            background: #d92d7d;

            transform: translateY(-1px);
        }


        /* =================================================
           FOOTER
        ================================================= */

        .footer {

            position: absolute;

            bottom: 10mm;

            left: 14mm;

            right: 14mm;

            display: flex;

            justify-content: space-between;

            font-size: 8px;

            color: #888;
        }


        /* =================================================
           PRINT
        ================================================= */

        @media print {

            @page {

                size: A4 portrait;

                margin: 0;
            }


            body {

                background: white;
            }


            .page {

                width: 210mm;

                min-height: 297mm;

                margin: 0;

                padding: 15mm 14mm;

                box-shadow: none;
            }


            .button-area {

                display: none;
            }


            .footer {

                display: flex;
            }
        }

    </style>

</head>


<body>


<div class="page">


    <!-- =================================================
         HEADER
    ================================================= -->

    <div class="header">

        <h1>
            💗 SKANET NOVIANA 💗
        </h1>

        <h2>
            Data Nilai Siswa
        </h2>

    </div>


    <!-- =================================================
         INFORMASI SISWA
    ================================================= -->

    <?php if ($nis != "" && $nama_siswa != "") { ?>

        <div class="info">

            Nama Siswa :
            
            <strong>
                <?php echo htmlspecialchars($nama_siswa); ?>
            </strong>

        </div>

    <?php } ?>


    <!-- =================================================
         TABEL DATA NILAI
    ================================================= -->

    <table>

        <thead>

            <tr>

                <th class="no">
                    No
                </th>

                <th>
                    Nama Siswa
                </th>

                <th>
                    Nama Mapel
                </th>

                <th>
                    Nama Guru
                </th>

                <th class="nilai">
                    Nilai
                </th>

            </tr>

        </thead>


        <tbody>

            <?php

            $no = 1;

            if (count($data_nilai) > 0) {

                foreach ($data_nilai as $data) {

            ?>

                <tr>

                    <td class="no">

                        <?php
                        echo $no++;
                        ?>

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


                    <td class="nilai">

                        <?php
                        echo htmlspecialchars(
                            $data['nilai']
                        );
                        ?>

                    </td>

                </tr>

            <?php

                }

            } else {

            ?>

                <tr>

                    <td
                        colspan="5"
                        style="
                            text-align:center;
                            padding:15px;
                            color:#999;
                        "
                    >

                        Tidak ada data nilai.

                    </td>

                </tr>

            <?php } ?>

        </tbody>

    </table>


    <!-- =================================================
         TOTAL DAN TANGGAL
    ================================================= -->

    <div class="bottom">

        <div class="total">

            Total data:
            <?php echo count($data_nilai); ?>
            nilai

        </div>


        <div class="tanggal">

            Dicetak pada:

            <?php echo $tanggal_cetak; ?>

            <?php echo $waktu_cetak; ?>

            WIB

        </div>

    </div>


    <!-- =================================================
         TOMBOL PRINT
    ================================================= -->

    <div class="button-area">

        <button
            class="print-button"
            onclick="window.print()"
        >

            🖨 Print

        </button>

    </div>


    <!-- =================================================
         FOOTER
    ================================================= -->

    <div class="footer">

        <div>

            localhost/skanet_novianaa/nilai/cetak.php

        </div>


        <div>

            1/1

        </div>

    </div>


</div>


</body>

</html>