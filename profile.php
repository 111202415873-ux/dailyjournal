<?php
include "koneksi.php"; // Pastikan file koneksi sudah benar

// 1. Ambil data user yang sedang login dari session
$username = $_SESSION['username'];
$sql = "SELECT * FROM user WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

// 2. Proses Update jika tombol simpan ditekan
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $password = $_POST['password'];
    $foto_baru = $_FILES['foto']['name'];
    $folder_tujuan = "gambar/"; // SUDAH DIUBAH KE FOLDER 'gambar'

    // Update Password (jika diisi)
    if (!empty($password)) {
        $password_hashed = md5($password); 
        $sql_pass = "UPDATE user SET password = ? WHERE username = ?";
        $stmt_pass = $conn->prepare($sql_pass);
        $stmt_pass->bind_param("ss", $password_hashed, $username);
        $stmt_pass->execute();
    }

    // Update Foto (jika ada file diupload)
    if (!empty($foto_baru)) {
        // Beri nama unik agar tidak bentrok (opsional tapi disarankan)
        $nama_file_baru = date('YmdHis') . "_" . $foto_baru;
        $target_file = $folder_tujuan . $nama_file_baru;

        // Validasi upload
        if (move_uploaded_file($_FILES['foto']['tmp_name'], $target_file)) {
            // Hapus foto lama dari folder jika ada
            if (!empty($row['foto']) && file_exists($folder_tujuan . $row['foto'])) {
                unlink($folder_tujuan . $row['foto']);
            }

            // Update nama file di database
            $sql_foto = "UPDATE user SET foto = ? WHERE username = ?";
            $stmt_foto = $conn->prepare($sql_foto);
            $stmt_foto->bind_param("ss", $nama_file_baru, $username);
            $stmt_foto->execute();
        }
    }

    echo "<script>alert('Profil Berhasil Diperbarui!'); window.location='admin.php?page=profile';</script>";
}
?>

<div class="container">
    <form action="" method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <label class="form-label fw-bold">Username</label>
            <input type="text" class="form-control" name="username" value="<?= htmlspecialchars($row['username']) ?>" readonly>
        </div>
        <div class="mb-3">
            <label class="form-label fw-bold">Ganti Password</label>
            <input type="password" class="form-control" name="password" placeholder="Tuliskan Password Baru Jika Ingin Mengganti Password Saja">
        </div>
        <div class="mb-3">
            <label class="form-label fw-bold">Ganti Foto Profil</label>
            <input type="file" class="form-control" name="foto">
        </div>
        <div class="mb-3">
            <label class="form-label fw-bold d-block">Foto Profil Saat Ini</label>
            <?php
            // Cek apakah ada foto di database, jika tidak tampilkan default atau kosong
            $foto_tampil = !empty($row['foto']) ? "gambar/" . $row['foto'] : "https://via.placeholder.com/150";
            ?>
            <img src="<?= $foto_tampil ?>" width="150" class="img-thumbnail rounded shadow-sm mb-3">
        </div>
        <button type="submit" class="btn btn-primary px-4">simpan</button>
    </form>
</div>