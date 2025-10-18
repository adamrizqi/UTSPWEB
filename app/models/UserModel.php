<?php

class UserModel {
    private $pdo;

    public function __construct() {
        $this->pdo = buatKoneksiDb();
    }

    public function periksaLogin($username, $password) {
        $sql = "SELECT * FROM users WHERE username = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            return $user;
        }
        
        return false;
    }

    public function registerUser($data) {
        try {
            $hashedPassword = password_hash($data['password'], PASSWORD_DEFAULT);
            $sql = "INSERT INTO users (nama_lengkap, username, password) VALUES (?, ?, ?)";
            
            $stmt = $this->pdo->prepare($sql);

            return $stmt->execute([
                $data['nama_lengkap'],
                $data['username'],
                $hashedPassword 
            ]);
        } catch (PDOException $e) {
            return false;
        }
    }

    public function findUserById($id) {
        $sql = "SELECT id, username, nama_lengkap FROM users WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateProfile($id, $data) {
        $setParts = [];
        $values = [];

        if (!empty($data['nama_lengkap'])) {
            $setParts[] = "nama_lengkap = ?";
            $values[] = $data['nama_lengkap'];
        }
        if (!empty($data['username'])) {
            $setParts[] = "username = ?";
            $values[] = $data['username'];
        }
        if (!empty($data['password'])) {
            $setParts[] = "password = ?";
            $values[] = password_hash($data['password'], PASSWORD_DEFAULT);
        }
        
        if (empty($setParts)) {
            return true;
        }

        $values[] = $id;

        $sql = "UPDATE users SET " . implode(', ', $setParts) . " WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute($values);
    }
}