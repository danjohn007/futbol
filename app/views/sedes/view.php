<!-- Page Header -->
<div class="mb-8 flex justify-between items-center">
    <div>
        <h1 class="text-3xl font-bold text-gray-800"><?= htmlspecialchars($sede['nombre']) ?></h1>
        <p class="text-gray-600">Detalles de la sede</p>
    </div>
    <div class="flex space-x-2">
        <a href="<?= BASE_URL ?>/sedes" class="px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50">
            <i class="fas fa-arrow-left mr-2"></i>Volver
        </a>
        <?php if ($user['rol_nombre'] === 'SUPERADMIN'): ?>
        <a href="<?= BASE_URL ?>/sedes/edit/<?= $sede['id'] ?>" class="px-4 py-2 bg-yellow-500 text-white rounded-lg hover:bg-yellow-600">
            <i class="fas fa-edit mr-2"></i>Editar
        </a>
        <?php endif; ?>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Información de la Sede -->
    <div class="lg:col-span-2">
        <div class="bg-white rounded-lg shadow-lg p-6 mb-6">
            <h2 class="text-xl font-bold mb-4">Información General</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <p class="text-sm text-gray-600">Dirección</p>
                    <p class="font-semibold"><?= htmlspecialchars($sede['direccion']) ?></p>
                </div>
                
                <div>
                    <p class="text-sm text-gray-600">Ciudad / Estado</p>
                    <p class="font-semibold"><?= htmlspecialchars($sede['ciudad']) ?>, <?= htmlspecialchars($sede['estado']) ?></p>
                </div>
                
                <?php if ($sede['codigo_postal']): ?>
                <div>
                    <p class="text-sm text-gray-600">Código Postal</p>
                    <p class="font-semibold"><?= htmlspecialchars($sede['codigo_postal']) ?></p>
                </div>
                <?php endif; ?>
                
                <?php if ($sede['telefono']): ?>
                <div>
                    <p class="text-sm text-gray-600">Teléfono</p>
                    <p class="font-semibold"><?= htmlspecialchars($sede['telefono']) ?></p>
                </div>
                <?php endif; ?>
                
                <?php if ($sede['email']): ?>
                <div>
                    <p class="text-sm text-gray-600">Email</p>
                    <p class="font-semibold"><?= htmlspecialchars($sede['email']) ?></p>
                </div>
                <?php endif; ?>
                
                <div>
                    <p class="text-sm text-gray-600">Estado</p>
                    <p class="font-semibold">
                        <span class="px-2 py-1 bg-<?= $sede['activo'] ? 'green' : 'gray' ?>-100 text-<?= $sede['activo'] ? 'green' : 'gray' ?>-800 text-xs rounded">
                            <?= $sede['activo'] ? 'Activa' : 'Inactiva' ?>
                        </span>
                    </p>
                </div>
            </div>
        </div>
        
        <!-- Canchas -->
        <div class="bg-white rounded-lg shadow-lg p-6">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-bold">Canchas</h2>
                <?php if (in_array($user['rol_nombre'], ['SUPERADMIN', 'ADMIN_SEDE'])): ?>
                <a href="<?= BASE_URL ?>/canchas/create/<?= $sede['id'] ?>" class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600 text-sm">
                    <i class="fas fa-plus mr-1"></i>Agregar Cancha
                </a>
                <?php endif; ?>
            </div>
            
            <?php if (!empty($sede['canchas'])): ?>
            <div class="space-y-4">
                <?php foreach ($sede['canchas'] as $cancha): ?>
                <div class="border rounded-lg p-4 hover:bg-gray-50">
                    <div class="flex justify-between items-start">
                        <div>
                            <h3 class="font-bold text-gray-800"><?= htmlspecialchars($cancha['nombre']) ?></h3>
                            <div class="text-sm text-gray-600 mt-1">
                                <span class="mr-4"><i class="fas fa-futbol mr-1"></i><?= htmlspecialchars($cancha['tipo']) ?></span>
                                <span class="mr-4"><i class="fas fa-layer-group mr-1"></i><?= htmlspecialchars($cancha['superficie']) ?></span>
                                <?php if ($cancha['capacidad']): ?>
                                <span><i class="fas fa-users mr-1"></i><?= $cancha['capacidad'] ?> personas</span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <span class="px-2 py-1 bg-<?= $cancha['activo'] ? 'green' : 'gray' ?>-100 text-<?= $cancha['activo'] ? 'green' : 'gray' ?>-800 text-xs rounded">
                            <?= $cancha['activo'] ? 'Activa' : 'Inactiva' ?>
                        </span>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
            <?php else: ?>
            <p class="text-gray-500 text-center py-4">No hay canchas registradas en esta sede</p>
            <?php endif; ?>
        </div>
    </div>
    
    <!-- Mapa -->
    <div class="lg:col-span-1">
        <div class="bg-white rounded-lg shadow-lg p-6">
            <h2 class="text-xl font-bold mb-4">Ubicación</h2>
            <?php if ($sede['latitud'] && $sede['longitud']): ?>
            <div class="aspect-w-16 aspect-h-9 bg-gray-200 rounded">
                <?php
                // Usar API key de configuración si está disponible
                $mapsApiKey = $config['google_maps_api_key'] ?? '';
                if ($mapsApiKey):
                ?>
                <iframe
                    width="100%"
                    height="300"
                    frameborder="0"
                    style="border:0"
                    referrerpolicy="no-referrer-when-downgrade"
                    src="https://www.google.com/maps/embed/v1/place?key=<?= htmlspecialchars($mapsApiKey) ?>&q=<?= $sede['latitud'] ?>,<?= $sede['longitud'] ?>"
                    allowfullscreen>
                </iframe>
                <?php else: ?>
                <div class="flex items-center justify-center h-full text-gray-500">
                    <p class="text-center">
                        <i class="fas fa-map-marked-alt text-4xl mb-2"></i><br>
                        Configura la API de Google Maps en Configuración
                    </p>
                </div>
                <?php endif; ?>
            </div>
            <p class="text-xs text-gray-500 mt-2">
                Coordenadas: <?= $sede['latitud'] ?>, <?= $sede['longitud'] ?>
            </p>
            <?php else: ?>
            <p class="text-gray-500 text-center py-8">No hay coordenadas disponibles</p>
            <?php endif; ?>
        </div>
    </div>
</div>

</main>
</div>
