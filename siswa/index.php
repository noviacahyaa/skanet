<?php
include "../koneksi.php";
session_start();

if (!isset($_SESSION['status']) || $_SESSION['status'] != "sukses") {
    header("location:../logout.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Data Siswa - Lotso</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        @keyframes floating {
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
                opacity: .6;
            }

            50% {
                transform: scale(1.2);
                opacity: 1;
            }

            100% {
                transform: scale(1);
                opacity: .6;
            }
        }

        .lotso-gerak {
            animation: floating 3s ease-in-out infinite;
        }

        .sparkle {
            animation: sparkle 2s ease-in-out infinite;
        }

        .lotso-container {
            width: 92px;
            height: 92px;
            margin: 0 auto 12px;
            border-radius: 50%;
            overflow: hidden;
            border: 4px solid #f36ab1;
            background: #ffd6ea;
            box-shadow: 0 7px 18px rgba(220, 70, 140, 0.25);
        }

        .lotso {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        .lotso-small {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid #f5a6cc;
            box-shadow: 0 3px 8px rgba(220, 70, 140, 0.15);
        }
    </style>

</head>

<body class="min-h-screen bg-gradient-to-br from-pink-200 via-pink-100 to-pink-300">

    <!-- Hiasan -->
    <div class="fixed top-5 left-6 text-pink-400 text-3xl sparkle">
        💕
    </div>

    <div class="fixed top-10 right-8 text-pink-300 text-3xl sparkle">
        🌸
    </div>

    <div class="fixed bottom-6 left-8 text-pink-300 text-3xl sparkle">
        🐻
    </div>

    <div class="fixed bottom-5 right-8 text-pink-400 text-3xl sparkle">
        🧁
    </div>


    <div class="max-w-6xl mx-auto px-5 py-8">

        <!-- HEADER -->
        <div class="bg-white rounded-[28px] shadow-lg p-6 mb-5 border-2 border-pink-100">

            <!-- LOTSO -->
            <div class="text-center mb-5">

                <div class="lotso-gerak">

                    <div class="lotso-container">

                        <img
                            src="../lotso.png.jpg"
                            alt="Lotso"
                            class="lotso"
                        >

                    </div>

                </div>

                <h1 class="text-2xl font-bold text-pink-500">
                    ♡ Data Siswa ♡
                </h1>

                <p class="text-pink-300 text-sm mt-1">
                    Daftar siswa kesayangan 🎀
                </p>

            </div>


            <!-- NAVIGASI -->
            <div class="flex flex-col sm:flex-row gap-3 justify-center">

                <a
                    href="../index.php"
                    class="text-center bg-pink-100 hover:bg-pink-200 text-pink-600 font-semibold px-5 py-2.5 rounded-2xl transition duration-300"
                >
                    🏠 Menu Utama
                </a>

                <a
                    href="tambah.php"
                    class="text-center bg-pink-400 hover:bg-pink-500 text-white font-semibold px-5 py-2.5 rounded-2xl shadow-md hover:shadow-lg hover:scale-105 transition duration-300"
                >
                    🎀 + Tambah Data
                </a>

            </div>

        </div>


        <!-- TABEL -->
        <div class="bg-white rounded-[28px] shadow-lg overflow-hidden border-2 border-pink-100">

            <!-- JUDUL -->
            <div class="px-5 py-4 bg-pink-50 border-b border-pink-100">

                <p class="text-pink-500 font-semibold">
                    🧑‍🎓 Daftar Data Siswa
                </p>

            </div>


            <div class="overflow-x-auto">

                <table class="w-full text-left">

                    <!-- HEADER -->
                    <thead class="bg-pink-400 text-white">

                        <tr>

                            <th class="px-5 py-3 font-semibold">
                                NIS
                            </th>

                            <th class="px-5 py-3 font-semibold">
                                Nama
                            </th>

                            <th class="px-5 py-3 font-semibold">
                                Alamat
                            </th>

                            <th class="px-5 py-3 font-semibold text-center">
                                Aksi
                            </th>

                        </tr>

                    </thead>


                    <!-- DATA -->
                    <tbody class="divide-y divide-pink-100">

                        <?php

                        $query = mysqli_query(
                            $koneksi,
                            "SELECT * FROM siswa"
                        );

                        if (!$query) {
                            die("Query error: " . mysqli_error($koneksi));
                        }

                        while ($data = mysqli_fetch_assoc($query)) {

                        ?>

                            <tr class="hover:bg-pink-50 transition duration-200">

                                <!-- NIS -->
                                <td class="px-5 py-3 text-gray-600">

                                    <?php echo htmlspecialchars($data['nis']); ?>

                                </td>


                                <!-- NAMA -->
                                <td class="px-5 py-3">

                                    <div class="flex items-center gap-3">

                                        <img
                                            src="../lotso.png.jpg"
                                            alt="Lotso"
                                            class="lotso-small"
                                        >

                                        <span class="font-medium text-gray-700">

                                            <?php echo htmlspecialchars($data['nama']); ?>

                                        </span>

                                    </div>

                                </td>


                                <!-- ALAMAT -->
                                <td class="px-5 py-3">

                                    <div class="flex items-center gap-2">

                                        <span class="text-xl">
                                            🏠
                                        </span>

                                        <span class="text-gray-600">

                                            <?php echo htmlspecialchars($data['alamat']); ?>

                                        </span>

                                    </div>

                                </td>


                                <!-- AKSI -->
                                <td class="px-5 py-3 text-center">

                                    <!-- EDIT -->
                                    <a
                                        href="edit.php?nis=<?php echo urlencode($data['nis']); ?>"
                                        class="inline-block bg-pink-100 hover:bg-pink-400 text-pink-500 hover:text-white px-3 py-1.5 rounded-xl font-medium transition duration-300"
                                    >
                                        ✏️ Edit
                                    </a>


                                    <!-- HAPUS -->
                                    <a
                                        href="hapus.php?nis=<?php echo urlencode($data['nis']); ?>"
                                        onclick="return confirm('Yakin ingin menghapus data siswa ini?')"
                                        class="inline-block bg-pink-100 hover:bg-pink-500 text-pink-500 hover:text-white px-3 py-1.5 rounded-xl font-medium transition duration-300 ml-1"
                                    >
                                        🗑️ Hapus
                                    </a>

                                </td>

                            </tr>

                        <?php

                        }

                        ?>

                    </tbody>

                </table>

            </div>

        </div>


        <!-- FOOTER -->
        <div class="text-center mt-5">

            <p class="text-pink-300 text-sm">
                ♡ Sistem Informasi Sekolah • Lotso Edition ♡
            </p>

        </div>

    </div>

</body>

</html>                                 