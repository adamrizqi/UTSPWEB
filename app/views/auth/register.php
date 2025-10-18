<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Buat Akun Baru</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="auth-wrapper">
    <div class="form-section form-section--register">
        <div class="form-container">
            <div class="card auth-card">
                <div class="card-body">
                    <div class="form-header mb-3"> 
                        <small>NEW MEMBER</small>
                    </div>

                    <form id="register-form" action="index.php?controller=auth&action=prosesRegister" method="POST">
                        <div class="mb-3">
                            <input type="text" class="form-control" name="nama_lengkap" placeholder="Nama Lengkap" required>
                        </div>
                        <div class="mb-3">
                            <input type="text" class="form-control" name="username" placeholder="Username" required>
                        </div>
                        <div class="mb-3"> 
                            <input type="password" class="form-control" name="password" placeholder="Password" required>
                        </div>
                        <div class="d-grid mt-4"> 
                            <button class="btn btn-custom" type="submit">CREATE ACCOUNT</button>
                        </div>
                    </form>
                </div>
            </div>
            
            <div class="text-center mt-3 auth-link"> 
                <small>Already have an account?</small>
                <a href="index.php?controller=auth&action=formLogin">Sign In</a>
            </div>
        </div>
    </div>

    <div class="illustration-section"></div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="js/app.js"></script>
<?php displayFlashMessage(); ?>

</body>
</html>