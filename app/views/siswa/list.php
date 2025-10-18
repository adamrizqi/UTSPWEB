<?php 
require_once BASE_PATH . '/app/views/layouts/header.php';

$basePaginationUrl = 'index.php?' . http_build_query([
    'controller' => 'siswa',
    'action' => 'daftar',
    'kelas' => $kelasTerpilih,
    'keyword' => $keyword
]);
?>

<h1 class="mb-4">Manajemen Data Siswa</h1>

<div class="card shadow-sm">
    <div class="card-body">
        <div class="row mb-3">
            <div class="col-md-4 mb-2">
                <a href="index.php?controller=siswa&action=formTambah" class="btn btn-success">
                    <i class="bi bi-plus-circle-fill"></i> Tambah Data Siswa
                </a>
            </div>
            <div class="col-md-8">
                <form action="index.php" method="GET" class="d-flex justify-content-md-end gap-2">
                    <input type="hidden" name="controller" value="siswa">
                    <input type="hidden" name="action" value="daftar">
                    
                    <div class="input-group" style="max-width: 200px;">
                        <label class="input-group-text"><i class="bi bi-collection-fill"></i></label>
                        <select class="form-select" name="kelas" onchange="this.form.submit()">
                            <option value="">Semua Kelas</option>
                            <?php foreach ($daftarKelas as $kelas): ?>
                                <option value="<?php echo $kelas; ?>" <?php echo ($kelas == $kelasTerpilih) ? 'selected' : ''; ?>>
                                    <?php echo $kelas; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="input-group" style="max-width: 250px;">
                        <input type="text" class="form-control" name="keyword" placeholder="Cari Nama atau NIS..." value="<?php echo $keyword; ?>">
                        <button class="btn btn-primary" type="submit"><i class="bi bi-search"></i></button>
                    </div>
                </form>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-striped table-hover table-bordered align-middle">
                <thead class="table-dark">
                    <tr>
                        <th scope="col" class="text-center">Foto</th>
                        <th scope="col">NIS</th>
                        <th scope="col">Nama Lengkap</th>
                        <th scope="col">Kelas</th>
                        <th scope="col" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (isset($daftarSiswa) && !empty($daftarSiswa)): ?>
                        <?php foreach ($daftarSiswa as $item): ?>
                        <tr>
                            <td class="text-center">
                                <?php 
                                    $cloudName = 'dcucamoen';
                                    $fotoUrl = !empty($item['foto'])
                                        ? "https://res.cloudinary.com/{$cloudName}/image/upload/w_50,h_50,c_thumb,g_face/{$item['foto']}"
                                        : "https://placehold.co/50x50/2F4858/F4B942?text=N/A";
                                ?>
                                <img src="<?php echo $fotoUrl; ?>" alt="Foto Siswa" class="rounded-circle" style="width: 50px; height: 50px; object-fit: cover;">
                            </td>
                            <td><?php echo $item['nis']; ?></td>
                            <td><?php echo $item['nama_lengkap']; ?></td>
                            <td><?php echo $item['kelas']; ?></td>
                            <td class="text-center">
                                <a href="index.php?controller=siswa&action=formEdit&id=<?php echo $item['id']; ?>" class="btn btn-warning btn-sm">
                                    <i class="bi bi-pencil-square"></i> Edit
                                </a>
                                <a href="index.php?controller=siswa&action=hapus&id=<?php echo $item['id']; ?>" class="btn btn-danger btn-sm delete-button">
                                    <i class="bi bi-trash-fill"></i> Hapus
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" class="text-center">Data siswa tidak ditemukan.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <nav aria-label="Navigasi Halaman">
            <ul class="pagination justify-content-center">
                <li class="page-item <?php echo ($halaman <= 1) ? 'disabled' : ''; ?>">
                    <a class="page-link" href="<?php echo $basePaginationUrl . '&halaman=' . ($halaman - 1); ?>">Previous</a>
                </li>
                <?php for ($i = 1; $i <= $totalHalaman; $i++): ?>
                    <li class="page-item <?php echo ($i == $halaman) ? 'active' : ''; ?>">
                        <a class="page-link" href="<?php echo $basePaginationUrl . '&halaman=' . $i; ?>"><?php echo $i; ?></a>
                    </li>
                <?php endfor; ?>
                <li class="page-item <?php echo ($halaman >= $totalHalaman) ? 'disabled' : ''; ?>">
                    <a class="page-link" href="<?php echo $basePaginationUrl . '&halaman=' . ($halaman + 1); ?>">Next</a>
                </li>
            </ul>
        </nav>
    </div>
</div>

<?php require_once BASE_PATH . '/app/views/layouts/footer.php'; ?>