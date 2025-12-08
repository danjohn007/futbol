<!-- Page Header -->
<div class="mb-8">
    <h1 class="text-3xl font-bold text-gray-800">Detalles del Partido</h1>
    <p class="text-gray-600"><?= htmlspecialchars($partido['torneo_nombre']) ?></p>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    
    <!-- Main Content -->
    <div class="lg:col-span-2 space-y-6">
        
        <!-- Marcador -->
        <div class="bg-white rounded-lg shadow-lg p-8">
            <div class="flex items-center justify-between mb-6">
                <span class="text-xs font-semibold px-3 py-1 bg-<?= $partido['status'] === 'FINALIZADO' ? 'green' : ($partido['status'] === 'EN_CURSO' ? 'yellow' : 'blue') ?>-100 text-<?= $partido['status'] === 'FINALIZADO' ? 'green' : ($partido['status'] === 'EN_CURSO' ? 'yellow' : 'blue') ?>-800 rounded-full">
                    <?= $partido['status'] ?>
                </span>
                <span class="text-sm text-gray-600">
                    <i class="fas fa-calendar mr-1"></i>
                    <?= date('d/m/Y H:i', strtotime($partido['fecha_hora'])) ?>
                </span>
            </div>
            
            <div class="flex items-center justify-between">
                <!-- Local -->
                <div class="text-center flex-1">
                    <?php if ($partido['logo_local']): ?>
                    <img src="<?= BASE_URL ?>/<?= $partido['logo_local'] ?>" alt="Logo" class="w-24 h-24 rounded-full mx-auto mb-4">
                    <?php else: ?>
                    <div class="w-24 h-24 rounded-full bg-primary flex items-center justify-center text-white text-4xl font-bold mx-auto mb-4">
                        <?= strtoupper(substr($partido['equipo_local'], 0, 1)) ?>
                    </div>
                    <?php endif; ?>
                    <p class="font-bold text-xl text-gray-800"><?= htmlspecialchars($partido['equipo_local']) ?></p>
                    <?php if ($partido['status'] !== 'PROGRAMADO'): ?>
                    <p class="text-5xl font-bold text-primary mt-4"><?= $partido['goles_local'] ?></p>
                    <?php endif; ?>
                </div>
                
                <!-- VS -->
                <div class="mx-8">
                    <p class="text-4xl font-bold text-gray-400">
                        <?= $partido['status'] !== 'PROGRAMADO' ? '-' : 'VS' ?>
                    </p>
                </div>
                
                <!-- Visitante -->
                <div class="text-center flex-1">
                    <?php if ($partido['logo_visitante']): ?>
                    <img src="<?= BASE_URL ?>/<?= $partido['logo_visitante'] ?>" alt="Logo" class="w-24 h-24 rounded-full mx-auto mb-4">
                    <?php else: ?>
                    <div class="w-24 h-24 rounded-full bg-primary flex items-center justify-center text-white text-4xl font-bold mx-auto mb-4">
                        <?= strtoupper(substr($partido['equipo_visitante'], 0, 1)) ?>
                    </div>
                    <?php endif; ?>
                    <p class="font-bold text-xl text-gray-800"><?= htmlspecialchars($partido['equipo_visitante']) ?></p>
                    <?php if ($partido['status'] !== 'PROGRAMADO'): ?>
                    <p class="text-5xl font-bold text-primary mt-4"><?= $partido['goles_visitante'] ?></p>
                    <?php endif; ?>
                </div>
            </div>
            
            <?php if ($partido['cancha_nombre']): ?>
            <div class="mt-8 text-center">
                <p class="text-sm text-gray-600">
                    <i class="fas fa-map-marker-alt mr-2"></i>
                    <?= htmlspecialchars($partido['cancha_nombre']) ?>
                    <?php if ($partido['sede_nombre']): ?>
                    - <?= htmlspecialchars($partido['sede_nombre']) ?>
                    <?php endif; ?>
                </p>
            </div>
            <?php endif; ?>
        </div>
        
        <!-- Goles -->
        <?php if (!empty($partido['goles'])): ?>
        <div class="bg-white rounded-lg shadow-lg p-6">
            <h2 class="text-xl font-bold mb-4">
                <i class="fas fa-futbol text-primary mr-2"></i>Goles
            </h2>
            
            <div class="space-y-3">
                <?php foreach ($partido['goles'] as $gol): ?>
                <div class="flex items-center p-3 bg-gray-50 rounded">
                    <div class="w-12 h-12 rounded-full bg-primary flex items-center justify-center text-white font-bold mr-4">
                        <?= $gol['minuto'] ?>'
                    </div>
                    <div class="flex-1">
                        <p class="font-bold text-gray-800">
                            <?= htmlspecialchars($gol['nombre'] . ' ' . $gol['apellidos']) ?>
                        </p>
                        <p class="text-sm text-gray-600">
                            <?= htmlspecialchars($gol['equipo_nombre']) ?>
                            <?php if ($gol['tipo'] !== 'NORMAL'): ?>
                            - <span class="text-xs px-2 py-1 bg-yellow-100 text-yellow-800 rounded"><?= $gol['tipo'] ?></span>
                            <?php endif; ?>
                        </p>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
        <?php endif; ?>
        
        <!-- Tarjetas -->
        <?php if (!empty($partido['tarjetas'])): ?>
        <div class="bg-white rounded-lg shadow-lg p-6">
            <h2 class="text-xl font-bold mb-4">
                <i class="fas fa-id-card text-primary mr-2"></i>Tarjetas
            </h2>
            
            <div class="space-y-3">
                <?php foreach ($partido['tarjetas'] as $tarjeta): ?>
                <div class="flex items-center p-3 bg-gray-50 rounded">
                    <div class="w-12 h-12 rounded-full bg-<?= $tarjeta['tipo'] === 'ROJA' ? 'red' : 'yellow' ?>-500 flex items-center justify-center text-white font-bold mr-4">
                        <?= $tarjeta['minuto'] ?>'
                    </div>
                    <div class="flex-1">
                        <p class="font-bold text-gray-800">
                            <?= htmlspecialchars($tarjeta['nombre'] . ' ' . $tarjeta['apellidos']) ?>
                        </p>
                        <?php if ($tarjeta['motivo']): ?>
                        <p class="text-sm text-gray-600"><?= htmlspecialchars($tarjeta['motivo']) ?></p>
                        <?php endif; ?>
                    </div>
                    <div class="w-8 h-10 rounded bg-<?= $tarjeta['tipo'] === 'ROJA' ? 'red' : 'yellow' ?>-500"></div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
        <?php endif; ?>
    </div>
    
    <!-- Sidebar -->
    <div class="lg:col-span-1 space-y-6">
        
        <!-- Información del Partido -->
        <div class="bg-white rounded-lg shadow-lg p-6">
            <h2 class="text-xl font-bold mb-4">Información</h2>
            
            <div class="space-y-3 text-sm">
                <div>
                    <p class="text-gray-600">Torneo</p>
                    <p class="font-semibold"><?= htmlspecialchars($partido['torneo_nombre']) ?></p>
                </div>
                
                <?php if ($partido['jornada']): ?>
                <div>
                    <p class="text-gray-600">Jornada</p>
                    <p class="font-semibold"><?= $partido['jornada'] ?></p>
                </div>
                <?php endif; ?>
                
                <?php if ($partido['fase']): ?>
                <div>
                    <p class="text-gray-600">Fase</p>
                    <p class="font-semibold"><?= htmlspecialchars($partido['fase']) ?></p>
                </div>
                <?php endif; ?>
                
                <?php if ($partido['arbitro_nombre']): ?>
                <div>
                    <p class="text-gray-600">Árbitro</p>
                    <p class="font-semibold"><?= htmlspecialchars($partido['arbitro_nombre']) ?></p>
                </div>
                <?php endif; ?>
                
                <div>
                    <p class="text-gray-600">Estado</p>
                    <span class="px-2 py-1 bg-<?= $partido['status'] === 'FINALIZADO' ? 'green' : 'blue' ?>-100 text-<?= $partido['status'] === 'FINALIZADO' ? 'green' : 'blue' ?>-800 text-xs rounded">
                        <?= $partido['status'] ?>
                    </span>
                </div>
            </div>
        </div>
        
        <!-- Observaciones -->
        <?php if ($partido['observaciones']): ?>
        <div class="bg-white rounded-lg shadow-lg p-6">
            <h2 class="text-xl font-bold mb-4">Observaciones</h2>
            <p class="text-sm text-gray-700"><?= nl2br(htmlspecialchars($partido['observaciones'])) ?></p>
        </div>
        <?php endif; ?>
        
        <!-- Acciones -->
        <?php if (in_array($user['rol_nombre'], ['SUPERADMIN', 'ARBITRO', 'ADMIN_SEDE'])): ?>
        <div class="bg-white rounded-lg shadow-lg p-6">
            <h2 class="text-xl font-bold mb-4">Acciones</h2>
            
            <div class="space-y-2">
                <?php if ($partido['status'] === 'PROGRAMADO'): ?>
                <button class="w-full bg-green-500 text-white py-2 rounded hover:bg-green-600">
                    <i class="fas fa-play mr-2"></i>Iniciar Partido
                </button>
                <?php endif; ?>
                
                <?php if (in_array($partido['status'], ['PROGRAMADO', 'EN_CURSO'])): ?>
                <button class="w-full bg-blue-500 text-white py-2 rounded hover:bg-blue-600">
                    <i class="fas fa-edit mr-2"></i>Registrar Evento
                </button>
                <?php endif; ?>
                
                <a href="<?= BASE_URL ?>/partidos" class="block w-full text-center border border-gray-300 py-2 rounded hover:bg-gray-50">
                    <i class="fas fa-arrow-left mr-2"></i>Volver
                </a>
            </div>
        </div>
        <?php endif; ?>
    </div>
</div>

</main>
</div>
