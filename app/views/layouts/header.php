<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'FutbolManager' ?> - <?= $config['site_name'] ?? 'FutbolManager' ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '<?= $config['primary_color'] ?? '#3B82F6' ?>',
                        secondary: '<?= $config['secondary_color'] ?? '#1E40AF' ?>',
                    }
                }
            }
        }
    </script>
    <style>
        .bg-primary { background-color: <?= $config['primary_color'] ?? '#3B82F6' ?>; }
        .text-primary { color: <?= $config['primary_color'] ?? '#3B82F6' ?>; }
        .bg-secondary { background-color: <?= $config['secondary_color'] ?? '#1E40AF' ?>; }
        .text-secondary { color: <?= $config['secondary_color'] ?? '#1E40AF' ?>; }
    </style>
</head>
<body class="bg-gray-50">
    <!-- Navbar -->
    <nav class="bg-primary shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <a href="<?= BASE_URL ?>" class="text-white text-2xl font-bold">
                        <i class="fas fa-futbol mr-2"></i>
                        <?= $config['site_name'] ?? 'FutbolManager' ?>
                    </a>
                </div>
                <div class="flex items-center space-x-4">
                    <?php if (isset($_SESSION['user_id'])): ?>
                        <a href="<?= BASE_URL ?>/dashboard" class="text-white hover:text-gray-200">
                            <i class="fas fa-dashboard mr-1"></i> Dashboard
                        </a>
                        <span class="text-white">|</span>
                        <span class="text-white"><?= $_SESSION['user_name'] ?></span>
                        <a href="<?= BASE_URL ?>/auth/logout" class="text-white hover:text-gray-200">
                            <i class="fas fa-sign-out-alt mr-1"></i> Salir
                        </a>
                    <?php else: ?>
                        <a href="<?= BASE_URL ?>/auth/login" class="text-white hover:text-gray-200">
                            <i class="fas fa-sign-in-alt mr-1"></i> Iniciar Sesión
                        </a>
                        <a href="<?= BASE_URL ?>/auth/register" class="bg-white text-primary px-4 py-2 rounded hover:bg-gray-100">
                            Registrarse
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </nav>
