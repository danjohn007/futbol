<!-- Flash Message -->
<?php if ($flash): ?>
<div class="mb-6 bg-<?= $flash['type'] === 'success' ? 'green' : 'red' ?>-100 border border-<?= $flash['type'] === 'success' ? 'green' : 'red' ?>-400 text-<?= $flash['type'] === 'success' ? 'green' : 'red' ?>-700 px-4 py-3 rounded relative">
    <span class="block sm:inline"><?= $flash['message'] ?></span>
</div>
<?php endif; ?>

<!-- Page Header -->
<div class="mb-8">
    <h1 class="text-3xl font-bold text-gray-800">Equipos</h1>
    <p class="text-gray-600">Gestión de equipos de fútbol</p>
</div>

<!-- Equipos Grid -->
<?php if (!empty($equipos)): ?>
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    <?php foreach ($equipos as $equipo): ?>
    <div class="bg-white rounded-lg shadow-lg p-6 hover:shadow-xl transition">
        <div class="flex items-start mb-4">
            <?php if ($equipo['logo']): ?>
            <img src="<?= BASE_URL ?>/<?= $equipo['logo'] ?>" alt="Logo" class="w-16 h-16 rounded-full mr-4">
            <?php else: ?>
            <div class="w-16 h-16 rounded-full bg-primary flex items-center justify-center text-white text-2xl font-bold mr-4">
                <?= strtoupper(substr($equipo['nombre'], 0, 1)) ?>
            </div>
            <?php endif; ?>
            
            <div class="flex-1">
                <h3 class="text-xl font-bold text-gray-800"><?= htmlspecialchars($equipo['nombre']) ?></h3>
                <p class="text-sm text-gray-600">
                    <i class="fas fa-user mr-1"></i>
                    <?= htmlspecialchars($equipo['delegado_nombre'] ?? 'Sin delegado') ?>
                </p>
            </div>
        </div>
        
        <div class="flex space-x-2 mb-4">
            <?php if ($equipo['color_primario']): ?>
            <div class="w-8 h-8 rounded" style="background-color: <?= $equipo['color_primario'] ?>"></div>
            <?php endif; ?>
            <?php if ($equipo['color_secundario']): ?>
            <div class="w-8 h-8 rounded" style="background-color: <?= $equipo['color_secundario'] ?>"></div>
            <?php endif; ?>
        </div>
        
        <a href="<?= BASE_URL ?>/equipos/view/<?= $equipo['id'] ?>" class="block text-center bg-primary text-white py-2 rounded hover:bg-secondary transition">
            Ver Equipo
        </a>
    </div>
    <?php endforeach; ?>
</div>
<?php else: ?>
<div class="bg-white rounded-lg shadow p-8 text-center">
    <i class="fas fa-users text-4xl text-gray-400 mb-4"></i>
    <p class="text-gray-600">No hay equipos registrados</p>
</div>
<?php endif; ?>

</main>
</div>
