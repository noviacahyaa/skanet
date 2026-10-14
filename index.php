<?php

session_start();
include "koneksi.php";

// Jika belum login
if (!isset($_SESSION['status']) || $_SESSION['status'] != "sukses") {
    header("Location: login.php");
    exit;
}

// Nama pengguna
$nama = isset($_SESSION['username']) ? $_SESSION['username'] : "Noviana";

// ==============================
// HITUNG JUMLAH DATA
// ==============================

$jumlah_siswa = 0;
$jumlah_guru  = 0;
$jumlah_mapel = 0;
$jumlah_nilai = 0;

// Siswa
$query_siswa = mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM siswa");
if ($query_siswa) {
    $data_siswa = mysqli_fetch_assoc($query_siswa);
    $jumlah_siswa = $data_siswa['total'];
}

// Guru
$query_guru = mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM guru");
if ($query_guru) {
    $data_guru = mysqli_fetch_assoc($query_guru);
    $jumlah_guru = $data_guru['total'];
}

// Mapel
$query_mapel = mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM mapel");
if ($query_mapel) {
    $data_mapel = mysqli_fetch_assoc($query_mapel);
    $jumlah_mapel = $data_mapel['total'];
}

// Nilai
$query_nilai = mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM nilai");
if ($query_nilai) {
    $data_nilai = mysqli_fetch_assoc($query_nilai);
    $jumlah_nilai = $data_nilai['total'];
}

?>

<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Menu Utama - Sistem Informasi Sekolah</title>

    <!-- Google Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            min-height: 100vh;
            background:
                radial-gradient(circle at top left, #fff5fb 0%, transparent 35%),
                radial-gradient(circle at bottom right, #ffd4eb 0%, transparent 40%),
                linear-gradient(135deg, #ffe8f4, #ffd0e7);

            color: #555;
        }

        /* =========================
           NAVBAR
        ========================= */

        .navbar {
            width: 100%;
            height: 75px;

            background: rgba(255, 255, 255, 0.90);

            backdrop-filter: blur(12px);

            border-bottom: 1px solid rgba(255, 105, 170, 0.15);

            display: flex;
            align-items: center;
            justify-content: space-between;

            padding: 0 45px;

            position: sticky;
            top: 0;
            z-index: 1000;

            box-shadow: 0 5px 25px rgba(218, 72, 143, 0.10);
        }

        /* LOGO */

        .logo {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .logo-circle {
            width: 48px;
            height: 48px;

            border-radius: 50%;

            overflow: hidden;

            border: 3px solid #ff72b3;

            box-shadow: 0 4px 12px rgba(255, 92, 165, 0.25);
        }

        .logo-circle img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .logo-text h2 {
            color: #ed3f91;
            font-size: 17px;
            font-weight: 700;
        }

        .logo-text p {
            color: #999;
            font-size: 10px;
        }

        /* MENU NAVBAR */

        .nav-menu {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .nav-menu a {
            text-decoration: none;

            color: #777;

            padding: 10px 15px;

            border-radius: 12px;

            font-size: 13px;
            font-weight: 500;

            transition: 0.3s;
        }

        .nav-menu a:hover,
        .nav-menu a.active {
            background: #ffe3f0;
            color: #ed3f91;
        }

        .logout {
            background: #ff5fa7 !important;
            color: white !important;
            box-shadow: 0 5px 12px rgba(255, 95, 167, 0.25);
        }

        .logout:hover {
            background: #ed3f91 !important;
            transform: translateY(-2px);
        }

        /* =========================
           CONTAINER
        ========================= */

        .container {
            max-width: 1200px;
            margin: auto;

            padding: 40px 25px 60px;
        }

        /* =========================
           WELCOME
        ========================= */

        .welcome {
            background: rgba(255, 255, 255, 0.88);

            border-radius: 25px;

            padding: 30px;

            display: flex;

            align-items: center;

            justify-content: space-between;

            margin-bottom: 30px;

            border: 1px solid rgba(255, 113, 174, 0.18);

            box-shadow: 0 10px 35px rgba(213, 72, 137, 0.10);
        }

        .welcome-text h1 {
            color: #ed3f91;

            font-size: 28px;

            margin-bottom: 8px;
        }

        .welcome-text p {
            color: #999;

            font-size: 14px;
        }

        .welcome-text span {
            color: #ff65aa;
            font-weight: 600;
        }

        .welcome-icon {
            font-size: 55px;

            animation: floating 3s ease-in-out infinite;
        }

        @keyframes floating {

            0%, 100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-8px);
            }

        }

        /* =========================
           STATISTIK
        ========================= */

        .section-title {
            margin-bottom: 18px;

            color: #ed3f91;

            font-size: 20px;

            font-weight: 600;
        }

        .stats {
            display: grid;

            grid-template-columns: repeat(4, 1fr);

            gap: 20px;

            margin-bottom: 35px;
        }

        .stat-card {
            background: rgba(255, 255, 255, 0.90);

            padding: 23px;

            border-radius: 22px;

            display: flex;

            align-items: center;

            gap: 17px;

            border: 1px solid rgba(255, 113, 174, 0.13);

            box-shadow: 0 8px 25px rgba(213, 72, 137, 0.08);

            transition: 0.3s;
        }

        .stat-card:hover {
            transform: translateY(-5px);

            box-shadow: 0 13px 30px rgba(213, 72, 137, 0.15);
        }

        .stat-icon {
            width: 58px;
            height: 58px;

            border-radius: 17px;

            display: flex;

            align-items: center;
            justify-content: center;

            font-size: 27px;

            background: #ffe5f1;
        }

        .stat-card h3 {
            color: #ed3f91;

            font-size: 25px;

            line-height: 1.2;
        }

        .stat-card p {
            color: #999;

            font-size: 12px;

            margin-top: 3px;
        }

        /* =========================
           MENU CARD
        ========================= */

        .menu-grid {
            display: grid;

            grid-template-columns: repeat(2, 1fr);

            gap: 20px;
        }

        .menu-card {
            background: rgba(255, 255, 255, 0.90);

            border-radius: 22px;

            padding: 25px;

            display: flex;

            align-items: center;

            justify-content: space-between;

            text-decoration: none;

            border: 1px solid rgba(255, 113, 174, 0.13);

            box-shadow: 0 8px 25px rgba(213, 72, 137, 0.08);

            transition: 0.3s;
        }

        .menu-card:hover {
            transform: translateY(-5px);

            box-shadow: 0 15px 30px rgba(213, 72, 137, 0.15);

            border-color: #ffacd0;
        }

        .menu-left {
            display: flex;

            align-items: center;

            gap: 17px;
        }

        .menu-icon {
            width: 60px;
            height: 60px;

            border-radius: 18px;

            background: #fff0f7;

            display: flex;

            align-items: center;

            justify-content: center;

            font-size: 28px;
        }

        .menu-card h3 {
            color: #ed3f91;

            font-size: 16px;

            margin-bottom: 4px;
        }

        .menu-card p {
            color: #aaa;

            font-size: 11px;
        }

        .arrow {
            width: 35px;
            height: 35px;

            border-radius: 50%;

            background: #ffe2ef;

            display: flex;

            align-items: center;
            justify-content: center;

            color: #ed3f91;

            font-size: 18px;

            transition: 0.3s;
        }

        .menu-card:hover .arrow {
            background: #ff63a9;

            color: white;

            transform: translateX(4px);
        }

        /* =========================
           FOOTER
        ========================= */

        footer {
            text-align: center;

            margin-top: 40px;

            color: #c77a9f;

            font-size: 11px;
        }

        /* =========================
           DECORATION
        ========================= */

        .decoration {
            position: fixed;

            font-size: 22px;

            opacity: 0.45;

            pointer-events: none;

            z-index: -1;
        }

        .heart1 {
            top: 120px;
            left: 4%;
        }

        .heart2 {
            top: 45%;
            right: 4%;
        }

        .heart3 {
            bottom: 8%;
            left: 8%;
        }

        /* =========================
           RESPONSIVE
        ========================= */

        @media (max-width: 900px) {

            .navbar {
                padding: 0 20px;
            }

            .nav-menu a {
                padding: 8px;
                font-size: 11px;
            }

            .stats {
                grid-template-columns: repeat(2, 1fr);
            }

        }

        @media (max-width: 650px) {

            .navbar {
                height: auto;

                padding: 15px;

                flex-direction: column;

                gap: 12px;
            }

            .nav-menu {
                width: 100%;

                justify-content: center;

                flex-wrap: wrap;
            }

            .container {
                padding: 25px 15px 40px;
            }

            .welcome {
                padding: 22px;

                flex-direction: column;

                align-items: flex-start;

                gap: 15px;
            }

            .welcome-text h1 {
                font-size: 22px;
            }

            .welcome-icon {
                align-self: center;
            }

            .stats {
                grid-template-columns: 1fr 1fr;

                gap: 12px;
            }

            .stat-card {
                padding: 15px;

                gap: 10px;
            }

            .stat-icon {
                width: 45px;
                height: 45px;

                font-size: 20px;
            }

            .stat-card h3 {
                font-size: 20px;
            }

            .menu-grid {
                grid-template-columns: 1fr;
            }

        }

    </style>

</head>

<body>

    <!-- Dekorasi -->
    <div class="decoration heart1">♡</div>
    <div class="decoration heart2">♡</div>
    <div class="decoration heart3">♡</div>


    <!-- =========================
         NAVBAR
    ========================== -->

    <nav class="navbar">

        <div class="logo">

            <div class="logo-circle">

                <img src="lotso.png.jpg" alt="Lotso">

            </div>

            <div class="logo-text">

                <h2> SMKN TAKERAN </h2>

                <p>Sistem Informasi Sekolah</p>

            </div>

        </div>


        <div class="nav-menu">

            <a href="index.php" class="active">
                🏠 Beranda
            </a>

            <a href="siswa/index.php">
                👩‍🎓 Siswa
            </a>

            <a href="guru/index.php">
                👨‍🏫 Guru
            </a>

            <a href="mapel.php">
                📚 Mapel
            </a>

            <a href="nilai/index.php">
                📝 Nilai
            </a>

            <a href="logout.php" class="logout"
               onclick="return confirm('Yakin ingin logout?')">
                🎀 Logout
            </a>

        </div>

    </nav>


    <!-- =========================
         CONTENT
    ========================== -->

    <main class="container">


        <!-- WELCOME -->

        <section class="welcome">

            <div class="welcome-text">

                <h1>♡ Menu Utama ♡</h1>

                <p>
                    Haii,
                    <span><?php echo htmlspecialchars($nama); ?></span>
                    🎀
                </p>

                <p style="margin-top:8px;">
                    Selamat datang di Sistem Informasi Sekolah.
                </p>

            </div>

            <div class="welcome-icon">
                🌸
            </div>

        </section>


        <!-- =========================
             STATISTIK
        ========================== -->

        <h2 class="section-title">
            ✨ Ringkasan Data
        </h2>


        <section class="stats">


            <!-- SISWA -->

            <div class="stat-card">

                <div class="stat-icon">
                    👩‍🎓
                </div>

                <div>

                    <h3>
                        <?php echo $jumlah_siswa; ?>
                    </h3>

                    <p>
                        Total Siswa
                    </p>

                </div>

            </div>


            <!-- GURU -->

            <div class="stat-card">

                <div class="stat-icon">
                    👨‍🏫
                </div>

                <div>

                    <h3>
                        <?php echo $jumlah_guru; ?>
                    </h3>

                    <p>
                        Total Guru
                    </p>

                </div>

            </div>


            <!-- MAPEL -->

            <div class="stat-card">

                <div class="stat-icon">
                    📚
                </div>

                <div>

                    <h3>
                        <?php echo $jumlah_mapel; ?>
                    </h3>

                    <p>
                        Mata Pelajaran
                    </p>

                </div>

            </div>


            <!-- NILAI -->

            <div class="stat-card">

                <div class="stat-icon">
                    📝
                </div>

                <div>

                    <h3>
                        <?php echo $jumlah_nilai; ?>
                    </h3>

                    <p>
                        Data Nilai
                    </p>

                </div>

            </div>


        </section>


        <!-- =========================
             MENU CEPAT
        ========================== -->

        <h2 class="section-title">
            💗 Menu Cepat
        </h2>


        <section class="menu-grid">


            <!-- SISWA -->

            <a href="siswa/index.php" class="menu-card">

                <div class="menu-left">

                    <div class="menu-icon">
                        👩‍🎓
                    </div>

                    <div>

                        <h3>
                            Data Siswa
                        </h3>

                        <p>
                            Kelola data siswa sekolah
                        </p>

                    </div>

                </div>

                <div class="arrow">
                    →
                </div>

            </a>


            <!-- GURU -->

            <a href="guru/index.php" class="menu-card">

                <div class="menu-left">

                    <div class="menu-icon">
                        👨‍🏫
                    </div>

                    <div>

                        <h3>
                            Data Guru
                        </h3>

                        <p>
                            Kelola data guru sekolah
                        </p>

                    </div>

                </div>

                <div class="arrow">
                    →
                </div>

            </a>


            <!-- MAPEL -->

            <a href="mapel.php" class="menu-card">

                <div class="menu-left">

                    <div class="menu-icon">
                        📚
                    </div>

                    <div>

                        <h3>
                            Mata Pelajaran
                        </h3>

                        <p>
                            Kelola data mata pelajaran
                        </p>

                    </div>

                </div>

                <div class="arrow">
                    →
                </div>

            </a>


            <!-- NILAI -->

            <a href="nilai/index.php" class="menu-card">

                <div class="menu-left">

                    <div class="menu-icon">
                        📝
                    </div>

                    <div>

                        <h3>
                            Data Nilai
                        </h3>

                        <p>
                            Kelola nilai siswa
                        </p>

                    </div>

                </div>

                <div class="arrow">
                    →
                </div>

            </a>


        </section>


        <!-- FOOTER -->

        <footer>

            ♡ Skanet Noviana • Sistem Informasi Sekolah ♡

            <br>

            Dibuat dengan 💗

        </footer>


    </main>


</body>

</html>