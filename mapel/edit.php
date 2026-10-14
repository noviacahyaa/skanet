<?php

include "../koneksi.php";

if (!isset($_GET['id_mapel']) || $_GET['id_mapel'] == "") {
    die("ID mapel tidak ditemukan. <br><br>
    <a href='index.php'>← Kembali ke Data Mapel</a>");
}

$id_mapel = intval($_GET['id_mapel']);

$query = mysqli_query(
    $koneksi,
    "SELECT * FROM mapel WHERE id_mapel = $id_mapel"
);

if (!$query || mysqli_num_rows($query) == 0) {
    die("Data mapel tidak ditemukan. <br><br>
    <a href='index.php'>← Kembali ke Data Mapel</a>");
}

$data = mysqli_fetch_assoc($query);

?>

<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Edit Mapel - Lotso</title>

    <script src="https://cdn.tailwindcss.com"></script>

</head>

<body class="min-h-screen bg-gradient-to-br from-pink-200 via-pink-100 to-pink-300">

<div class="min-h-screen flex items-center justify-center px-5">

    <div class="w-full max-w-md">

        <div class="bg-white rounded-[30px] shadow-xl p-7 border-2 border-pink-100">

            <!-- LOTSO -->

            <div class="text-center mb-5">

                <div class="w-24 h-24 mx-auto mb-3 rounded-full overflow-hidden border-4 border-pink-400 shadow-lg">

                    <img
                        src="../lotso.png.jpg"
                        alt="Lotso"
                        class="w-full h-full object-cover"
                    >

                </div>

                <h1 class="text-2xl font-bold text-pink-500">
                    ♡ Edit Mata Pelajaran ♡
                </h1>

                <p class="text-pink-300 text-sm mt-1">
                    Ubah data mapel kamu 🎀
                </p>

            </div>


            <!-- FORM -->

            <form action="proses_edit.php" method="POST">

                <!-- ID -->

                <input
                    type="hidden"
                    name="id_mapel"
                    value="<?php echo $data['id_mapel']; ?>"
                >


                <!-- NAMA MAPEL -->

                <div class="mb-5">

                    <label class="block text-pink-600 font-semibold text-sm mb-2">
                        📚 Nama Mata Pelajaran
                    </label>

                    <input
                        type="text"
                        name="nama_mapel"
                        value="<?php echo htmlspecialchars($data['nama_mapel']); ?>"
                        required
                        class="w-full px-4 py-3 bg-pink-50 border border-pink-200 rounded-2xl outline-none focus:ring-2 focus:ring-pink-300"
                    >

                </div>


                <!-- GURU -->

                <div class="mb-5">

                    <label class="block text-pink-600 font-semibold text-sm mb-2">
                        🎀 Guru
                    </label>

                    <input
                        type="text"
                        name="guru"
                        value="<?php echo htmlspecialchars($data['guru']); ?>"
                        required
                        class="w-full px-4 py-3 bg-pink-50 border border-pink-200 rounded-2xl outline-none focus:ring-2 focus:ring-pink-300"
                    >

                </div>


                <!-- BUTTON -->

                <button
                    type="submit"
                    class="w-full py-3 bg-pink-400 hover:bg-pink-500 text-white font-bold rounded-2xl shadow-md transition"
                >
                    💗 Simpan Perubahan
                </button>


                <a
                    href="index.php"
                    class="block text-center mt-3 w-full py-3 bg-pink-100 hover:bg-pink-200 text-pink-600 font-semibold rounded-2xl transition"
                >
                    ← Kembali
                </a>

            </form>

        </div>

    </div>

</div>

</body>
</html>