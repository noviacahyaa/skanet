<?php
include "koneksi.php";

$id_nilai = $_GET['id_nilai'];

$query = mysqli_query(
    $koneksi,
    "SELECT * FROM nilai WHERE id_nilai = '$id_nilai'"
);

$data = mysqli_fetch_array($query);
?>

<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Edit Data Nilai</title>

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

        @keyframes sparkle {

            0% {
                transform: scale(1);
                opacity: 0.6;
            }

            50% {
                transform: scale(1.15);
                opacity: 1;
            }

            100% {
                transform: scale(1);
                opacity: 0.6;
            }

        }

        .float {
            animation: float 3s ease-in-out infinite;
        }

        .sparkle {
            animation: sparkle 2s ease-in-out infinite;
        }

    </style>

</head>


<body class="min-h-screen bg-gradient-to-br from-pink-200 via-pink-100 to-pink-300">


    <!-- Hiasan -->

    <div class="float fixed top-8 left-8 text-pink-400 text-3xl">
        ♡
    </div>

    <div class="sparkle fixed top-10 right-10 text-pink-300 text-2xl">
        🌸
    </div>

    <div class="sparkle fixed bottom-8 left-8 text-pink-300 text-2xl">
        ♡
    </div>

    <div class="float fixed bottom-7 right-8 text-pink-400 text-2xl">
        🎀
    </div>


    <div class="min-h-screen flex items-center justify-center px-5 py-8">


        <div class="w-full max-w-sm">


            <!-- Card -->

            <div class="bg-white rounded-[28px] shadow-xl p-6 border-2 border-pink-100">


                <!-- Header -->

                <div class="text-center mb-6">


                    <div class="float w-16 h-16 mx-auto mb-3 bg-pink-100 rounded-2xl flex items-center justify-center shadow-sm">

                        <span class="text-3xl">
                            📝
                        </span>

                    </div>


                    <h1 class="text-2xl font-bold text-pink-500">
                        ♡ Edit Nilai ♡
                    </h1>


                    <p class="text-pink-300 text-sm mt-1">
                        Yuk ubah data nilai 🌷
                    </p>

                </div>


                <form action="update.php" method="POST">


                    <input
                        type="hidden"
                        name="id_nilai"
                        value="<?php echo $data['id_nilai']; ?>"
                    >


                    <!-- ID Mapel -->

                    <div class="mb-4">

                        <label class="block text-pink-600 font-semibold text-sm mb-2">
                            📚 ID Mapel
                        </label>

                        <input
                            type="text"
                            name="id_mapel"
                            value="<?php echo $data['id_mapel']; ?>"
                            required
                            class="w-full px-4 py-3 bg-pink-50 border border-pink-200 rounded-2xl outline-none focus:ring-2 focus:ring-pink-300 focus:border-pink-300 transition"
                        >

                    </div>


                    <!-- NIS -->

                    <div class="mb-4">

                        <label class="block text-pink-600 font-semibold text-sm mb-2">
                            🌸 NIS
                        </label>

                        <input
                            type="text"
                            name="nis"
                            value="<?php echo $data['nis']; ?>"
                            required
                            class="w-full px-4 py-3 bg-pink-50 border border-pink-200 rounded-2xl outline-none focus:ring-2 focus:ring-pink-300 focus:border-pink-300 transition"
                        >

                    </div>


                    <!-- NIP -->

                    <div class="mb-4">

                        <label class="block text-pink-600 font-semibold text-sm mb-2">
                            👩‍🏫 NIP
                        </label>

                        <input
                            type="text"
                            name="nip"
                            value="<?php echo $data['nip']; ?>"
                            required
                            class="w-full px-4 py-3 bg-pink-50 border border-pink-200 rounded-2xl outline-none focus:ring-2 focus:ring-pink-300 focus:border-pink-300 transition"
                        >

                    </div>


                    <!-- Nilai -->

                    <div class="mb-5">

                        <label class="block text-pink-600 font-semibold text-sm mb-2">
                            💗 Nilai
                        </label>

                        <input
                            type="text"
                            name="nilai"
                            value="<?php echo $data['nilai']; ?>"
                            required
                            class="w-full px-4 py-3 bg-pink-50 border border-pink-200 rounded-2xl outline-none focus:ring-2 focus:ring-pink-300 focus:border-pink-300 transition"
                        >

                    </div>


                    <!-- Tombol -->

                    <button
                        type="submit"
                        class="w-full py-3 bg-pink-400 hover:bg-pink-500 text-white font-bold rounded-2xl shadow-md hover:shadow-lg hover:scale-[1.02] transition duration-300"
                    >
                        💗 Simpan Perubahan
                    </button>


                </form>


                <!-- Kembali -->

                <div class="text-center mt-5">

                    <a
                        href="index.php"
                        class="text-pink-400 hover:text-pink-600 text-sm font-medium transition"
                    >
                        ♡ Kembali ke Data Nilai
                    </a>

                </div>


                <!-- Footer -->

                <div class="text-center mt-4">

                    <p class="text-xs text-pink-300">
                        ♡ Sistem Informasi Sekolah ♡
                    </p>

                </div>


            </div>

        </div>

    </div>

</body>

</html>

