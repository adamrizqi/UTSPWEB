<?php

class AuthController {
    private $userModel;

    public function __construct() {
        $this->userModel = new UserModel();
    }

    public function formLogin() {
        require_once BASE_PATH . '/app/views/auth/login.php';
    }

    public function formRegister() {
        require_once BASE_PATH . '/app/views/auth/register.php';
    }

    public function prosesLogin() {
        $userLogin = $this->userModel->periksaLogin($_POST['username'], $_POST['password']);

        if ($userLogin) {
            $_SESSION['user_id'] = $userLogin['id'];
            $_SESSION['nama_lengkap'] = $userLogin['nama_lengkap'];
            
            $redirectUrl = '?controller=siswa&action=dashboard';
            setRedirectFlashMessage('success', 'Login Berhasil!', 'Selamat datang kembali, ' . $userLogin['nama_lengkap'], $redirectUrl);
            
            $this->redirect('?controller=auth&action=showMessage');
        } else {
            setFlashMessage('error', 'Login Gagal', 'Username atau password yang Anda masukkan salah.');
            $this->redirect('?controller=auth&action=formLogin');
        }
    }

    public function prosesRegister() {
        if ($this->userModel->registerUser($_POST)) {
            $redirectUrl = '?controller=auth&action=formLogin';
            setRedirectFlashMessage('success', 'Registrasi Berhasil', 'Akun Anda telah dibuat. Silakan login.', $redirectUrl);
            
            $this->redirect('?controller=auth&action=showMessage');
        } else {
            setFlashMessage('error', 'Registrasi Gagal', 'Username mungkin sudah terdaftar atau terjadi kesalahan.');
            $this->redirect('?controller=auth&action=formRegister');
        }
    }

    public function keluar() {
        session_destroy();
        $this->redirect('?controller=auth&action=formLogin');
    }

    public function showMessage() {
        require_once BASE_PATH . '/app/views/layouts/message.php';
    }

    private function redirect($url) {
        header('Location: ' . $url);
        exit();
    }

    public function profile() {
        $dataUser = $this->userModel->findUserById($_SESSION['user_id']);
        require_once BASE_PATH . '/app/views/auth/profile.php';
    }

    public function updateProfile() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect('?controller=auth&action=profile');
        }

        $id = $_SESSION['user_id'];
        $dataToUpdate = [
            'nama_lengkap' => $_POST['nama_lengkap'],
            'username' => $_POST['username']
        ];

        if (!empty($_POST['password_lama'])) {
            $user = $this->userModel->periksaLogin($_POST['username'], $_POST['password_lama']);

            if (!$user) {
                setFlashMessage('error', 'Gagal!', 'Password lama yang Anda masukkan salah.');
                $this->redirect('?controller=auth&action=profile');
            }
            if (empty($_POST['password_baru']) || $_POST['password_baru'] !== $_POST['konfirmasi_password']) {
                setFlashMessage('error', 'Gagal!', 'Password baru dan konfirmasi tidak cocok.');
                $this->redirect('?controller=auth&action=profile');
            }

            $dataToUpdate['password'] = $_POST['password_baru'];
        }

        if ($this->userModel->updateProfile($id, $dataToUpdate)) {
            $_SESSION['nama_lengkap'] = $dataToUpdate['nama_lengkap'];
            setFlashMessage('success', 'Berhasil!', 'Profil Anda telah diperbarui.');
        } else {
            setFlashMessage('error', 'Gagal!', 'Terjadi kesalahan saat memperbarui profil.');
        }
        
        $this->redirect('?controller=auth&action=profile');
    }
}