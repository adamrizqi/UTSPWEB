<?php 
$modeEdit = isset($dataSiswa);
$judulHalaman = $modeEdit ? 'Edit Data Siswa' : 'Tambah Siswa Baru';
$actionForm = $modeEdit ? 'index.php?controller=siswa&action=perbarui' : 'index.php?controller=siswa&action=simpan';

require_once BASE_PATH . '/app/views/layouts/header.php'; 
?>

<h1 class="mb-4"><?php echo $judulHalaman; ?></h1>

<div class="card shadow-sm">
    <div class="card-body">
        <form id="siswa-form" action="<?php echo $actionForm; ?>" method="POST" enctype="multipart/form-data">
            <?php if ($modeEdit): ?>
                <input type="hidden" name="id" value="<?php echo $dataSiswa['id']; ?>">
            <?php endif; ?>

            <div class="row g-4">
                <div class="col-md-4 text-center">
                    <label class="form-label fw-bold">Foto Siswa</label>
                    <?php
                        $cloudName = 'dcucamoen';
                        $fotoUrl = !empty($dataSiswa['foto'])
                            ? "https://res.cloudinary.com/{$cloudName}/image/upload/w_200,h_200,c_fill,g_face/{$dataSiswa['foto']}"
                            : "https://placehold.co/200x200/2F4858/F4B942?text=Foto";
                    ?>
                    <img src="<?php echo $fotoUrl; ?>" id="fotoPreview" class="img-thumbnail mb-3" style="width: 200px; height: 200px; object-fit: cover;">
                    
                    <input class="form-control" type="file" name="foto" id="fotoInput" accept="image/jpeg, image/png">
                    <small class="form-text text-muted">Max. 2MB (JPG, PNG)</small>
                </div>

                <div class="col-md-8">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="nis" class="form-label fw-bold">NIS (Nomor Induk Siswa)</label>
                            <input type="text" class="form-control" id="nis" name="nis" value="<?php echo $modeEdit ? $dataSiswa['nis'] : ''; ?>" required>
                        </div>
                        <div class="col-md-6">
                            <label for="nama_lengkap" class="form-label fw-bold">Nama Lengkap</label>
                            <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" value="<?php echo $modeEdit ? $dataSiswa['nama_lengkap'] : ''; ?>" required>
                        </div>
                        <div class="col-md-4">
                            <label for="jenis_kelamin" class="form-label fw-bold">Jenis Kelamin</label>
                            <select class="form-select" id="jenis_kelamin" name="jenis_kelamin" required>
                                <option value="L" <?php echo ($modeEdit && $dataSiswa['jenis_kelamin'] == 'L') ? 'selected' : ''; ?>>Laki-laki</option>
                                <option value="P" <?php echo ($modeEdit && $dataSiswa['jenis_kelamin'] == 'P') ? 'selected' : ''; ?>>Perempuan</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="tanggal_lahir" class="form-label fw-bold">Tanggal Lahir</label>
                            <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" value="<?php echo $modeEdit ? $dataSiswa['tanggal_lahir'] : ''; ?>" required>
                        </div>
                        <div class="col-md-4">
                            <label for="kelas" class="form-label fw-bold">Kelas</label>
                            <input type="text" class="form-control" id="kelas" name="kelas" value="<?php echo $modeEdit ? $dataSiswa['kelas'] : ''; ?>" required placeholder="Contoh: 1A, 3B, 6">
                        </div>
                        <div class="col-12">
                           <label for="alamat" class="form-label fw-bold">Alamat</label>
                           <textarea class="form-control" id="alamat" name="alamat" rows="2"><?php echo $modeEdit ? $dataSiswa['alamat'] : ''; ?></textarea>
                        </div>
                        <div class="col-md-6">
                            <label for="nama_wali" class="form-label fw-bold">Nama Wali</label>
                            <input type="text" class="form-control" id="nama_wali" name="nama_wali" value="<?php echo $modeEdit ? $dataSiswa['nama_wali'] : ''; ?>">
                        </div>
                        <div class="col-md-6">
                            <label for="telepon_wali" class="form-label fw-bold">Telepon Wali</label>
                            <input type="tel" class="form-control" id="telepon_wali" name="telepon_wali" value="<?php echo $modeEdit ? $dataSiswa['telepon_wali'] : ''; ?>">
                        </div>
                    </div>
                </div>
            </div>

            <hr class="my-4">

            <div class="d-flex justify-content-end">
                <a href="index.php?controller=siswa&action=daftar" class="btn btn-secondary me-2">
                    <i class="bi bi-x-circle"></i> Batal
                </a>
                <button type="submit" class="btn btn-primary fw-bold">
                    <i class="bi bi-save-fill"></i> <?php echo $modeEdit ? 'Update Data' : 'Simpan Data'; ?>
                </button>
            </div>
        </form>
    </div>
</div>

<?php require_once BASE_PATH . '/app/views/layouts/footer.php'; ?>