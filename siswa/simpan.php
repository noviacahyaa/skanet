<?php
include "koneksi.php";

$nis = $_POST['nis'];
$nama = $_POST['nama'];
$alamat = $_POST['alamat'];

$query = mysqli_query($koneksi, "INSERT INTO siswa (nis, nama, alamat) VALUES ('$nis', '$nama', '$alamat')");

if ($query) {
?>

<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Data Berhasil Disimpan</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <style>

        @keyframes float {

            0% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-7px);
            }

            100% {
                transform: translateY(0px);
            }

        }

        @keyframes pop {

            0% {
                transform: scale(0.8);
            }

            60% {
                transform: scale(1.08);
            }

            100% {
                transform: scale(1);
            }

        }

        .float {
            animation: float 3s ease-in-out infinite;
        }

        .pop {
            animation: pop 0.6s ease-out;
        }

    </style>

</head>


<body class="min-h-screen bg-gradient-to-br from-pink-200 via-pink-100 to-pink-300">


    <!-- Hiasan -->

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


        <div class="w-full max-w-sm">


            <!-- Card -->

            <div class="bg-white rounded-[28px] shadow-xl p-7 text-center border-2 border-pink-100">


                <!-- Icon -->

                <div class="pop float w-20 h-20 mx-auto mb-4 rounded-full bg-pink-100 flex items-center justify-center shadow-sm">

                    <span class="text-4xl">
                        💗
                    </span>

                </div>


                <!-- Judul -->

                <h1 class="text-2xl font-bold text-pink-500 mb-2">
                    ♡ Berhasil! ♡
                </h1>


                <p class="text-pink-300 text-sm mb-6">
                    Data siswa berhasil disimpan 🌷
                </p>


                <!-- Info -->

                <div class="bg-pink-50 border border-pink-100 rounded-2xl px-4 py-3 mb-5">

                    <p class="text-sm text-pink-500 font-medium">
                        🎀 Data kamu sudah tersimpan!
                    </p>

                    <p class="text-xs text-pink-300 mt-1">
                        Terima kasih sudah mengisi data ♡
                    </p>

                </div>


                <!-- Tombol -->

                <a
                    href="index.php"
                    class="block w-full py-3 bg-pink-400 hover:bg-pink-500 text-white font-bold rounded-2xl shadow-md hover:shadow-lg hover:scale-[1.02] transition duration-300"
                >
                    🌸 Kembali ke Data Siswa
                </a>


                <!-- Footer -->

                <div class="mt-5">

                    <p class="text-xs text-pink-300">
                        ♡ Sistem Informasi Sekolah ♡
                    </p>

                </div>


            </div>

        </div>

    </div>

</body>

</html>

<?php
} else {
    echo "Data gagal disimpan: " . mysqli_error($koneksi);
}
?>   