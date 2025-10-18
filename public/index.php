<?php
session_start(); 

define('BASE_PATH', dirname(__DIR__));

require_once BASE_PATH . '/app/database.php';
require_once BASE_PATH . '/app/helpers/flash_message_helper.php';
require_once BASE_PATH . '/app/models/UserModel.php';
require_once BASE_PATH . '/app/models/SiswaModel.php';
require_once BASE_PATH . '/app/controllers/AuthController.php';
require_once BASE_PATH . '/app/controllers/SiswaController.php';

$controller = $_GET['controller'] ?? 'auth'; 
$aksi = $_GET['action'] ?? 'formLogin';       

$namaController = ucfirst($controller) . 'Controller';

if (class_exists($namaController)) {
    $objekController = new $namaController();
    
    if (is_callable([$objekController, $aksi])) {
        $objekController->$aksi();
    } else {
        die("Error: Aksi '{$aksi}' tidak ditemukan atau tidak dapat diakses di controller '{$namaController}'.");
    }
} else {
    die("Error: Controller '{$namaController}' tidak ditemukan.");
}