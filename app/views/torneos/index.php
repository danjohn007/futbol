<!-- Flash Message -->
<?php if ($flash): ?>
<div class="mb-6 bg-<?= $flash['type'] === 'success' ? 'green' : 'red' ?>-100 border border-<?= $flash['type'] === 'success' ? 'green' : 'red' ?>-400 text-<?= $flash['type'] === 'success' ? 'green' : 'red' ?>-700 px-4 py-3 rounded relative">
    <span class="block sm:inline"><?= $flash['message'] ?></span>
</div>
<?php endif; ?>

<!-- Page Header -->
<div class="mb-8 flex justify-between items-center">
    <div>
        <h1 class="text-3xl font-bold text-gray-800">Torneos</h1>
        <p class="text-gray-600">Gestión de torneos de fútbol</p>
    </div>
    <?php if (in_array($user['rol_nombre'], ['SUPERADMIN', 'ORGANIZADOR'])): ?>
    <a href="<?= BASE_URL ?>/torneos/create" class="bg-primary text-white px-6 py-2 rounded-lg hover:bg-secondary transition">
        <i class="fas fa-plus mr-2"></i>Nuevo Torneo
    </a>
    <?php endif; ?>
</div>

<!-- Torneos Grid -->
<?php if (!empty($torneos)): ?>
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    <?php foreach ($torneos as $torneo): ?>
    <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition">
        <div class="p-6">
            <div class="flex justify-between items-start mb-4">
                <h3 class="text-xl font-bold text-gray-800"><?= htmlspecialchars($torneo['nombre']) ?></h3>
                <span class="px-3 py-1 bg-<?= $torneo['status'] === 'ACTIVO' ? 'green' : ($torneo['status'] === 'INSCRIPCIONES' ? 'blue' : 'gray') ?>-100 text-<?= $torneo['status'] === 'ACTIVO' ? 'green' : ($torneo['status'] === 'INSCRIPCIONES' ? 'blue' : 'gray') ?>-800 text-xs font-semibold rounded-full">
                    <?= $torneo['status'] ?>
                </span>
            </div>
            
            <div class="space-y-2 text-sm text-gray-600 mb-4">
                <p><i class="fas fa-trophy mr-2 text-primary"></i><?= htmlspecialchars($torneo['tipo']) ?></p>
                <?php if (!empty($torneo['categoria_nombre'])): ?>
                <p><i class="fas fa-tag mr-2 text-primary"></i><?= htmlspecialchars($torneo['categoria_nombre']) ?></p>
                <?php endif; ?>
                <?php if (!empty($torneo['sede_nombre'])): ?>
                <p><i class="fas fa-map-marker-alt mr-2 text-primary"></i><?= htmlspecialchars($torneo['sede_nombre']) ?></p>
                <?php endif; ?>
                <p><i class="fas fa-calendar mr-2 text-primary"></i><?= date('d/m/Y', strtotime($torneo['fecha_inicio'])) ?></p>
                <?php if (!empty($torneo['organizador_nombre'])): ?>
                <p><i class="fas fa-user mr-2 text-primary"></i><?= htmlspecialchars($torneo['organizador_nombre']) ?></p>
                <?php endif; ?>
            </div>
            
            <a href="<?= BASE_URL ?>/torneos/detalle/<?= $torneo['id'] ?>" class="block text-center bg-primary text-white py-2 rounded hover:bg-secondary transition">
                Ver Detalles
            </a>
        </div>
    </div>
    <?php endforeach; ?>
</div>
<?php else: ?>
<div class="bg-white rounded-lg shadow p-8 text-center">
    <i class="fas fa-trophy text-4xl text-gray-400 mb-4"></i>
    <p class="text-gray-600 mb-4">No hay torneos registrados</p>
    <?php if (in_array($user['rol_nombre'], ['SUPERADMIN', 'ORGANIZADOR'])): ?>
    <a href="<?= BASE_URL ?>/torneos/create" class="bg-primary text-white px-6 py-2 rounded-lg hover:bg-secondary inline-block">
        <i class="fas fa-plus mr-2"></i>Crear Primer Torneo
    </a>
    <?php endif; ?>
</div>
<?php endif; ?>

</main>
</div>
