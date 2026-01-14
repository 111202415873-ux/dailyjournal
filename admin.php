<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

// Mengambil halaman dari URL, default ke dashboard
$page = $_GET['page'] ?? 'dashboard';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Daily Journal | Admin</title>

    <link rel="icon" href="gambar/lion-head-png-logo-4.png">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        #content {
            flex: 1;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-sm sticky-top bg-danger-subtle">
        <div class="container">
            <a class="navbar-brand" href="admin.php">My Daily Journal</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbar">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="admin.php?page=dashboard">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="admin.php?page=article">Article</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="admin.php?page=gallery">Gallery</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-danger fw-bold" href="#" data-bs-toggle="dropdown">
                            <?= htmlspecialchars($_SESSION['username']); ?>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="admin.php?page=profile">Profile</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <section id="content" class="p-5">
        <div class="container">
            <?php
            // Menampilkan judul halaman sesuai parameter URL
            echo '<h4 class="lead display-6 pb-2 border-bottom border-danger-subtle">' . ucfirst($page) . '</h4>';
            
            // Memasukkan file sesuai halaman yang dipilih
            include($page . ".php");
            ?>
        </div>
    </section>
    <footer class="text-center p-3 bg-danger-subtle mt-auto">
        <div>
            <a href="https://www.instagram.com/udinusofficial">
                <i class="bi bi-instagram h2 p-2 text-dark"></i>
            </a>
            <a href="https://twitter.com/udinusofficial">
                <i class="bi bi-twitter h2 p-2 text-dark"></i>
            </a>
            <a href="https://wa.me/62812685577">
                <i class="bi bi-whatsapp h2 p-2 text-dark"></i>
            </a>
        </div>
        <div class="mt-2">
            <strong>Muhammad Iqbal Kurniawan &copy; 2026</strong>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>