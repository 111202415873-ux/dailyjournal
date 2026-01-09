<?php
include 'koneksi.php';

/* ======================
   HITUNG JUMLAH ARTICLE
====================== */
$sqlCount = "SELECT COUNT(*) AS total FROM article";
$resultCount = $conn->query($sqlCount);
$totalArticle = $resultCount->fetch_assoc()['total'] ?? 0;

/* ======================
   AMBIL DATA ARTICLE
====================== */
$sql = "SELECT * FROM article ORDER BY tanggal DESC";
$result = $conn->query($sql);
?>

<div class="container">
		<div class="row mb-2">
        <div class="col-md-6">
            <!-- button -->
        </div>
        <div class="col-md-6">
        <div class="input-group">
        <input type="text" id="search" class="form-control" placeholder="Cari Artikel...">
        <span class="input-group-text">
        <i class="bi bi-search"></i>
        </span>
        </div>
        </div>
    </div>
    <!-- TOMBOL TAMBAH -->
    <button
        type="button"
        class="btn btn-secondary mb-3"
        data-bs-toggle="modal"
        data-bs-target="#modalTambah"
    >
         Tambah Article
    </button>

    <!-- TABEL ARTICLE -->
    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead class="table-dark">
                <tr>
                    <th width="5%">No</th>
                    <th width="20%">Judul</th>
                    <th width="35%">Isi</th>
                    <th width="20%">Gambar</th>
                    <th width="10%">Aksi</th>
                </tr>
            </thead>
            <tbody id="result">

            <?php if ($result && $result->num_rows > 0): ?>
                <?php $no = 1; while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?= $no++; ?></td>

                        <td>
                            <strong><?= htmlspecialchars($row['judul']); ?></strong><br>
                            <small>
                                <?= $row['tanggal']; ?> |
                                <?= htmlspecialchars($row['username']); ?>
                            </small>
                        </td>

                        <td><?= nl2br(htmlspecialchars($row['isi'])); ?></td>

                        <td>
                            <?php if (!empty($row['gambar']) && file_exists('gambar/'.$row['gambar'])): ?>
                                <img src="gambar/<?= $row['gambar']; ?>" class="img-fluid rounded" width="120">
                            <?php else: ?>
                                <span class="text-muted">Tidak ada</span>
                            <?php endif; ?>
                        </td>

                        <td>
                            <a href="#" title="edit" class="badge rounded-pill text-bg-success" data-bs-toggle="modal" data-bs-target="#modalEdit<?= $row["id"] ?>"><i class="bi bi-pencil"></i></a>
                            <a href="#" title="delete" class="badge rounded-pill text-bg-danger" data-bs-toggle="modal" data-bs-target="#modalHapus<?= $row["id"] ?>"><i class="bi bi-x-circle"></i></a>

<!-- Awal Modal Edit -->
<div class="modal fade" id="modalEdit<?= $row["id"] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Edit Article</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" action="" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="judul" class="form-label">Judul</label>
                        <input type="hidden" name="id" value="<?= $row["id"] ?>">
                        <input type="text" class="form-control" name="judul" placeholder="Tuliskan Judul Artikel" value="<?= $row["judul"] ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="isi">Isi</label>
                        <textarea class="form-control" placeholder="Tuliskan Isi Artikel" name="isi" required><?= $row["isi"] ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="gambar" class="form-label">Ganti Gambar</label>
                        <input type="file" class="form-control" name="gambar">
                    </div>
                    <div class="mb-3">
                        <label for="formGroupExampleInput3" class="form-label">Gambar Lama</label>
                        <?php
                        if ($row["gambar"] != '') {
                            if (file_exists('img/' . $row["gambar"] . '')) { 
                                echo '<br><img src="img/' . $row["gambar"] . '" class="img-fluid" alt="Gambar Artikel">';
                            }
                        }
                        ?>
                        <input type="hidden" name="gambar_lama" value="<?= $row["gambar"] ?>">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <input type="submit" value="simpan" name="simpan" class="btn btn-primary">
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Akhir Modal Edit -->

<!-- Awal Modal Hapus -->
<div class="modal fade" id="modalHapus<?= $row["id"] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Konfirmasi Hapus Article</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" action="" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="formGroupExampleInput" class="form-label">Yakin akan menghapus artikel "<strong><?= $row["judul"] ?></strong>"?</label>
                        <input type="hidden" name="id" value="<?= $row["id"] ?>">
                        <input type="hidden" name="gambar" value="<?= $row["gambar"] ?>">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">batal</button>
                    <input type="submit" value="hapus" name="hapus" class="btn btn-primary">
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Akhir Modal Hapus -->
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5" class="text-center text-muted">
                        Belum ada article
                    </td>
                </tr>
            <?php endif; ?>

            </tbody>
        </table>
    </div>
</div>

<!-- ======================
     MODAL TAMBAH ARTICLE
====================== -->
<div class="modal fade" id="modalTambah" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Tambah Article</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <form method="post" enctype="multipart/form-data">
                <div class="modal-body">

                    <div class="mb-3">
                        <label class="form-label">Judul</label>
                        <input type="text" name="judul" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Isi</label>
                        <textarea name="isi" class="form-control" rows="4" required></textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Gambar</label>
                        <input type="file" name="gambar" class="form-control">
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
                </div>
            </form>

        </div>
    </div>
</div>

<script>
    function loadData(keyword = '') {
        $.ajax({
            url: "article_search.php",
            type: "POST",
            data: {
                keyword: keyword
            },
            success: function(data) {
                $("#result").html(data);
            }
        });
    }

    // load awal
    loadData();
    		// event pencarian
    $("#search").on("keyup", function() {
        let keyword = $(this).val();
        loadData(keyword);
    });
</script>

<?php
include "upload_foto.php";

//jika tombol simpan diklik
if (isset($_POST['simpan'])) {
    $judul = $_POST['judul'];
    $isi = $_POST['isi'];
    $tanggal = date("Y-m-d H:i:s");
    $username = $_SESSION['username'];
    $gambar = '';
    $nama_gambar = $_FILES['gambar']['name'];

    //jika ada file baru yang dikirim  
    if ($nama_gambar != '') {
        //panggil function upload_foto untuk cek detail file yg diupload user
        //function ini memiliki keluaran sebuah array yang berisi status dan message
        $cek_upload = upload_foto($_FILES["gambar"]);

        //cek status upload file hasilnya true/false
        if ($cek_upload['status']) {
            //jika true maka message berisi nama file gambar
            $gambar = $cek_upload['message'];
        } else {
            //jika true maka message berisi pesan error, tampilkan dalam alert
            echo "<script>
                alert('" . $cek_upload['message'] . "');
                document.location='admin.php?page=article';
            </script>";
            die;
        }
    }

   		//cek apakah ada id yang dikirimkan dari form
    if (isset($_POST['id'])) {
        //jika ada id, lakukan update data dengan id tersebut
        $id = $_POST['id'];

        if ($nama_gambar == '') {
            //jika tidak ganti gambar
            $gambar = $_POST['gambar_lama'];
        } else {
            //jika ganti gambar, hapus gambar lama
            unlink("img/" . $_POST['gambar_lama']);
        }

        $stmt = $conn->prepare("UPDATE article 
                                SET 
                                judul =?,
                                isi =?,
                                gambar = ?,
                                tanggal = ?,
                                username = ?
                                WHERE id = ?");

        $stmt->bind_param("sssssi", $judul, $isi, $gambar, $tanggal, $username, $id);
        $simpan = $stmt->execute();
    } else {
		    //jika tidak ada id, lakukan insert data baru
        $stmt = $conn->prepare("INSERT INTO article (judul,isi,gambar,tanggal,username)
                                VALUES (?,?,?,?,?)");

        $stmt->bind_param("sssss", $judul, $isi, $gambar, $tanggal, $username);
        $simpan = $stmt->execute();
    }
    if ($simpan) {
        echo "<script>
            alert('Simpan data sukses');
            document.location='admin.php?page=article';
        </script>";
    } else {
        echo "<script>
            alert('Simpan data gagal');
            document.location='admin.php?page=article';
        </script>";
    }

    $stmt->close();
    $conn->close();
}

//jika tombol hapus diklik
if (isset($_POST['hapus'])) {
    $id = $_POST['id'];
    $gambar = $_POST['gambar'];

    if ($gambar != '') {
        //hapus file gambar dari folder /img
        unlink("img/" . $gambar);
    }

    $stmt = $conn->prepare("DELETE FROM article WHERE id =?");

    $stmt->bind_param("i", $id);
    $hapus = $stmt->execute();

    if ($hapus) {
        echo "<script>
            alert('Hapus data sukses');
            document.location='admin.php?page=article';
        </script>";
    } else {
        echo "<script>
            alert('Hapus data gagal');
            document.location='admin.php?page=article';
        </script>";
    }

    $stmt->close();
    $conn->close();
}
 
?>