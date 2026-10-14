<?php

session_start();

include "../koneksi.php";


if (!isset($_SESSION['status']) || $_SESSION['status'] <> "sukses") {
    header("location:../logout.php");
    exit;
}


/* =========================
   AMBIL DATA NILAI
========================= */

$query = mysqli_query(
    $koneksi,
    "SELECT
        nilai.id_nilai,
        siswa.nama AS namasiswa,
        guru.nama AS namaguru,
        mapel.nama_mapel AS namamapel,
        nilai.nilai

    FROM nilai

    INNER JOIN siswa
        ON nilai.nis = siswa.nis

    INNER JOIN guru
        ON nilai.nip = guru.nip

    INNER JOIN mapel
        ON nilai.id_mapel = mapel.id_mapel

    ORDER BY nilai.id_nilai DESC"
);


/* Cek jika query gagal */

if (!$query) {
    die(
        "Query database gagal: " .
        mysqli_error($koneksi)
    );
}

?>


<!DOCTYPE html>

<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Data Nilai - Lotso Edition</title>


    <!-- Tailwind -->

    <script src="https://cdn.tailwindcss.com"></script>


    <!-- Poppins -->

    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap"
        rel="stylesheet"
    >


    <style>

        * {
            font-family: 'Poppins', sans-serif;
        }


        body {

            margin: 0;

            min-height: 100vh;

            background:
                linear-gradient(
                    135deg,
                    #ffe5f2,
                    #ffd1e7,
                    #f7b3d5
                );

        }


        .card {

            box-shadow:
                0 8px 20px
                rgba(220, 80, 150, 0.18);

        }


        .btn {

            transition: 0.2s;

        }


        .btn:hover {

            transform: translateY(-2px);

        }


        .lotso {

            transition: 0.3s;

        }


        .lotso:hover {

            transform: scale(1.05);

        }

    </style>

</head>


<body>


<!-- =========================
     HIASAN
========================= -->

<div class="fixed top-5 left-6 text-3xl">
    💕
</div>


<div class="fixed top-8 right-7 text-3xl">
    🌸
</div>


<div class="fixed bottom-6 left-6 text-3xl">
    🐻
</div>


<div class="fixed bottom-5 right-7 text-3xl">
    🧁
</div>



<!-- =========================
     CONTAINER
========================= -->

<div class="max-w-[960px] mx-auto px-4 py-7">


    <!-- =========================
         HEADER
    ========================= -->

    <div
        class="card
               bg-white
               rounded-[25px]
               px-6
               py-6
               mb-5
               text-center"
    >


        <!-- FOTO LOTSO -->

        <div class="flex justify-center mb-3">

            <div
                class="lotso
                       w-20
                       h-20
                       rounded-full
                       overflow-hidden
                       border-4
                       border-pink-400
                       shadow-lg
                       bg-pink-100"
            >

                <img
                    src="lotso.png.jpg"
                    alt="Lotso"
                    class="w-full h-full object-cover"
                >

            </div>

        </div>


        <!-- JUDUL -->

        <h1
            class="text-2xl
                   font-bold
                   text-pink-500"
        >

            ♡ Data Nilai ♡

        </h1>


        <p
            class="text-pink-300
                   text-sm
                   mt-1"
        >

            Daftar nilai siswa  🎀

        </p>



        <!-- BUTTON -->

        <div
            class="flex
                   justify-center
                   flex-wrap
                   gap-2
                   mt-5"
        >


            <!-- MENU UTAMA -->

            <a
                href="../index.php"
                class="btn
                       bg-pink-100
                       hover:bg-pink-200
                       text-pink-500
                       font-semibold
                       text-sm
                       px-4
                       py-2.5
                       rounded-2xl"
            >

                🏠 Menu Utama

            </a>


            <!-- TAMBAH -->

            <a
                href="tambah.php"
                class="btn
                       bg-pink-400
                       hover:bg-pink-500
                       text-white
                       font-semibold
                       text-sm
                       px-4
                       py-2.5
                       rounded-2xl
                       shadow-md"
            >

                🎀 + Tambah Data

            </a>


            <!-- CETAK -->

            <a
                href="cetak.php"
                class="btn
                       bg-pink-100
                       hover:bg-pink-200
                       text-pink-500
                       font-semibold
                       text-sm
                       px-4
                       py-2.5
                       rounded-2xl"
            >

                🖨️ Cetak

            </a>


            <!-- EXPORT -->

            <a
                href="export.php"
                class="btn
                       bg-pink-100
                       hover:bg-pink-200
                       text-pink-500
                       font-semibold
                       text-sm
                       px-4
                       py-2.5
                       rounded-2xl"
            >

                📥 Export Excel

            </a>


        </div>

    </div>



    <!-- =========================
         TABEL
    ========================= -->

    <div
        class="card
               bg-white
               rounded-[25px]
               overflow-hidden"
    >


        <!-- JUDUL TABEL -->

        <div
            class="bg-pink-50
                   px-5
                   py-3"
        >

            <p
                class="text-pink-500
                       font-semibold
                       text-sm"
            >

                🧸 Daftar Data Nilai

            </p>

        </div>



        <!-- TABLE -->

        <div class="overflow-x-auto">

            <table class="w-full">


                <!-- HEADER -->

                <thead>

                    <tr
                        class="bg-pink-400
                               text-white"
                    >

                        <th class="px-4 py-3 text-sm">
                            No
                        </th>

                        <th class="px-4 py-3 text-sm">
                            Nama Siswa
                        </th>

                        <th class="px-4 py-3 text-sm">
                            Nama Guru
                        </th>

                        <th class="px-4 py-3 text-sm">
                            Mata Pelajaran
                        </th>

                        <th class="px-4 py-3 text-sm">
                            Nilai
                        </th>

                        <th class="px-4 py-3 text-sm text-center">
                            Aksi
                        </th>

                    </tr>

                </thead>



                <!-- DATA -->

                <tbody
                    class="divide-y
                           divide-pink-100"
                >


                <?php

                $no = 1;

                while (
                    $data =
                    mysqli_fetch_assoc($query)
                ) {

                ?>


                    <tr
                        class="hover:bg-pink-50
                               transition"
                    >


                        <!-- NO -->

                        <td
                            class="px-4
                                   py-3
                                   text-gray-600
                                   text-sm"
                        >

                            <?php echo $no++; ?>

                        </td>



                        <!-- SISWA -->

                        <td class="px-4 py-3">

                            <div
                                class="flex
                                       items-center
                                       gap-2"
                            >


                                <div
                                    class="w-9
                                           h-9
                                           rounded-full
                                           overflow-hidden
                                           border-2
                                           border-pink-300
                                           flex-shrink-0"
                                >

                                    <img
                                        src="lotso.png.jpg"
                                        alt="Lotso"
                                        class="w-full h-full object-cover"
                                    >

                                </div>


                                <span
                                    class="font-medium
                                           text-gray-700
                                           text-sm"
                                >

                                    <?php
                                    echo htmlspecialchars(
                                        $data['namasiswa']
                                    );
                                    ?>

                                </span>


                            </div>

                        </td>



                        <!-- GURU -->

                        <td class="px-4 py-3">

                            <div
                                class="flex
                                       items-center
                                       gap-2"
                            >

                                <div
                                    class="w-8
                                           h-8
                                           rounded-lg
                                           bg-pink-100
                                           flex
                                           items-center
                                           justify-center"
                                >

                                    🧑‍🏫

                                </div>


                                <span
                                    class="text-gray-600
                                           text-sm"
                                >

                                    <?php
                                    echo htmlspecialchars(
                                        $data['namaguru']
                                    );
                                    ?>

                                </span>

                            </div>

                        </td>



                        <!-- MAPEL -->

                        <td class="px-4 py-3">

                            <div
                                class="flex
                                       items-center
                                       gap-2"
                            >

                                <div
                                    class="w-8
                                           h-8
                                           rounded-lg
                                           bg-pink-100
                                           flex
                                           items-center
                                           justify-center"
                                >

                                    📚

                                </div>


                                <span
                                    class="text-gray-600
                                           text-sm"
                                >

                                    <?php
                                    echo htmlspecialchars(
                                        $data['namamapel']
                                    );
                                    ?>

                                </span>

                            </div>

                        </td>



                        <!-- NILAI -->

                        <td class="px-4 py-3">

                            <span
                                class="inline-block
                                       bg-pink-100
                                       text-pink-500
                                       font-bold
                                       px-3
                                       py-1
                                       rounded-xl"
                            >

                                💗
                                <?php echo $data['nilai']; ?>

                            </span>

                        </td>



                        <!-- AKSI -->

                        <td
                            class="px-4
                                   py-3
                                   text-center
                                   whitespace-nowrap"
                        >


                            <a
                                href="edit.php?id_nilai=<?php echo $data['id_nilai']; ?>"
                                class="btn
                                       inline-block
                                       bg-pink-100
                                       hover:bg-pink-400
                                       text-pink-500
                                       hover:text-white
                                       px-3
                                       py-1.5
                                       rounded-xl
                                       text-xs
                                       font-semibold"
                            >

                                ✏️ Edit

                            </a>


                            <a
                                href="hapus.php?id_nilai=<?php echo $data['id_nilai']; ?>"
                                onclick="return confirm('Yakin ingin menghapus data ini?')"
                                class="btn
                                       inline-block
                                       bg-pink-100
                                       hover:bg-pink-500
                                       text-pink-500
                                       hover:text-white
                                       px-3
                                       py-1.5
                                       rounded-xl
                                       text-xs
                                       font-semibold
                                       ml-1"
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

    <div
        class="text-center
               mt-5"
    >

        <p
            class="text-pink-300
                   text-xs"
        >

            ♡ Sistem Informasi Sekolah • Lotso Edition ♡

        </p>

    </div>


</div>


</body>

</html>