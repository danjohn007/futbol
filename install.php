<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Instalación - FutbolManager</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="container mx-auto px-4 py-8">
        <div class="max-w-4xl mx-auto">
            <div class="bg-white rounded-lg shadow-lg p-8">
                <h1 class="text-3xl font-bold text-center mb-8 text-blue-600">
                    <i class="fas fa-futbol"></i> FutbolManager - Asistente de Instalación
                </h1>
                
                <?php
                $step = $_GET['step'] ?? 1;
                
                if ($step == 1):
                ?>
                
                <!-- Paso 1: Bienvenida -->
                <div class="mb-8">
                    <h2 class="text-2xl font-bold mb-4">Bienvenido</h2>
                    <p class="text-gray-700 mb-4">
                        Este asistente te guiará en la instalación del Sistema de Gestión de Torneos de Fútbol.
                    </p>
                    
                    <div class="bg-blue-50 border border-blue-200 rounded p-4 mb-4">
                        <h3 class="font-bold mb-2">Requisitos previos:</h3>
                        <ul class="list-disc list-inside space-y-1 text-sm text-gray-700">
                            <li>PHP 7.4 o superior</li>
                            <li>MySQL 5.7 o superior</li>
                            <li>Apache con mod_rewrite habilitado</li>
                            <li>Extensiones: PDO, pdo_mysql, mbstring, json, session</li>
                        </ul>
                    </div>
                    
                    <a href="?step=2" class="block w-full text-center bg-blue-600 text-white py-3 rounded-lg hover:bg-blue-700 font-bold">
                        Continuar con la instalación
                    </a>
                </div>
                
                <?php elseif ($step == 2): ?>
                
                <!-- Paso 2: Configuración de Base de Datos -->
                <div class="mb-8">
                    <h2 class="text-2xl font-bold mb-4">Configuración de Base de Datos</h2>
                    
                    <?php if ($_SERVER['REQUEST_METHOD'] === 'POST'): ?>
                        <?php
                        $host = $_POST['db_host'] ?? 'localhost';
                        $name = $_POST['db_name'] ?? 'futbol_torneos';
                        $user = $_POST['db_user'] ?? 'root';
                        $pass = $_POST['db_pass'] ?? '';
                        
                        try {
                            $dsn = "mysql:host=$host;charset=utf8mb4";
                            $pdo = new PDO($dsn, $user, $pass);
                            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                            
                            // Crear base de datos si no existe
                            $pdo->exec("CREATE DATABASE IF NOT EXISTS `$name` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
                            
                            // Leer y ejecutar el schema
                            $schema = file_get_contents(__DIR__ . '/database/schema.sql');
                            $schema = str_replace('CREATE DATABASE futbol_torneos', '', $schema);
                            $schema = str_replace('USE futbol_torneos', '', $schema);
                            
                            $pdo->exec("USE `$name`");
                            
                            // Ejecutar el schema
                            $pdo->exec($schema);
                            
                            // Ejecutar los datos de ejemplo
                            $sampleData = file_get_contents(__DIR__ . '/database/sample_data.sql');
                            $sampleData = str_replace('USE futbol_torneos;', '', $sampleData);
                            $pdo->exec($sampleData);
                            
                            // Actualizar archivo de configuración con escapado seguro
                            $configFile = __DIR__ . '/config/config.php';
                            $configContent = file_get_contents($configFile);
                            // Escapar valores para evitar inyección de código
                            $host = addslashes($host);
                            $name = addslashes($name);
                            $user = addslashes($user);
                            $pass = addslashes($pass);
                            $configContent = preg_replace("/define\('DB_HOST', '.*?'\);/", "define('DB_HOST', '$host');", $configContent);
                            $configContent = preg_replace("/define\('DB_NAME', '.*?'\);/", "define('DB_NAME', '$name');", $configContent);
                            $configContent = preg_replace("/define\('DB_USER', '.*?'\);/", "define('DB_USER', '$user');", $configContent);
                            $configContent = preg_replace("/define\('DB_PASS', '$pass');/", "define('DB_PASS', '$pass');", $configContent);
                            file_put_contents($configFile, $configContent);
                            
                            echo '<div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">';
                            echo '<p class="font-bold">✓ Instalación exitosa</p>';
                            echo '<p>La base de datos ha sido creada e inicializada correctamente.</p>';
                            echo '</div>';
                            
                            echo '<a href="' . dirname($_SERVER['PHP_SELF']) . '" class="block w-full text-center bg-green-600 text-white py-3 rounded-lg hover:bg-green-700 font-bold">';
                            echo 'Ir al Sistema';
                            echo '</a>';
                            
                        } catch (PDOException $e) {
                            echo '<div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">';
                            echo '<p class="font-bold">Error de conexión</p>';
                            echo '<p>' . htmlspecialchars($e->getMessage()) . '</p>';
                            echo '</div>';
                            
                            echo '<a href="?step=2" class="block w-full text-center bg-blue-600 text-white py-3 rounded-lg hover:bg-blue-700 font-bold">';
                            echo 'Intentar de nuevo';
                            echo '</a>';
                        }
                        ?>
                    <?php else: ?>
                    
                    <form method="POST" class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Host de la Base de Datos</label>
                            <input type="text" name="db_host" value="localhost" required
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Nombre de la Base de Datos</label>
                            <input type="text" name="db_name" value="futbol_torneos" required
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Usuario de MySQL</label>
                            <input type="text" name="db_user" value="root" required
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Contraseña de MySQL</label>
                            <input type="password" name="db_pass"
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        
                        <div class="flex space-x-4">
                            <a href="?step=1" class="flex-1 text-center border border-gray-300 py-3 rounded-lg hover:bg-gray-50 font-bold">
                                Volver
                            </a>
                            <button type="submit" class="flex-1 bg-blue-600 text-white py-3 rounded-lg hover:bg-blue-700 font-bold">
                                Instalar Base de Datos
                            </button>
                        </div>
                    </form>
                    
                    <?php endif; ?>
                </div>
                
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>
</html>
