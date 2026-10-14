<?php

include "../koneksi.php";

$pesan = "";

if (isset($_POST['simpan'])) {

    $nis      = mysqli_real_escape_string($koneksi, $_POST['nis']);
    $nip      = mysqli_real_escape_string($koneksi, $_POST['nip']);
    $id_mapel = mysqli_real_escape_string($koneksi, $_POST['id_mapel']);
    $nilai    = mysqli_real_escape_string($koneksi, $_POST['nilai']);

    $query = mysqli_query(
        $koneksi,
        "INSERT INTO nilai (nis, nip, id_mapel, nilai)
         VALUES ('$nis', '$nip', '$id_mapel', '$nilai')"
    );

    if ($query) {

        echo "<script>
                alert('💗 Data nilai berhasil disimpan!');
                window.location.href = 'index.php';
              </script>";

        exit;

    } else {

        $pesan = "❌ Data gagal disimpan: " . mysqli_error($koneksi);
    }
}

?>

<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Tambah Data Nilai - Lotso Edition</title>

    <script src="https://cdn.tailwindcss.com"></script>

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

            background: linear-gradient(
                135deg,
                #ffe5f2,
                #ffd1e8,
                #f7b5d5
            );
        }

        .input-box {
            transition: 0.2s;
        }

        .input-box:focus {
            border-color: #f472b6;

            outline: none;

            box-shadow:
                0 0 0 2px
                rgba(244, 114, 182, 0.12);
        }

        .btn {
            transition: 0.2s;
        }

        .btn:hover {
            transform: translateY(-1px);
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


    <!-- HIASAN -->

    <div class="fixed top-4 left-5 text-xl">
        💗
    </div>

    <div class="fixed top-6 right-5 text-xl">
        🌸
    </div>

    <div class="fixed bottom-4 left-5 text-xl">
        ♡
    </div>

    <div class="fixed bottom-4 right-5 text-xl">
        🎀
    </div>


    <!-- CONTAINER -->

    <div class="min-h-screen
                flex
                items-center
                justify-center
                px-3
                py-5">


        <!-- CARD -->

        <div class="w-full
                    max-w-[380px]
                    bg-white
                    rounded-[24px]
                    shadow-lg
                    px-5
                    py-5">


            <!-- FOTO LOTSO -->

            <div class="flex justify-center mb-3">

                <div class="lotso
                            w-16
                            h-16
                            bg-pink-100
                            rounded-2xl
                            overflow-hidden
                            border-2
                            border-pink-200
                            shadow-sm">

                    <img
                        src="lotso.png.jpg"
                        alt="Lotso"
                        class="w-full h-full object-cover"
                    >

                </div>

            </div>


            <!-- JUDUL -->

            <div class="text-center mb-5">

                <h1 class="text-xl
                           font-bold
                           text-pink-500">

                    ♡ Tambah Data Nilai ♡

                </h1>

                <p class="text-pink-300
                          text-xs
                          mt-1">

                    Masukkan nilai siswa 🎀

                </p>

            </div>


            <!-- PESAN ERROR -->

            <?php if ($pesan != "") { ?>

                <div class="bg-pink-100
                            border-2
                            border-pink-300
                            text-pink-600
                            rounded-xl
                            p-3
                            mb-4
                            text-xs">

                    <?php echo $pesan; ?>

                </div>

            <?php } ?>


            <!-- FORM -->

            <form method="POST">


                <!-- NAMA SISWA -->

                <div class="mb-3">

                    <label class="block
                                  text-pink-500
                                  font-medium
                                  text-xs
                                  mb-1.5">

                        👩‍🎓 Nama Siswa

                    </label>

                    <select
                        name="nis"
                        required
                        class="input-box
                               w-full
                               border-2
                               border-pink-100
                               bg-pink-50
                               rounded-xl
                               px-3
                               py-2
                               text-sm
                               text-gray-600"
                    >

                        <option value="">
                            🎀 Pilih nama siswa
                        </option>

                        <?php

                        $siswa = mysqli_query(
                            $koneksi,
                            "SELECT nis, nama
                             FROM siswa
                             ORDER BY nama ASC"
                        );

                        while ($data = mysqli_fetch_assoc($siswa)) {

                        ?>

                            <option
                                value="<?php echo $data['nis']; ?>"
                            >

                                <?php echo $data['nama']; ?>

                            </option>

                        <?php } ?>

                    </select>

                </div>


                <!-- MATA PELAJARAN -->

                <div class="mb-3">

                    <label class="block
                                  text-pink-500
                                  font-medium
                                  text-xs
                                  mb-1.5">

                        📚 Mata Pelajaran

                    </label>

                    <select
                        name="id_mapel"
                        required
                        class="input-box
                               w-full
                               border-2
                               border-pink-100
                               bg-pink-50
                               rounded-xl
                               px-3
                               py-2
                               text-sm
                               text-gray-600"
                    >

                        <option value="">
                            🎀 Pilih mata pelajaran
                        </option>

                        <?php

                        $mapel = mysqli_query(
                            $koneksi,
                            "SELECT id_mapel, nama_mapel
                             FROM mapel
                             ORDER BY nama_mapel ASC"
                        );

                        while ($data = mysqli_fetch_assoc($mapel)) {

                        ?>

                            <option
                                value="<?php echo $data['id_mapel']; ?>"
                            >

                                <?php echo $data['nama_mapel']; ?>

                            </option>

                        <?php } ?>

                    </select>

                </div>


                <!-- NAMA GURU -->

                <div class="mb-3">

                    <label class="block
                                  text-pink-500
                                  font-medium
                                  text-xs
                                  mb-1.5">

                        👩‍🏫 Nama Guru

                    </label>

                    <select
                        name="nip"
                        required
                        class="input-box
                               w-full
                               border-2
                               border-pink-100
                               bg-pink-50
                               rounded-xl
                               px-3
                               py-2
                               text-sm
                               text-gray-600"
                    >

                        <option value="">
                            🎀 Pilih nama guru
                        </option>

                        <?php

                        $guru = mysqli_query(
                            $koneksi,
                            "SELECT nip, nama
                             FROM guru
                             ORDER BY nama ASC"
                        );

                        while ($data = mysqli_fetch_assoc($guru)) {

                        ?>

                            <option
                                value="<?php echo $data['nip']; ?>"
                            >

                                <?php echo $data['nama']; ?>

                            </option>

                        <?php } ?>

                    </select>

                </div>


                <!-- NILAI -->

                <div class="mb-4">

                    <label class="block
                                  text-pink-500
                                  font-medium
                                  text-xs
                                  mb-1.5">

                        💗 Nilai

                    </label>

                    <input
                        type="number"
                        name="nilai"
                        min="0"
                        max="100"
                        required
                        placeholder="Ketik nilai..."
                        class="input-box
                               w-full
                               border-2
                               border-pink-100
                               bg-pink-50
                               rounded-xl
                               px-3
                               py-2
                               text-sm
                               text-gray-600
                               placeholder-pink-200"
                    >

                </div>


                <!-- SIMPAN -->

                <button
                    type="submit"
                    name="simpan"
                    class="btn
                           w-full
                           bg-pink-400
                           hover:bg-pink-500
                           text-white
                           font-semibold
                           text-sm
                           py-2.5
                           rounded-xl
                           shadow-md"
                >

                    💗 Simpan Data

                </button>


            </form>


            <!-- KEMBALI -->

            <div class="text-center mt-4">

                <a
                    href="index.php"
                    class="text-pink-400
                           hover:text-pink-500
                           text-xs
                           font-medium"
                >

                    ♡ Kembali ke Data Nilai

                </a>

            </div>


            <!-- FOOTER -->

            <div class="text-center mt-4">

                <p class="text-pink-300 text-[10px]">

                    ♡ Sistem Informasi Sekolah • Lotso Edition ♡

                </p>

            </div>


        </div>

    </div>

</body>

</html>