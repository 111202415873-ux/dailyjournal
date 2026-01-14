<?php
include "koneksi.php";

$keyword = $_POST['keyword'] ?? '';

$sql = "SELECT * FROM gallery 
        WHERE judul LIKE ? 
           OR username LIKE ?
        ORDER BY tanggal DESC";

$stmt = $conn->prepare($sql);
$search = "%$keyword%";
$stmt->bind_param("ss", $search, $search);
$stmt->execute();
$result = $stmt->get_result();

$no = 1;

if ($result->num_rows > 0):
    while ($row = $result->fetch_assoc()):
?>
<tr>
    <td><?= $no++; ?></td>
    <td>
        <strong><?= htmlspecialchars($row['judul']); ?></strong><br>
        <small><?= $row['tanggal']; ?> | <?= htmlspecialchars($row['username']); ?></small>
    </td>
    <td>
        <?php if (!empty($row['gambar']) && file_exists('gambar/'.$row['gambar'])): ?>
            <img src="gambar/<?= $row['gambar']; ?>"
                 class="img-fluid rounded shadow-sm"
                 style="max-width:200px; height:auto;">
        <?php else: ?>
            <span class="text-muted">Tidak ada</span>
        <?php endif; ?>
    </td>
    <td>
        <a href="#" class="badge rounded-pill text-bg-success"
           data-bs-toggle="modal" data-bs-target="#modalEdit<?= $row["id"] ?>">
           <i class="bi bi-pencil"></i>
        </a>
        <a href="#" class="badge rounded-pill text-bg-danger"
           data-bs-toggle="modal" data-bs-target="#modalHapus<?= $row["id"] ?>">
           <i class="bi bi-x-circle"></i>
        </a>

        <div class="modal fade" id="modalEdit<?= $row["id"] ?>" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5">Edit Gallery</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="post" action="" enctype="multipart/form-data">
                        <div class="modal-body text-start">
                            <div class="mb-3">
                                <label class="form-label">Judul</label>
                                <input type="hidden" name="id" value="<?= $row["id"] ?>">
                                <input type="text" class="form-control" name="judul" value="<?= htmlspecialchars($row["judul"]) ?>" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Ganti Gambar</label>
                                <input type="file" class="form-control" name="gambar">
                            </div>
                            <div class="mb-3">
                                <label class="form-label d-block">Gambar Lama</label>
                                <?php if ($row["gambar"] != '' && file_exists('gambar/' . $row["gambar"])): ?>
                                    <img src="gambar/<?= $row["gambar"] ?>" class="img-fluid rounded" width="150">
                                <?php endif; ?>
                                <input type="hidden" name="gambar_lama" value="<?= $row["gambar"] ?>">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <input type="submit" value="simpan" name="simpan" class="btn btn-primary">
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modalHapus<?= $row["id"] ?>" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5">Konfirmasi Hapus</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="post" action="">
                        <div class="modal-body text-start">
                            Yakin akan menghapus gambar "<strong><?= htmlspecialchars($row["judul"]) ?></strong>"?
                            <input type="hidden" name="id" value="<?= $row["id"] ?>">
                            <input type="hidden" name="gambar" value="<?= $row["gambar"] ?>">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <input type="submit" value="hapus" name="hapus" class="btn btn-primary">
                        </div>
                    </form>
                </div>
            </div>
        </div>
        </td>
</tr>
<?php
    endwhile;
else:
?>
<tr>
    <td colspan="4" class="text-center text-muted">Data gallery tidak ditemukan</td>
</tr>
<?php
endif;

$stmt->close();
$conn->close();
?>