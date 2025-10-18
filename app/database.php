<?php
// define('DB_HOST', 'localhost');
// define('DB_USER', 'root');
// define('DB_PASS', '');
// define('DB_NAME', 'db_sekolah_sdn_slumbung_01');
// define('DB_PORT', '3306');

define('DB_HOST', getenv('DB_HOST'));
define('DB_USER', getenv('DB_USER'));
define('DB_PASS', getenv('DB_PASS'));
define('DB_NAME', getenv('DB_NAME'));
define('DB_PORT', getenv('DB_PORT'));


function buatKoneksiDb() {
    $dsn = "mysql:host=" . DB_HOST . ";port=" . DB_PORT . ";dbname=" . DB_NAME . ";charset=utf8mb4";
    
    try {
        $pdo = new PDO($dsn, DB_USER, DB_PASS);
        
        // Opsi ini penting untuk menampilkan error SQL
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        return $pdo;
    } catch (PDOException $e) {
        die("Koneksi ke database gagal: " . $e->getMessage());
    }
}