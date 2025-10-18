<?php
session_start(); 

require_once '../app/database.php';
require_once '../app/helpers/flash_message_helper.php';
require_once '../app/models/UserModel.php';
require_once '../app/models/SiswaModel.php';
require_once '../app/controllers/AuthController.php';
require_once '../app/controllers/SiswaController.php';

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