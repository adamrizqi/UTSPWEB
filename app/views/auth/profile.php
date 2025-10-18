<?php require_once BASE_PATH . '/app/views/layouts/header.php'; ?>

<h1 class="mb-4">Profil Pengguna</h1>

<form id="profile-form" action="index.php?controller=auth&action=updateProfile" method="POST">
    <div class="row">
        <div class="col-lg-6">
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-primary text-white">
                    <h6 class="m-0 fw-bold">Informasi Akun</h6>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                        <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" value="<?php echo $dataUser['nama_lengkap']; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" id="username" name="username" value="<?php echo $dataUser['username']; ?>" required>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card shadow-sm mb-4">
                <div class="card-header">
                    <h6 class="m-0 fw-bold">Ubah Password</h6>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label for="password_lama" class="form-label">Password Saat Ini</label>
                        <input type="password" class="form-control" id="password_lama" name="password_lama" placeholder="Kosongkan jika tidak ingin diubah">
                    </div>
                    <div class="mb-3">
                        <label for="password_baru" class="form-label">Password Baru</label>
                        <input type="password" class="form-control" id="password_baru" name="password_baru">
                    </div>
                    <div class="mb-3">
                        <label for="konfirmasi_password" class="form-label">Konfirmasi Password Baru</label>
                        <input type="password" class="form-control" id="konfirmasi_password" name="konfirmasi_password">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="d-flex justify-content-end">
        <button type="submit" class="btn btn-primary fw-bold">
            <i class="bi bi-save-fill"></i> Simpan Perubahan
        </button>
    </div>
</form>

<?php require_once BASE_PATH . '/app/views/layouts/footer.php'; ?>