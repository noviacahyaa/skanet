<?php
include "koneksi.php";

$nip = $_POST['nip'];
$nama = $_POST['nama'];
$alamat = $_POST['alamat'];

$query = mysqli_query($koneksi, "insert into guru(nip,nama,alamat) values('$nip','$nama','$alamat')");

if ($query) {
?>

<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Data Guru Berhasil Disimpan</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <style>

        @keyframes float {

            0% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-6px);
            }

            100% {
                transform: translateY(0px);
            }

        }

        .float {
            animation: float 3s ease-in-out infinite;
        }

    </style>

</head>

<body class="min-h-screen bg-gradient-to-br from-pink-200 via-pink-100 to-pink-300">


    <div class="float fixed top-8 left-8 text-pink-400 text-3xl">
        ♡
    </div>

    <div class="float fixed top-10 right-10 text-pink-300 text-2xl">
        🌸
    </div>

    <div class="float fixed bottom-8 left-8 text-pink-300 text-2xl">
        ♡
    </div>

    <div class="float fixed bottom-7 right-8 text-pink-400 text-2xl">
        🎀
    </div>


    <div class="min-h-screen flex items-center justify-center px-5">


        <div class="bg-white rounded-[28px] shadow-xl p-7 text-center max-w-sm w-full border-2 border-pink-100">


            <div class="float w-16 h-16 mx-auto mb-4 bg-pink-100 rounded-2xl flex items-center justify-center">

                <span class="text-3xl">
                    💗
                </span>

            </div>


            <h1 class="text-2xl font-bold text-pink-500 mb-2">
                ♡ Berhasil! ♡
            </h1>


            <p class="text-pink-300 text-sm mb-6">
                Data guru berhasil disimpan 🌸
            </p>


            <a
                href="index.php"
                class="inline-block px-6 py-3 bg-pink-400 hover:bg-pink-500 text-white font-bold rounded-2xl shadow-md hover:scale-105 transition duration-300"
            >
                🎀 Kembali ke Data Guru
            </a>


            <p class="text-xs text-pink-300 mt-5">
                ♡ Sistem Informasi Sekolah ♡
            </p>


        </div>

    </div>

</body>

</html>

<?php
} else {
    echo "Data gagal disimpan: " . mysqli_error($koneksi);
}
?>

