<?php

include "../koneksi.php";

// Cek apakah data dikirim melalui POST
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    die("Akses tidak valid.");
}

// Ambil data dari form
$id_mapel   = isset($_POST['id_mapel']) ? intval($_POST['id_mapel']) : 0;
$nama_mapel = isset($_POST['nama_mapel']) ? trim($_POST['nama_mapel']) : '';
$guru       = isset($_POST['guru']) ? trim($_POST['guru']) : '';

// Validasi
if ($id_mapel <= 0) {
    die("ID mapel tidak ditemukan. <br><br>
    <a href='index.php'>← Kembali ke Data Mapel</a>");
}

if ($nama_mapel == '' || $guru == '') {
    die("Nama mapel dan guru wajib diisi. <br><br>
    <a href='index.php'>← Kembali ke Data Mapel</a>");
}

// Amankan data
$nama_mapel = mysqli_real_escape_string($koneksi, $nama_mapel);
$guru       = mysqli_real_escape_string($koneksi, $guru);

// Update data
$query = mysqli_query(
    $koneksi,
    "UPDATE mapel 
     SET nama_mapel = '$nama_mapel',
         guru = '$guru'
     WHERE id_mapel = $id_mapel"
);

// Cek hasil
if ($query) {
    echo "
    <!DOCTYPE html>
    <html lang='id'>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <script src='https://cdn.tailwindcss.com'></script>
        <title>Berhasil</title>
    </head>

    <body class='min-h-screen bg-gradient-to-br from-pink-200 via-pink-100 to-pink-300'>

        <div class='min-h-screen flex items-center justify-center px-5'>

            <div class='bg-white rounded-[30px] shadow-xl p-8 text-center max-w-md w-full border-2 border-pink-100'>

                <img 
                    src='../lotso.png.jpg'
                    class='w-28 h-28 mx-auto rounded-full object-cover border-4 border-pink-400 shadow-lg mb-5'
                >

                <h1 class='text-2xl font-bold text-pink-500 mb-2'>
                    💗 Berhasil!
                </h1>

                <p class='text-gray-600 mb-5'>
                    Data mata pelajaran berhasil diperbarui 🎀
                </p>

                <a 
                    href='index.php'
                    class='inline-block bg-pink-400 hover:bg-pink-500 text-white font-semibold px-6 py-3 rounded-2xl transition'
                >
                    🏠 Kembali ke Data Mapel
                </a>

            </div>

        </div>

    </body>
    </html>
    ";
} else {

    echo "
    <!DOCTYPE html>
    <html lang='id'>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <script src='https://cdn.tailwindcss.com'></script>
        <title>Gagal</title>
    </head>

    <body class='min-h-screen bg-pink-100'>

        <div class='min-h-screen flex items-center justify-center px-5'>

            <div class='bg-white rounded-[30px] shadow-xl p-8 text-center max-w-md w-full'>

                <h1 class='text-2xl font-bold text-red-500 mb-3'>
                    ❌ Gagal
                </h1>

                <p class='text-gray-600 mb-5'>
                    Gagal mengubah data mapel.
                </p>

                <p class='text-sm text-red-400 mb-5'>
                    " . mysqli_error($koneksi) . "
                </p>

                <a 
                    href='index.php'
                    class='inline-block bg-pink-400 text-white px-6 py-3 rounded-2xl'
                >
                    ← Kembali
                </a>

            </div>

        </div>

    </body>
    </html>
    ";
}

?>