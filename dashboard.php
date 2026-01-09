<?php
include 'koneksi.php';

// query mengambil data article
$sql1 = "SELECT * FROM article ORDER BY tanggal DESC";
$hasil1 = $conn->query($sql1);

// hitung jumlah article
$jumlah_article = $hasil1 ? $hasil1->num_rows : 0;
?>

<div class="row row-cols-1 row-cols-md-4 g-4 justify-content-center pt-4">

    <div class="col">
        <div class="card border border-danger mb-3 shadow" style="max-width: 18rem;">
            <div class="card-body d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">
                    <i class="bi bi-newspaper"></i> Article
                </h5>
                <span class="badge rounded-pill text-bg-danger fs-2">
                    <?= $jumlah_article ?>
                </span>
            </div>
        </div>
    </div>

    <div class="col">
        <div class="card border border-danger mb-3 shadow" style="max-width: 18rem;">
            <div class="card-body d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">
                    <i class="bi bi-camera"></i> Gallery
                </h5>
                <span class="badge rounded-pill text-bg-danger fs-2">0</span>
            </div>
        </div>
    </div>

</div>
