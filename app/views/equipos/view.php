<!-- Flash Message -->
<?php if ($flash): ?>
<div class="mb-6 bg-<?= $flash['type'] === 'success' ? 'green' : 'red' ?>-100 border border-<?= $flash['type'] === 'success' ? 'green' : 'red' ?>-400 text-<?= $flash['type'] === 'success' ? 'green' : 'red' ?>-700 px-4 py-3 rounded relative">
    <span class="block sm:inline"><?= $flash['message'] ?></span>
</div>
<?php endif; ?>

<!-- Page Header -->
<div class="mb-8 flex justify-between items-center">
    <div>
        <h1 class="text-3xl font-bold text-gray-800"><?= htmlspecialchars($equipo['nombre']) ?></h1>
        <p class="text-gray-600">Información del equipo</p>
    </div>
    <a href="<?= BASE_URL ?>/equipos" class="px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50">
        <i class="fas fa-arrow-left mr-2"></i>Volver
    </a>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    
    <!-- Información del Equipo -->
    <div class="lg:col-span-2 space-y-6">
        
        <!-- Info -->
        <div class="bg-white rounded-lg shadow-lg p-6">
            <div class="flex items-start mb-6">
                <?php if ($equipo['logo']): ?>
                <img src="<?= BASE_URL ?>/<?= $equipo['logo'] ?>" alt="Logo" class="w-24 h-24 rounded-full mr-6">
                <?php else: ?>
                <div class="w-24 h-24 rounded-full bg-primary flex items-center justify-center text-white text-4xl font-bold mr-6">
                    <?= strtoupper(substr($equipo['nombre'], 0, 1)) ?>
                </div>
                <?php endif; ?>
                
                <div class="flex-1">
                    <h2 class="text-2xl font-bold text-gray-800 mb-2"><?= htmlspecialchars($equipo['nombre']) ?></h2>
                    
                    <div class="flex space-x-2 mb-4">
                        <?php if ($equipo['color_primario']): ?>
                        <div class="w-12 h-12 rounded border border-gray-300" style="background-color: <?= $equipo['color_primario'] ?>"></div>
                        <?php endif; ?>
                        <?php if ($equipo['color_secundario']): ?>
                        <div class="w-12 h-12 rounded border border-gray-300" style="background-color: <?= $equipo['color_secundario'] ?>"></div>
                        <?php endif; ?>
                    </div>
                    
                    <div class="space-y-1 text-sm text-gray-600">
                        <p><i class="fas fa-user mr-2"></i>Delegado: <?= htmlspecialchars($equipo['delegado_nombre']) ?></p>
                        <?php if ($equipo['delegado_email']): ?>
                        <p><i class="fas fa-envelope mr-2"></i><?= htmlspecialchars($equipo['delegado_email']) ?></p>
                        <?php endif; ?>
                        <?php if ($equipo['telefono']): ?>
                        <p><i class="fas fa-phone mr-2"></i><?= htmlspecialchars($equipo['telefono']) ?></p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Plantilla -->
        <div class="bg-white rounded-lg shadow-lg p-6">
            <h2 class="text-xl font-bold mb-4">Plantilla de Jugadores</h2>
            
            <?php if (!empty($plantilla)): ?>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <?php foreach ($plantilla as $jugador): ?>
                <div class="border rounded-lg p-4 hover:bg-gray-50">
                    <div class="flex items-center">
                        <div class="w-12 h-12 rounded-full bg-primary flex items-center justify-center text-white font-bold text-lg mr-4">
                            <?= $jugador['numero_camisa'] ?? '?' ?>
                        </div>
                        <div class="flex-1">
                            <p class="font-bold text-gray-800"><?= htmlspecialchars($jugador['nombre'] . ' ' . $jugador['apellidos']) ?></p>
                            <p class="text-sm text-gray-600"><?= htmlspecialchars($jugador['posicion'] ?? 'Sin posición') ?></p>
                            <?php if ($jugador['plantilla_status'] !== 'ACTIVO'): ?>
                            <span class="text-xs px-2 py-1 bg-yellow-100 text-yellow-800 rounded"><?= $jugador['plantilla_status'] ?></span>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
            <?php else: ?>
            <p class="text-gray-500 text-center py-8">No hay jugadores registrados en este equipo</p>
            <?php endif; ?>
        </div>
    </div>
    
    <!-- Sidebar -->
    <div class="lg:col-span-1 space-y-6">
        
        <!-- Estadísticas -->
        <div class="bg-white rounded-lg shadow-lg p-6">
            <h2 class="text-xl font-bold mb-4">Estadísticas</h2>
            
            <div class="space-y-4">
                <div>
                    <p class="text-sm text-gray-600">Jugadores</p>
                    <p class="text-2xl font-bold text-primary"><?= count($plantilla) ?></p>
                </div>
                
                <div>
                    <p class="text-sm text-gray-600">Jugadores Activos</p>
                    <p class="text-2xl font-bold text-green-600">
                        <?= count(array_filter($plantilla, fn($j) => $j['plantilla_status'] === 'ACTIVO')) ?>
                    </p>
                </div>
            </div>
        </div>
        
        <!-- Acciones -->
        <?php if (in_array($user['rol_nombre'], ['SUPERADMIN', 'DELEGADO'])): ?>
        <div class="bg-white rounded-lg shadow-lg p-6">
            <h2 class="text-xl font-bold mb-4">Acciones</h2>
            
            <div class="space-y-2">
                <a href="<?= BASE_URL ?>/equipos/agregarJugador/<?= $equipo['id'] ?>" class="block w-full text-center bg-primary text-white py-2 rounded hover:bg-secondary">
                    <i class="fas fa-user-plus mr-2"></i>Agregar Jugador
                </a>
                <a href="<?= BASE_URL ?>/equipos/editar/<?= $equipo['id'] ?>" class="block w-full text-center bg-green-500 text-white py-2 rounded hover:bg-green-600">
                    <i class="fas fa-edit mr-2"></i>Editar Equipo
                </a>
            </div>
        </div>
        <?php endif; ?>
    </div>
</div>

</main>
</div>
