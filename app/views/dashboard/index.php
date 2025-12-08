<!-- Flash Message -->
<?php if ($flash): ?>
<div class="mb-6 bg-<?= $flash['type'] === 'success' ? 'green' : 'red' ?>-100 border border-<?= $flash['type'] === 'success' ? 'green' : 'red' ?>-400 text-<?= $flash['type'] === 'success' ? 'green' : 'red' ?>-700 px-4 py-3 rounded relative" role="alert">
    <span class="block sm:inline"><?= $flash['message'] ?></span>
</div>
<?php endif; ?>

<!-- Page Header -->
<div class="mb-8">
    <h1 class="text-3xl font-bold text-gray-800">Dashboard</h1>
    <p class="text-gray-600">Bienvenido, <?= $user['nombre'] ?> (<?= $user['rol_nombre'] ?>)</p>
</div>

<!-- Stats Cards -->
<?php if (!empty($stats)): ?>
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <?php if (isset($stats['torneos'])): ?>
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center">
            <div class="p-3 rounded-full bg-blue-500 bg-opacity-20 text-blue-500">
                <i class="fas fa-trophy text-2xl"></i>
            </div>
            <div class="ml-4">
                <p class="text-gray-600 text-sm">Torneos</p>
                <p class="text-2xl font-bold"><?= $stats['torneos'] ?></p>
            </div>
        </div>
    </div>
    <?php endif; ?>
    
    <?php if (isset($stats['equipos'])): ?>
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center">
            <div class="p-3 rounded-full bg-green-500 bg-opacity-20 text-green-500">
                <i class="fas fa-users text-2xl"></i>
            </div>
            <div class="ml-4">
                <p class="text-gray-600 text-sm">Equipos</p>
                <p class="text-2xl font-bold"><?= $stats['equipos'] ?></p>
            </div>
        </div>
    </div>
    <?php endif; ?>
    
    <?php if (isset($stats['sedes'])): ?>
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center">
            <div class="p-3 rounded-full bg-purple-500 bg-opacity-20 text-purple-500">
                <i class="fas fa-map-marker-alt text-2xl"></i>
            </div>
            <div class="ml-4">
                <p class="text-gray-600 text-sm">Sedes</p>
                <p class="text-2xl font-bold"><?= $stats['sedes'] ?></p>
            </div>
        </div>
    </div>
    <?php endif; ?>
    
    <?php if (isset($stats['usuarios'])): ?>
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center">
            <div class="p-3 rounded-full bg-yellow-500 bg-opacity-20 text-yellow-500">
                <i class="fas fa-user-cog text-2xl"></i>
            </div>
            <div class="ml-4">
                <p class="text-gray-600 text-sm">Usuarios</p>
                <p class="text-2xl font-bold"><?= $stats['usuarios'] ?></p>
            </div>
        </div>
    </div>
    <?php endif; ?>
</div>
<?php endif; ?>

<!-- Quick Actions -->
<div class="bg-white rounded-lg shadow p-6 mb-8">
    <h2 class="text-xl font-bold mb-4">Acciones Rápidas</h2>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <?php if (in_array($user['rol_nombre'], ['SUPERADMIN', 'ORGANIZADOR'])): ?>
        <a href="<?= BASE_URL ?>/torneos/create" class="flex items-center p-4 border-2 border-primary rounded-lg hover:bg-primary hover:text-white transition">
            <i class="fas fa-plus-circle text-2xl mr-3"></i>
            <span class="font-semibold">Crear Torneo</span>
        </a>
        <?php endif; ?>
        
        <?php if (in_array($user['rol_nombre'], ['SUPERADMIN', 'DELEGADO'])): ?>
        <a href="<?= BASE_URL ?>/equipos/create" class="flex items-center p-4 border-2 border-green-500 rounded-lg hover:bg-green-500 hover:text-white transition">
            <i class="fas fa-plus-circle text-2xl mr-3"></i>
            <span class="font-semibold">Crear Equipo</span>
        </a>
        <?php endif; ?>
        
        <a href="<?= BASE_URL ?>/partidos" class="flex items-center p-4 border-2 border-purple-500 rounded-lg hover:bg-purple-500 hover:text-white transition">
            <i class="fas fa-calendar-alt text-2xl mr-3"></i>
            <span class="font-semibold">Ver Calendario</span>
        </a>
    </div>
</div>

<!-- Recent Activity or Notifications -->
<div class="bg-white rounded-lg shadow p-6">
    <h2 class="text-xl font-bold mb-4">Actividad Reciente</h2>
    <div class="space-y-4">
        <div class="flex items-start p-3 bg-gray-50 rounded">
            <i class="fas fa-info-circle text-blue-500 mt-1 mr-3"></i>
            <div>
                <p class="font-semibold">Sistema Iniciado</p>
                <p class="text-sm text-gray-600">El sistema de gestión de torneos está listo para usar</p>
                <p class="text-xs text-gray-500 mt-1"><?= date('d/m/Y H:i') ?></p>
            </div>
        </div>
    </div>
</div>

</main>
</div>
