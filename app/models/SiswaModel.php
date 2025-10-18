<?php

class SiswaModel {
    private $pdo;

    public function __construct() {
        $this->pdo = buatKoneksiDb();
    }

    private function buildQueryParts($keyword, $kelas) {
        $conditions = [];
        $parameters = [];

        if (!empty($keyword)) {
            $conditions[] = "(nama_lengkap LIKE ? OR nis LIKE ?)";
            $parameters[] = "%" . $keyword . "%";
            $parameters[] = "%" . $keyword . "%";
        }

        if (!empty($kelas)) {
            $conditions[] = "kelas = ?";
            $parameters[] = $kelas;
        }

        $whereClause = !empty($conditions) ? " WHERE " . implode(' AND ', $conditions) : "";
        
        return ['where' => $whereClause, 'params' => $parameters];
    }

    public function hitungTotalData($keyword = '', $kelas = '') {
        $queryParts = $this->buildQueryParts($keyword, $kelas);
        $sql = "SELECT COUNT(*) FROM siswa" . $queryParts['where'];
        
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($queryParts['params']);
        return $stmt->fetchColumn();
    }

    public function cari($limit, $offset, $keyword = '', $kelas = '') {
        $queryParts = $this->buildQueryParts($keyword, $kelas);
        
        $sql = "SELECT id, nis, nama_lengkap, kelas, foto FROM siswa" . $queryParts['where'];
        
        $sql .= " ORDER BY kelas, nama_lengkap LIMIT " . (int)$limit . " OFFSET " . (int)$offset;

        $stmt = $this->pdo->prepare($sql);
        
        $stmt->execute($queryParts['params']);
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getKelasUnik() {
        $sql = "SELECT DISTINCT kelas FROM siswa ORDER BY kelas ASC";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_COLUMN); 
    }

    public function cariBerdasarkanId($id) {
        $sql = "SELECT * FROM siswa WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function tambahData($data) {
        $sql = "INSERT INTO siswa (nis, nama_lengkap, jenis_kelamin, tanggal_lahir, kelas, alamat, nama_wali, telepon_wali, foto) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            $data['nis'], $data['nama_lengkap'], $data['jenis_kelamin'],
            $data['tanggal_lahir'], $data['kelas'], $data['alamat'],
            $data['nama_wali'], $data['telepon_wali'], $data['foto']
        ]);
    }
    
    public function ubahData($id, $data) {
        $setParts = [];
        $values = [];

        $fields = ['nis', 'nama_lengkap', 'jenis_kelamin', 'tanggal_lahir', 'kelas', 'alamat', 'nama_wali', 'telepon_wali'];
        
        foreach ($fields as $field) {
            $setParts[] = "{$field} = ?";
            $values[] = $data[$field];
        }

        if (isset($data['foto'])) {
            $setParts[] = "foto = ?";
            $values[] = $data['foto'];
        }

        $values[] = $id;

        $sql = "UPDATE siswa SET " . implode(', ', $setParts) . " WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute($values);
    }

    public function hapusData($id) {
        $sql = "DELETE FROM siswa WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$id]);
    }

    public function hitungTotalSiswa() {
        $stmt = $this->pdo->query("SELECT COUNT(*) FROM siswa");
        return $stmt->fetchColumn();
    }

    public function hitungSiswaPerKelas() {
        $sql = "SELECT kelas, COUNT(*) as jumlah FROM siswa GROUP BY kelas ORDER BY kelas ASC";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}