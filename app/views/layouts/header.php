<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard - Sistem Informasi Siswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/css/dashboard.css"> 
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>

<div class="d-flex" id="wrapper">
    <div id="sidebar-wrapper">
        <div class="sidebar-heading text-center">
            <i class="bi bi-building"></i> SDN Slumbung 01
        </div>
        <div class="list-group list-group-flush">
            <?php $currentAction = $_GET['action'] ?? 'dashboard'; ?>

            <a href="?controller=siswa&action=dashboard" class="list-group-item list-group-item-action <?php echo ($currentAction == 'dashboard') ? 'active' : ''; ?>">
                <i class="bi bi-grid-fill me-2"></i>Dashboard
            </a>
            <a href="?controller=siswa&action=daftar" class="list-group-item list-group-item-action <?php echo ($currentAction == 'daftar') ? 'active' : ''; ?>">
                <i class="bi bi-people-fill me-2"></i>Data Siswa
            </a>
        </div>  
    </div>
    
    <div id="page-content-wrapper">
        <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom shadow-sm">
            <div class="container-fluid">
                <button class="btn btn-primary d-lg-none" id="menu-toggle"><i class="bi bi-list"></i></button>

                <div class="collapse navbar-collapse"></div>

                <div class="dropdown">
                    <a href="#" class="d-flex align-items-center text-dark text-decoration-none dropdown-toggle" id="dropdownUser" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-person-circle fs-4 me-2"></i>
                        <strong><?php echo $_SESSION['nama_lengkap']; ?></strong>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownUser">
                        <li><a class="dropdown-item" href="?controller=auth&action=profile">Profil</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <a class="dropdown-item logout-button" href="?controller=auth&action=keluar">
                                <i class="bi bi-box-arrow-right me-2"></i>Logout
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <main class="container-fluid p-4">