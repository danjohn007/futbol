<div class="flex min-h-screen">
    <!-- Sidebar -->
    <aside class="w-64 bg-white shadow-lg">
        <div class="p-4">
            <div class="mb-6 pb-4 border-b">
                <p class="text-sm text-gray-600">Bienvenido</p>
                <p class="font-bold"><?= $user['nombre'] ?></p>
                <p class="text-xs text-gray-500"><?= $user['rol_nombre'] ?></p>
            </div>
            
            <nav class="space-y-2">
                <a href="<?= BASE_URL ?>/dashboard" class="flex items-center px-4 py-2 text-gray-700 hover:bg-primary hover:text-white rounded">
                    <i class="fas fa-dashboard mr-3"></i> Dashboard
                </a>
                
                <?php if (in_array($user['rol_nombre'], ['SUPERADMIN', 'ORGANIZADOR'])): ?>
                <a href="<?= BASE_URL ?>/torneos" class="flex items-center px-4 py-2 text-gray-700 hover:bg-primary hover:text-white rounded">
                    <i class="fas fa-trophy mr-3"></i> Torneos
                </a>
                <?php endif; ?>
                
                <?php if (in_array($user['rol_nombre'], ['SUPERADMIN', 'ADMIN_SEDE'])): ?>
                <a href="<?= BASE_URL ?>/sedes" class="flex items-center px-4 py-2 text-gray-700 hover:bg-primary hover:text-white rounded">
                    <i class="fas fa-map-marker-alt mr-3"></i> Sedes
                </a>
                <?php endif; ?>
                
                <?php if (in_array($user['rol_nombre'], ['SUPERADMIN', 'DELEGADO'])): ?>
                <a href="<?= BASE_URL ?>/equipos" class="flex items-center px-4 py-2 text-gray-700 hover:bg-primary hover:text-white rounded">
                    <i class="fas fa-users mr-3"></i> Equipos
                </a>
                <?php endif; ?>
                
                <a href="<?= BASE_URL ?>/partidos" class="flex items-center px-4 py-2 text-gray-700 hover:bg-primary hover:text-white rounded">
                    <i class="fas fa-calendar-alt mr-3"></i> Partidos
                </a>
                
                <?php if ($user['rol_nombre'] === 'SUPERADMIN'): ?>
                <a href="<?= BASE_URL ?>/usuarios" class="flex items-center px-4 py-2 text-gray-700 hover:bg-primary hover:text-white rounded">
                    <i class="fas fa-user-cog mr-3"></i> Usuarios
                </a>
                
                <a href="<?= BASE_URL ?>/settings" class="flex items-center px-4 py-2 text-gray-700 hover:bg-primary hover:text-white rounded">
                    <i class="fas fa-cog mr-3"></i> Configuración
                </a>
                <?php endif; ?>
            </nav>
        </div>
    </aside>
    
    <!-- Main Content -->
    <main class="flex-1 p-8">
