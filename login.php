<?php
include "koneksi.php";

if (isset($_POST['login'])) {

    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = mysqli_query(
        $koneksi,
        "SELECT * FROM users
         WHERE username='$username'
         AND password='$password'"
    );

    $cek = mysqli_num_rows($query);

    if ($cek > 0) {

        session_start();

        $_SESSION['status'] = "sukses";
        $_SESSION['username'] = $_POST['username'];
        $_SESSION['password'] = $_POST['password'];

        header('location:index.php');
        exit;

    } else {

        $pesan = "Username atau password salah!";
    }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Halaman Login - Lotso</title>

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
                transform: scale(1.2);
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

        /* FOTO LOTSO */

        .lotso-container {

            width: 125px;
            height: 125px;

            margin: 0 auto 15px;

            border-radius: 50%;

            overflow: hidden;

            border: 4px solid #f36ab1;

            background: #ffd6ea;

            box-shadow:
                0 7px 18px rgba(220, 70, 140, 0.25);

            transition: 0.3s;
        }

        .lotso-container:hover {

            transform: scale(1.07) rotate(-3deg);
        }

        .lotso {

            width: 100%;
            height: 100%;

            object-fit: cover;

            display: block;
        }

    </style>

</head>


<body class="min-h-screen bg-gradient-to-br from-pink-200 via-pink-100 to-pink-300 flex items-center justify-center overflow-hidden">


    <!-- Hiasan -->

    <div class="float absolute top-8 left-8 text-pink-400 text-3xl">
        🎀
    </div>

    <div class="sparkle absolute top-12 right-10 text-pink-300 text-2xl">
        💗
    </div>

    <div class="sparkle absolute bottom-10 left-10 text-pink-300 text-2xl">
        ♡
    </div>

    <div class="float absolute bottom-8 right-8 text-pink-400 text-2xl">
        🎀
    </div>


    <div class="w-full max-w-sm px-5">


        <!-- Card -->

        <div class="bg-white rounded-[28px] shadow-xl p-6 border-2 border-pink-100">


            <!-- LOTSO -->

            <div class="text-center mb-5">

                <div class="lotso-container">

                    <img
                        src="lotso.png.jpg"
                        alt="Lotso"
                        class="lotso"
                    >

                </div>


                <!-- Judul -->

                <h1 class="text-2xl font-bold text-pink-500">
                    ♡ Welcome ♡
                </h1>


                <p class="text-pink-300 text-sm mt-1">
                    Login dulu yuk! 🎀
                </p>

            </div>


            <!-- Pesan Error -->

            <?php if (isset($pesan)) { ?>

                <div class="mb-4 bg-pink-50 border border-pink-200 text-pink-500 px-4 py-2.5 rounded-2xl text-center text-sm font-semibold">

                    ❌ <?php echo $pesan; ?>

                </div>

            <?php } ?>


            <!-- Form -->

            <form action="" method="post">


                <!-- Username -->

                <div class="mb-4">

                    <label class="block text-pink-600 font-semibold text-sm mb-2">

                        🌸 Username

                    </label>


                    <input
                        type="text"
                        name="username"
                        placeholder="Masukkan username"
                        required
                        class="w-full px-4 py-3 bg-pink-50 border border-pink-200 rounded-2xl outline-none focus:ring-2 focus:ring-pink-300 focus:border-pink-300 transition"
                    >

                </div>


                <!-- Password -->

                <div class="mb-5">

                    <label class="block text-pink-600 font-semibold text-sm mb-2">

                        🎀 Password

                    </label>


                    <input
                        type="password"
                        name="password"
                        placeholder="Masukkan password"
                        required
                        class="w-full px-4 py-3 bg-pink-50 border border-pink-200 rounded-2xl outline-none focus:ring-2 focus:ring-pink-300 focus:border-pink-300 transition"
                    >

                </div>


                <!-- Tombol -->

                <button
                    type="submit"
                    name="login"
                    class="w-full py-3 bg-pink-400 hover:bg-pink-500 text-white font-bold rounded-2xl shadow-md hover:shadow-lg hover:scale-[1.02] transition duration-300"
                >

                    🎀 Login Sekarang ♡

                </button>


            </form>


            <!-- Footer -->

            <div class="text-center mt-5">

                <p class="text-xs text-pink-300">

                    ♡ Sistem Informasi Sekolah ♡

                </p>

            </div>


        </div>

    </div>

</body>

</html>                      