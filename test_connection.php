<?php
/**
 * Archivo de prueba de conexión y configuración
 */
require_once 'config/config.php';

echo "<!DOCTYPE html>
<html lang='es'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Test de Conexión - FutbolManager</title>
    <script src='https://cdn.tailwindcss.com'></script>
</head>
<body class='bg-gray-100'>
    <div class='container mx-auto px-4 py-8'>
        <div class='max-w-2xl mx-auto bg-white rounded-lg shadow-lg p-6'>
            <h1 class='text-3xl font-bold text-center mb-6 text-blue-600'>Test de Conexión - FutbolManager</h1>";

// Test 1: URL Base
echo "<div class='mb-4 p-4 border rounded'>";
echo "<h2 class='text-xl font-semibold mb-2'>✓ URL Base detectada</h2>";
echo "<p class='text-gray-700'><strong>BASE_URL:</strong> " . BASE_URL . "</p>";
echo "</div>";

// Test 2: Rutas del sistema
echo "<div class='mb-4 p-4 border rounded'>";
echo "<h2 class='text-xl font-semibold mb-2'>✓ Rutas del sistema</h2>";
echo "<p class='text-gray-700'><strong>ROOT_PATH:</strong> " . ROOT_PATH . "</p>";
echo "<p class='text-gray-700'><strong>APP_PATH:</strong> " . APP_PATH . "</p>";
echo "<p class='text-gray-700'><strong>PUBLIC_PATH:</strong> " . PUBLIC_PATH . "</p>";
echo "</div>";

// Test 3: Conexión a base de datos
echo "<div class='mb-4 p-4 border rounded'>";
echo "<h2 class='text-xl font-semibold mb-2'>Conexión a Base de Datos</h2>";
try {
    require_once 'config/database.php';
    $db = Database::getInstance();
    $conn = $db->getConnection();
    
    echo "<p class='text-green-600 font-semibold'>✓ Conexión exitosa</p>";
    echo "<p class='text-gray-700'><strong>Host:</strong> " . DB_HOST . "</p>";
    echo "<p class='text-gray-700'><strong>Base de datos:</strong> " . DB_NAME . "</p>";
    echo "<p class='text-gray-700'><strong>Usuario:</strong> " . DB_USER . "</p>";
    
    // Verificar versión de MySQL
    $version = $conn->query('SELECT VERSION()')->fetchColumn();
    echo "<p class='text-gray-700'><strong>Versión MySQL:</strong> " . $version . "</p>";
} catch (Exception $e) {
    echo "<p class='text-red-600 font-semibold'>✗ Error de conexión</p>";
    echo "<p class='text-red-500'>" . $e->getMessage() . "</p>";
    echo "<div class='mt-4 p-4 bg-yellow-50 border border-yellow-200 rounded'>";
    echo "<p class='text-sm text-gray-700'><strong>Nota:</strong> Si la base de datos no existe, ejecuta el archivo <code>database/schema.sql</code> para crearla.</p>";
    echo "</div>";
}
echo "</div>";

// Test 4: Permisos de escritura
echo "<div class='mb-4 p-4 border rounded'>";
echo "<h2 class='text-xl font-semibold mb-2'>Permisos de escritura</h2>";
$uploadPath = PUBLIC_PATH . '/uploads';
if (!file_exists($uploadPath)) {
    // Usar 0750 para mayor seguridad (rwxr-x---)
    mkdir($uploadPath, 0750, true);
}
if (is_writable($uploadPath)) {
    echo "<p class='text-green-600'>✓ Directorio de uploads escribible</p>";
} else {
    echo "<p class='text-red-600'>✗ Directorio de uploads NO escribible</p>";
    echo "<p class='text-sm text-gray-600'>Ejecuta: chmod -R 750 " . $uploadPath . "</p>";
}
echo "</div>";

// Test 5: Extensiones PHP requeridas
echo "<div class='mb-4 p-4 border rounded'>";
echo "<h2 class='text-xl font-semibold mb-2'>Extensiones PHP</h2>";
$extensions = ['pdo', 'pdo_mysql', 'mbstring', 'json', 'session'];
foreach ($extensions as $ext) {
    if (extension_loaded($ext)) {
        echo "<p class='text-green-600'>✓ $ext</p>";
    } else {
        echo "<p class='text-red-600'>✗ $ext (requerida)</p>";
    }
}
echo "<p class='text-gray-700 mt-2'><strong>Versión PHP:</strong> " . PHP_VERSION . "</p>";
echo "</div>";

echo "
            <div class='text-center mt-6'>
                <a href='" . BASE_URL . "' class='bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-6 rounded'>
                    Ir al Sistema
                </a>
            </div>
        </div>
    </div>
</body>
</html>";
