<?php
//menyertakan code dari file koneksi
include "koneksi.php";
?>

<!doctype html>
<html lang="en" data-bs-theme="light">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>My Daily Journal</title>
    <link rel="icon" href="gambar/lion-head-png-logo-4.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
</head>
<body>

    <nav class="navbar navbar-expand-lg sticky-top bg-body-tertiary shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#">Jurnal Saya</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0 align-items-center">
                    <li class="nav-item"><a class="nav-link" href="#hero">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="#article">Article</a></li>
                    <li class="nav-item"><a class="nav-link" href="#Gallery">Gallery</a></li>
                    <li class="nav-item"><a class="nav-link" href="#Schedule">Schedule</a></li>
                    <li class="nav-item"><a class="nav-link" href="#About-Me">About Me</a></li>
                    <li class="nav-item"><a class="nav-link px-3" href="login.php" target="_blank">Login</a></li>
                    <li class="nav-item ms-lg-3 py-2 py-lg-0">
                        <div class="btn-group border rounded-pill overflow-hidden">
                            <button id="lightBtn" class="btn btn-sm btn-light">☀️</button>
                            <button id="darkBtn" class="btn btn-sm btn-dark">🌙</button>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <section id="hero" class="py-5 bg-danger-subtle text-danger-emphasis">
        <div class="container py-5">
            <div class="row align-items-center">
                <div class="col-md-6 order-md-2 text-center">
                    <img src="gambar/lion-head-png-logo-4.png" class="img-fluid" alt="Logo" style="max-height: 300px;">
                </div>
                <div class="col-md-6 order-md-1 text-md-start text-center">
                    <h1 class="fw-bold display-4 mb-3">Create Memories, Save Memories Everyday</h1>
                    <p class="lead fs-4">Mencatat semua kegiatan sehari-hari yang ada tanpa terkecuali</p>
                </div>
            </div>
        </div>
    </section>
    <section id="article" class="py-5">
        <div class="container">
            <h1 class="fw-bold text-center display-4 mb-5">Article</h1>
            <div class="row row-cols-1 row-cols-md-3 g-4 justify-content-center">
                <?php
                $sql = "SELECT * FROM article ORDER BY tanggal DESC";
                $hasil = $conn->query($sql); 
                while($row = $hasil->fetch_assoc()){
                ?>
                <div class="col">
                    <div class="card h-100 shadow-sm border-0">
                        <img src="gambar/<?=$row["gambar"]?>" class="card-img-top" alt="..." style="height: 200px; object-fit: cover;"/>
                        <div class="card-body">
                            <h5 class="card-title fw-bold"><?=$row["judul"]?></h5>
                            <p class="card-text text-secondary"><?=$row["isi"]?></p>
                        </div>
                        <div class="card-footer bg-transparent border-top-0">
                            <small class="text-body-secondary"><?=$row["tanggal"]?></small>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
    </section>
    <section id="Gallery" class="py-5 bg-body-secondary">
        <div class="container">
            <h1 class="fw-bold text-center display-4 mb-5">Gallery</h1>
            <?php
            $sqlGallery = "SELECT * FROM gallery ORDER BY tanggal DESC";
            $resultGallery = $conn->query($sqlGallery);
            if ($resultGallery && $resultGallery->num_rows > 0):
            ?>
            <div id="carouselExample" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner rounded-4 shadow">
                    <?php
                    $active = true;
                    while ($row = $resultGallery->fetch_assoc()):
                    ?>
                    <div class="carousel-item <?= $active ? 'active' : '' ?>">
                        <img src="gambar/<?= $row['gambar']; ?>" class="d-block w-100" style="height: 500px; object-fit: cover;" alt="...">
                        <div class="carousel-caption d-none d-md-block bg-dark bg-opacity-50 rounded px-3">
                            <h5><?= htmlspecialchars($row['judul']); ?></h5>
                            <small><?= $row['tanggal']; ?></small>
                        </div>
                    </div>
                    <?php $active = false; endwhile; ?>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon"></span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
                    <span class="carousel-control-next-icon"></span>
                </button>
            </div>
            <?php else: ?>
                <p class="text-center text-muted">Belum ada gallery</p>
            <?php endif; ?>
        </div>
    </section>
    <section id="Schedule" class="py-5">
        <div class="container">
            <h1 class="fw-bold text-center display-4 mb-5">Schedule</h1>
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4 g-4 text-center">
                <?php
                $schedules = [
                    ["Membaca", "Reading books to gain knowledge and improve language skills."],
                    ["Menulis", "Writing journals and notes to document daily activities."],
                    ["Olahraga", "Physical exercise to maintain health and fitness."],
                    ["Belajar", "Studying course materials and completing assignments."],
                    ["Kuliah", "Attending lectures and participating in class activities."],
                    ["Jalan", "Walking for relaxation and exploring the environment."],
                    ["Makan", "Having meals to maintain energy and health."],
                    ["Tidur", "Getting enough rest for physical and mental recovery."]
                ];
                foreach ($schedules as $s): ?>
                <div class="col">
                    <div class="card h-100 border-danger-subtle shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title fw-bold text-danger"><?= $s[0] ?></h5>
                            <p class="card-text small text-body-secondary"><?= $s[1] ?></p>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
    <section id="About-Me" class="py-5 bg-body-secondary">
        <div class="container">
            <h1 class="fw-bold text-center display-4 mb-5">About Me</h1>
            <div class="row justify-content-center">
                <div class="col-md-8 text-center">
                    <div class="card border-0 shadow-sm overflow-hidden">
                        <div class="bg-danger text-white p-3 fw-bold fs-5">
                            UNIVERSITAS DIAN NUSWANTORO
                        </div>
                        <div class="list-group list-group-flush py-3">
                            <div class="list-group-item border-0 fs-5"><strong>Nama:</strong> Muhammad Iqbal Kurniawan</div>
                            <div class="list-group-item border-0 fs-5"><strong>Program Studi:</strong> Teknik Informatika</div>
                            <div class="list-group-item border-0 fs-5"><strong>Semester:</strong> 3 (tiga)</div>
                            <div class="list-group-item border-0 fs-5"><strong>Hobi:</strong> Membaca, Menulis, Olahraga</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <footer class="py-5 bg-dark text-white text-center">
        <div class="container">
            <div class="mb-3 fs-3">
                <i class="bi bi-instagram mx-2"></i>
                <i class="bi bi-twitter mx-2"></i>
                <i class="bi bi-whatsapp mx-2"></i>
            </div>
            <p class="mb-1">&copy; 2026 Jurnal Saya. All rights reserved.</p>
            <p class="small opacity-50">Create Memories, Save Memories Everyday</p>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const html = document.documentElement;
        const darkBtn = document.getElementById("darkBtn");
        const lightBtn = document.getElementById("lightBtn");

        const currentTheme = localStorage.getItem("theme") || "light";
        html.setAttribute("data-bs-theme", currentTheme);

        darkBtn.addEventListener("click", () => {
            html.setAttribute("data-bs-theme", "dark");
            localStorage.setItem("theme", "dark");
        });

        lightBtn.addEventListener("click", () => {
            html.setAttribute("data-bs-theme", "light");
            localStorage.setItem("theme", "light");
        });
    </script>
</body>
</html>