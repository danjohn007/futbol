<?php
/**
 * Configuración principal del sistema
 */

// Detectar automáticamente la URL base
function getBaseUrl() {
    $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http';
    $host = $_SERVER['HTTP_HOST'];
    $script = $_SERVER['SCRIPT_NAME'];
    $path = str_replace(basename($script), '', $script);
    return $protocol . '://' . $host . $path;
}

// Configuración de la base de datos
define('DB_HOST', 'localhost');
define('DB_NAME', 'residenc_futbol');
define('DB_USER', 'residenc_futbol');
define('DB_PASS', 'Danjohn007');
define('DB_CHARSET', 'utf8mb4');

// URL base del sistema
define('BASE_URL', rtrim(getBaseUrl(), '/'));

// Rutas del sistema
define('ROOT_PATH', dirname(__DIR__));
define('APP_PATH', ROOT_PATH . '/app');
define('PUBLIC_PATH', ROOT_PATH . '/public');
define('UPLOAD_PATH', PUBLIC_PATH . '/uploads');

// Configuración de la aplicación
define('APP_NAME', 'FutbolManager');
define('APP_VERSION', '1.0.0');

// Configuración de sesión
define('SESSION_LIFETIME', 3600); // 1 hora

// Configuración de correo (por defecto)
define('MAIL_FROM', 'no-reply@futbolmanager.com');
define('MAIL_FROM_NAME', 'FutbolManager');

// Configuración de zona horaria
date_default_timezone_set('America/Mexico_City');

// Modo de desarrollo/producción
define('DEBUG_MODE', true);

// Configuración de errores
if (DEBUG_MODE) {
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
} else {
    error_reporting(0);
    ini_set('display_errors', 0);
}

// Incluir autoloader
require_once ROOT_PATH . '/app/core/Autoloader.php';
