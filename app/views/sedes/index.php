<!-- Flash Message -->
<?php if ($flash): ?>
<div class="mb-6 bg-<?= $flash['type'] === 'success' ? 'green' : 'red' ?>-100 border border-<?= $flash['type'] === 'success' ? 'green' : 'red' ?>-400 text-<?= $flash['type'] === 'success' ? 'green' : 'red' ?>-700 px-4 py-3 rounded relative" role="alert">
    <span class="block sm:inline"><?= $flash['message'] ?></span>
</div>
<?php endif; ?>

<!-- Page Header -->
<div class="mb-8 flex justify-between items-center">
    <div>
        <h1 class="text-3xl font-bold text-gray-800">Sedes</h1>
        <p class="text-gray-600">Gestión de sedes deportivas</p>
    </div>
    <?php if ($user['rol_nombre'] === 'SUPERADMIN'): ?>
    <a href="<?= BASE_URL ?>/sedes/create" class="bg-primary text-white px-6 py-2 rounded-lg hover:bg-secondary transition">
        <i class="fas fa-plus mr-2"></i>Nueva Sede
    </a>
    <?php endif; ?>
</div>

<!-- Sedes List -->
<?php if (!empty($sedes)): ?>
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    <?php foreach ($sedes as $sede): ?>
    <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition">
        <div class="p-6">
            <div class="flex justify-between items-start mb-4">
                <h3 class="text-xl font-bold text-gray-800"><?= htmlspecialchars($sede['nombre']) ?></h3>
                <span class="px-2 py-1 bg-<?= $sede['activo'] ? 'green' : 'gray' ?>-100 text-<?= $sede['activo'] ? 'green' : 'gray' ?>-800 text-xs font-semibold rounded">
                    <?= $sede['activo'] ? 'Activa' : 'Inactiva' ?>
                </span>
            </div>
            
            <div class="space-y-2 text-sm text-gray-600 mb-4">
                <p><i class="fas fa-map-marker-alt mr-2 text-primary"></i><?= htmlspecialchars($sede['ciudad']) ?>, <?= htmlspecialchars($sede['estado']) ?></p>
                <?php if ($sede['telefono']): ?>
                <p><i class="fas fa-phone mr-2 text-primary"></i><?= htmlspecialchars($sede['telefono']) ?></p>
                <?php endif; ?>
                <?php if ($sede['email']): ?>
                <p><i class="fas fa-envelope mr-2 text-primary"></i><?= htmlspecialchars($sede['email']) ?></p>
                <?php endif; ?>
            </div>
            
            <div class="flex space-x-2">
                <a href="<?= BASE_URL ?>/sedes/detalle/<?= $sede['id'] ?>" 
                   class="flex-1 text-center bg-blue-500 text-white py-2 rounded hover:bg-blue-600 transition">
                    <i class="fas fa-eye mr-1"></i>Ver
                </a>
                <?php if ($user['rol_nombre'] === 'SUPERADMIN'): ?>
                <a href="<?= BASE_URL ?>/sedes/edit/<?= $sede['id'] ?>" 
                   class="flex-1 text-center bg-yellow-500 text-white py-2 rounded hover:bg-yellow-600 transition">
                    <i class="fas fa-edit mr-1"></i>Editar
                </a>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
</div>
<?php else: ?>
<div class="bg-white rounded-lg shadow p-8 text-center">
    <i class="fas fa-map-marker-alt text-4xl text-gray-400 mb-4"></i>
    <p class="text-gray-600 mb-4">No hay sedes registradas</p>
    <?php if ($user['rol_nombre'] === 'SUPERADMIN'): ?>
    <a href="<?= BASE_URL ?>/sedes/create" class="bg-primary text-white px-6 py-2 rounded-lg hover:bg-secondary inline-block">
        <i class="fas fa-plus mr-2"></i>Crear Primera Sede
    </a>
    <?php endif; ?>
</div>
<?php endif; ?>

</main>
</div>
