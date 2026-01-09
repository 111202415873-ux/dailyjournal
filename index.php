<?php
//menyertakan code dari file koneksi
include "koneksi.php";
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>My Daily Journal</title>
    <link rel="icon" href="gambar/lion-head-png-logo-4.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <style>
        /* Default Light Theme */
        body {
            background-color: #ffffff;
            color: #000000;
            transition: background-color 0.3s ease, color 0.3s ease;
            font-family: Arial, sans-serif;
        }

        /* Dark Theme */
        .dark-theme {
            background-color: #1e1e1e;
            color: #ffffff;
        }

        .dark-theme nav {
            background-color: #333 !important;
        }

        .dark-theme .navbar-nav .nav-link {
            color: rgba(255, 255, 255, 0.8) !important;
        }

        .dark-theme .navbar-nav .nav-link:hover {
            color: #ffffff !important;
        }

        .dark-theme .list-group-item {
            background-color: #2d2d2d;
            color: #ffffff;
            border-color: #444;
        }

        .dark-theme .list-group-item.active {
            background-color: #0d6efd;
            border-color: #0d6efd;
        }

        .theme-buttons {
            display: flex;
            align-items: center;
            margin-left: 15px;
        }

        .theme-buttons button {
            font-size: 18px;
            padding: 6px 10px;
            margin-left: 5px;
            cursor: pointer;
            border: none;
            border-radius: 6px;
            background-color: #f8f9fa;
            transition: all 0.2s;
        }

        .theme-buttons button:hover {
            background-color: #e9ecef;
            transform: scale(1.1);
        }

        .dark-theme .theme-buttons button {
            background-color: #444;
            color: white;
        }

        .dark-theme .theme-buttons button:hover {
            background-color: #555;
        }

        section {
            padding: 60px 0;
        }

        .card {
            margin-bottom: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        .carousel-item img {
            height: 500px;
            object-fit: cover;
        }

        #hero {
            background-color: #f8d7da;
        }

        .dark-theme #hero {
            background-color: #2c1b1d;
        }

        .navbar-brand {
            font-weight: bold;
            font-size: 1.5rem;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top">
        <div class="container">
            <a class="navbar-brand" href="#">Jurnal Saya</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="#hero">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#Article">Article</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#Gallery">Gallery</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#Schedule">Schedule</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#About-Me">About Me</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="login.php" target="_blank">Login</a>
                    </li>
                    <li class="nav-item">
                        <div class="theme-buttons">
                            <button id="darkBtn" title="Dark Mode">🌙</button>
                            <button id="lightBtn" title="Light Mode">☀️</button>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Navbar End -->

    <!-- Hero Section -->
    <section id="hero" class="text-center py-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 order-md-2">
                    <img src="gambar/lion-head-png-logo-4.png" class="img-fluid" alt="Logo" style="max-width: 300px;">
                </div>
                <div class="col-md-6 order-md-1 text-md-start">
                    <h1 class="fw-bold display-4 mb-3">Create Memories, Save Memories Everyday</h1>
                    <p class="lead fs-4">Mencatat semua kegiatan sehari-hari yang ada tanpa terkecuali</p>
                </div>
            </div>
        </div>
    </section>
    <!-- Hero Section End -->

<!--article begin-->
      <section id="article" class="text-center p-5">
        <div class="container">
          <h1 class="fw-bold display-4 pb-3">Article</h1>
          <div class="row row-cols-1 row-cols-md-3 g-4 justify-content-center">
        <?php
        $sql = "SELECT * FROM article ORDER BY tanggal DESC";
        $hasil = $conn->query($sql); 

        while($row = $hasil->fetch_assoc()){
        ?>
        <!--col begin-->
            <div class="col">
            <div class="card h-100">
                    <img src="gambar/<?=$row["gambar"]?>" class="card-img-top" alt="..."/>
                <div class="card-body">
                    <h5 class="card-title"><?=$row["judul"]?></h5>
                    <p class="card-text"><?=$row["isi"]?></p>
                </div>
                <div class="card-footer">
                    <small class="text-body-secondary"><?=$row["tanggal"]?></small>
                </div>
            </div>
            </div>
        <!--col end-->
        <?php
        }
        ?>
          </div>
        </div>
      </section>
      <!--article end-->

    <!-- Gallery Section -->
    <section id="Gallery" class="py-5 bg-light">
        <div class="container">
            <h1 class="fw-bold text-center display-4 mb-5">Gallery</h1>
            <div id="carouselExample" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner rounded">
                    <div class="carousel-item active">
                        <img src="gambar/marten-bjork-6dW3xyQvcYE-unsplash.jpg" class="d-block w-100" alt="Gallery Image 1">
                    </div>
                    <div class="carousel-item">
                        <img src="gambar/kerja-kelompok.jpg" class="d-block w-100" alt="Gallery Image 2">
                    </div>
                    <div class="carousel-item">
                        <img src="gambar/pulang.jpg" class="d-block w-100" alt="Gallery Image 3">
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
    </section>
    <!-- Gallery Section End -->

    <!-- Schedule Section -->
    <section id="Schedule" class="py-5">
        <div class="container">
            <h1 class="fw-bold text-center display-4 mb-5">Schedule</h1>
            <div class="row g-4">
                <div class="col-md-3 col-sm-6">
                    <div class="card h-100 text-center">
                        <div class="card-body">
                            <h5 class="card-title">Membaca</h5>
                            <p class="card-text">Reading books to gain knowledge and improve language skills.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="card h-100 text-center">
                        <div class="card-body">
                            <h5 class="card-title">Menulis</h5>
                            <p class="card-text">Writing journals and notes to document daily activities.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="card h-100 text-center">
                        <div class="card-body">
                            <h5 class="card-title">Olahraga</h5>
                            <p class="card-text">Physical exercise to maintain health and fitness.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="card h-100 text-center">
                        <div class="card-body">
                            <h5 class="card-title">Belajar</h5>
                            <p class="card-text">Studying course materials and completing assignments.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="card h-100 text-center">
                        <div class="card-body">
                            <h5 class="card-title">Kuliah</h5>
                            <p class="card-text">Attending lectures and participating in class activities.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="card h-100 text-center">
                        <div class="card-body">
                            <h5 class="card-title">Jalan</h5>
                            <p class="card-text">Walking for relaxation and exploring the environment.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="card h-100 text-center">
                        <div class="card-body">
                            <h5 class="card-title">Makan</h5>
                            <p class="card-text">Having meals to maintain energy and health.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="card h-100 text-center">
                        <div class="card-body">
                            <h5 class="card-title">Tidur</h5>
                            <p class="card-text">Getting enough rest for physical and mental recovery.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Schedule Section End -->

    <!-- About Me Section -->
    <section id="About-Me" class="py-5 bg-light">
        <div class="container">
            <h1 class="fw-bold text-center display-4 mb-5">About Me</h1>
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="list-group">
                        <a href="https://www.dinus.ac.id/" class="list-group-item list-group-item-action active" target="_blank">
                            UNIVERSITAS DIAN NUSWANTORO
                        </a>
                        <a href="#" class="list-group-item list-group-item-action">Nama: [Your Name]</a>
                        <a href="#" class="list-group-item list-group-item-action">Program Studi: [Your Major]</a>
                        <a href="#" class="list-group-item list-group-item-action">Semester: [Current Semester]</a>
                        <a href="#" class="list-group-item list-group-item-action">Hobi: Membaca, Menulis, Olahraga</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- About Me Section End -->

    <!-- Footer -->
    <footer class="py-4 bg-dark text-white text-center">
        <div class="container">
            <p class="mb-0">&copy; 2023 Jurnal Saya. All rights reserved.</p>
            <p class="mb-0">Create Memories, Save Memories Everyday</p>
        </div>
    </footer>
    <!-- Footer End -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    
    <script>
        // Theme Toggle Functionality
        const darkBtn = document.getElementById("darkBtn");
        const lightBtn = document.getElementById("lightBtn");
        const body = document.body;

        // Check for saved theme or prefer-color-scheme
        const prefersDarkScheme = window.matchMedia("(prefers-color-scheme: dark)");
        const currentTheme = localStorage.getItem("theme");

        // Apply saved theme or system preference
        if (currentTheme === "dark" || (!currentTheme && prefersDarkScheme.matches)) {
            body.classList.add("dark-theme");
        }

        // Dark Mode Button
        darkBtn.addEventListener("click", () => {
            body.classList.add("dark-theme");
            localStorage.setItem("theme", "dark");
        });

        // Light Mode Button
        lightBtn.addEventListener("click", () => {
            body.classList.remove("dark-theme");
            localStorage.setItem("theme", "light");
        });

        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const targetId = this.getAttribute('href');
                if (targetId === '#') return;
                
                const targetElement = document.querySelector(targetId);
                if (targetElement) {
                    window.scrollTo({
                        top: targetElement.offsetTop - 70,
                        behavior: 'smooth'
                    });
                }
            });
        });
    </script>
</body>
</html>