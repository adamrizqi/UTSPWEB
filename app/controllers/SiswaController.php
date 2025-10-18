<?php

class SiswaController {
    private $modelSiswa;

    public function __construct() {
        if (!isset($_SESSION['user_id'])) {
            $this->redirect('?controller=auth&action=formLogin');
        }
        $this->modelSiswa = new SiswaModel();
    }

    public function dashboard() {
        $totalSiswa = $this->modelSiswa->hitungTotalSiswa();
        $siswaPerKelas = $this->modelSiswa->hitungSiswaPerKelas();

        $chartLabels = [];
        $chartData = [];
        foreach ($siswaPerKelas as $data) {
            $chartLabels[] = $data['kelas'];
            $chartData[] = $data['jumlah'];
        }

        require_once BASE_PATH . '/app/views/siswa/dashboard.php';
    }

    public function daftar() {
        $limit = 6; 
        $halaman = isset($_GET['halaman']) ? (int)$_GET['halaman'] : 1;
        $offset = ($halaman - 1) * $limit;
        
        $daftarKelas = $this->modelSiswa->getKelasUnik();
        $kelasTerpilih = $_GET['kelas'] ?? '';
        $keyword = $_GET['keyword'] ?? '';

        $totalData = $this->modelSiswa->hitungTotalData($keyword, $kelasTerpilih);
        $totalHalaman = ceil($totalData / $limit);

        $daftarSiswa = $this->modelSiswa->cari($limit, $offset, $keyword, $kelasTerpilih);
        
        require_once BASE_PATH . '/app/views/siswa/list.php';
    }

    public function formTambah() {
        require_once BASE_PATH . '/app/views/siswa/form.php';
    }

    public function formEdit() {
        $idSiswa = $_GET['id'];
        $dataSiswa = $this->modelSiswa->cariBerdasarkanId($idSiswa);
        require_once BASE_PATH . '/app/views/siswa/form.php';
    }

    public function simpan() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = $_POST;
            $data['foto'] = $this->uploadFotoViaApi();

            $this->modelSiswa->tambahData($data);
            
            $this->setFlashAndRedirect(
                'success', 
                'Berhasil!', 
                'Data siswa baru telah ditambahkan.', 
                '?controller=siswa&action=daftar'
            );
        }
    }

    public function perbarui() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $idSiswa = $_POST['id'];
            $data = $_POST;

            if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
                $public_id_baru = $this->uploadFotoViaApi();
                if ($public_id_baru) {
                    $data['foto'] = $public_id_baru;
                }
            }

            $this->modelSiswa->ubahData($idSiswa, $data);

            $this->setFlashAndRedirect(
                'success', 
                'Berhasil!', 
                'Data siswa telah diperbarui.', 
                '?controller=siswa&action=daftar'
            );
        }
    }

    public function hapus() {
        $idSiswa = $_GET['id'];
        $this->modelSiswa->hapusData($idSiswa);

        $this->setFlashAndRedirect(
            'success', 
            'Berhasil!', 
            'Data siswa telah dihapus.', 
            '?controller=siswa&action=daftar'
        );
    }

    public function showMessage() {
        require_once BASE_PATH . '/app/views/layouts/message.php';
    }

    private function redirect($url) {
        header('Location: ' . $url);
        exit();
    }

    private function setFlashAndRedirect($type, $title, $text, $redirectUrl) {
        setRedirectFlashMessage($type, $title, $text, $redirectUrl);
        $this->redirect('?controller=siswa&action=showMessage');
    }

    private function uploadFotoViaApi() {
        if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
            $cloudName = 'dcucamoen';
            $uploadPreset = 'preset_siswa'; 
            
            $url = "https://api.cloudinary.com/v1_1/{$cloudName}/image/upload";
            $filePath = $_FILES['foto']['tmp_name'];

            $postData = [
                'file' => new \CURLFile($filePath),
                'upload_preset' => $uploadPreset,
            ];

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $response = curl_exec($ch);
            curl_close($ch);

            $result = json_decode($response, true);

            if (isset($result['public_id'])) {
                return $result['public_id'];
            }
        }
        return null;
    }
}