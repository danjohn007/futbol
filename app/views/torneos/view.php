<!-- Flash Message -->
<?php if ($flash): ?>
<div class="mb-6 bg-<?= $flash['type'] === 'success' ? 'green' : 'red' ?>-100 border border-<?= $flash['type'] === 'success' ? 'green' : 'red' ?>-400 text-<?= $flash['type'] === 'success' ? 'green' : 'red' ?>-700 px-4 py-3 rounded relative">
    <span class="block sm:inline"><?= $flash['message'] ?></span>
</div>
<?php endif; ?>

<!-- Page Header -->
<div class="mb-8 flex justify-between items-center">
    <div>
        <h1 class="text-3xl font-bold text-gray-800"><?= htmlspecialchars($torneo['nombre']) ?></h1>
        <p class="text-gray-600">Detalles del torneo</p>
    </div>
    <div class="flex items-center space-x-3">
        <?php if ($torneo['status'] === 'INSCRIPCIONES' && in_array($user['rol_nombre'], ['SUPERADMIN', 'ORGANIZADOR', 'DELEGADO'])): ?>
        <a href="<?= BASE_URL ?>/torneos/inscribirEquipo/<?= $torneo['id'] ?>" 
           class="px-4 py-2 bg-primary text-white rounded-lg hover:bg-secondary">
            <i class="fas fa-plus mr-2"></i>Inscribir Equipo
        </a>
        <?php endif; ?>
        <span class="px-4 py-2 bg-<?= $torneo['status'] === 'ACTIVO' ? 'green' : ($torneo['status'] === 'INSCRIPCIONES' ? 'blue' : 'gray') ?>-100 text-<?= $torneo['status'] === 'ACTIVO' ? 'green' : ($torneo['status'] === 'INSCRIPCIONES' ? 'blue' : 'gray') ?>-800 text-sm font-semibold rounded-full">
            <?= $torneo['status'] ?>
        </span>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Información del Torneo -->
    <div class="lg:col-span-2 space-y-6">
        
        <!-- Info General -->
        <div class="bg-white rounded-lg shadow-lg p-6">
            <h2 class="text-xl font-bold mb-4">Información General</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <p class="text-sm text-gray-600">Tipo</p>
                    <p class="font-semibold"><?= htmlspecialchars($torneo['tipo']) ?></p>
                </div>
                
                <?php if ($torneo['categoria_nombre']): ?>
                <div>
                    <p class="text-sm text-gray-600">Categoría</p>
                    <p class="font-semibold"><?= htmlspecialchars($torneo['categoria_nombre']) ?></p>
                </div>
                <?php endif; ?>
                
                <?php if ($torneo['sede_nombre']): ?>
                <div>
                    <p class="text-sm text-gray-600">Sede</p>
                    <p class="font-semibold"><?= htmlspecialchars($torneo['sede_nombre']) ?></p>
                </div>
                <?php endif; ?>
                
                <div>
                    <p class="text-sm text-gray-600">Organizador</p>
                    <p class="font-semibold"><?= htmlspecialchars($torneo['organizador_nombre']) ?></p>
                </div>
                
                <div>
                    <p class="text-sm text-gray-600">Fecha Inicio</p>
                    <p class="font-semibold"><?= date('d/m/Y', strtotime($torneo['fecha_inicio'])) ?></p>
                </div>
                
                <?php if ($torneo['fecha_fin']): ?>
                <div>
                    <p class="text-sm text-gray-600">Fecha Fin</p>
                    <p class="font-semibold"><?= date('d/m/Y', strtotime($torneo['fecha_fin'])) ?></p>
                </div>
                <?php endif; ?>
            </div>
            
            <?php if ($torneo['descripcion']): ?>
            <div class="mt-4">
                <p class="text-sm text-gray-600">Descripción</p>
                <p class="text-gray-800 mt-1"><?= nl2br(htmlspecialchars($torneo['descripcion'])) ?></p>
            </div>
            <?php endif; ?>
        </div>
        
        <!-- Tabla de Posiciones -->
        <?php if (!empty($tabla)): ?>
        <div class="bg-white rounded-lg shadow-lg p-6">
            <h2 class="text-xl font-bold mb-4">Tabla de Posiciones</h2>
            
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500">Pos</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500">Equipo</th>
                            <th class="px-4 py-2 text-center text-xs font-medium text-gray-500">PJ</th>
                            <th class="px-4 py-2 text-center text-xs font-medium text-gray-500">PG</th>
                            <th class="px-4 py-2 text-center text-xs font-medium text-gray-500">PE</th>
                            <th class="px-4 py-2 text-center text-xs font-medium text-gray-500">PP</th>
                            <th class="px-4 py-2 text-center text-xs font-medium text-gray-500">GF</th>
                            <th class="px-4 py-2 text-center text-xs font-medium text-gray-500">GC</th>
                            <th class="px-4 py-2 text-center text-xs font-medium text-gray-500">DG</th>
                            <th class="px-4 py-2 text-center text-xs font-medium text-gray-500 font-bold">PTS</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <?php foreach ($tabla as $idx => $pos): ?>
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-3 text-sm font-bold text-gray-900"><?= $idx + 1 ?></td>
                            <td class="px-4 py-3 text-sm font-medium text-gray-900"><?= htmlspecialchars($pos['equipo_nombre']) ?></td>
                            <td class="px-4 py-3 text-sm text-gray-600 text-center"><?= $pos['partidos_jugados'] ?></td>
                            <td class="px-4 py-3 text-sm text-gray-600 text-center"><?= $pos['partidos_ganados'] ?></td>
                            <td class="px-4 py-3 text-sm text-gray-600 text-center"><?= $pos['partidos_empatados'] ?></td>
                            <td class="px-4 py-3 text-sm text-gray-600 text-center"><?= $pos['partidos_perdidos'] ?></td>
                            <td class="px-4 py-3 text-sm text-gray-600 text-center"><?= $pos['goles_favor'] ?></td>
                            <td class="px-4 py-3 text-sm text-gray-600 text-center"><?= $pos['goles_contra'] ?></td>
                            <td class="px-4 py-3 text-sm text-gray-600 text-center"><?= $pos['diferencia_goles'] ?></td>
                            <td class="px-4 py-3 text-sm font-bold text-primary text-center"><?= $pos['puntos'] ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <?php endif; ?>
        
        <!-- Próximos Partidos -->
        <?php if (!empty($partidos)): ?>
        <div class="bg-white rounded-lg shadow-lg p-6">
            <h2 class="text-xl font-bold mb-4">Calendario de Partidos</h2>
            
            <div class="space-y-4">
                <?php foreach (array_slice($partidos, 0, 5) as $partido): ?>
                <div class="border rounded-lg p-4 hover:bg-gray-50">
                    <div class="flex justify-between items-start mb-2">
                        <span class="text-xs text-gray-500">Jornada <?= $partido['jornada'] ?? '-' ?></span>
                        <span class="text-xs text-gray-500"><?= date('d/m/Y H:i', strtotime($partido['fecha_hora'])) ?></span>
                    </div>
                    
                    <div class="flex items-center justify-between">
                        <div class="text-center flex-1">
                            <p class="font-semibold"><?= htmlspecialchars($partido['equipo_local']) ?></p>
                            <?php if ($partido['status'] === 'FINALIZADO'): ?>
                            <p class="text-2xl font-bold text-primary mt-1"><?= $partido['goles_local'] ?></p>
                            <?php endif; ?>
                        </div>
                        <div class="mx-4 text-gray-400 font-bold"><?= $partido['status'] === 'FINALIZADO' ? '-' : 'VS' ?></div>
                        <div class="text-center flex-1">
                            <p class="font-semibold"><?= htmlspecialchars($partido['equipo_visitante']) ?></p>
                            <?php if ($partido['status'] === 'FINALIZADO'): ?>
                            <p class="text-2xl font-bold text-primary mt-1"><?= $partido['goles_visitante'] ?></p>
                            <?php endif; ?>
                        </div>
                    </div>
                    
                    <?php if ($partido['cancha_nombre']): ?>
                    <p class="text-xs text-gray-500 text-center mt-2">
                        <i class="fas fa-map-marker-alt mr-1"></i><?= htmlspecialchars($partido['cancha_nombre']) ?>
                    </p>
                    <?php endif; ?>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
        <?php endif; ?>
    </div>
    
    <!-- Sidebar -->
    <div class="lg:col-span-1 space-y-6">
        
        <!-- Equipos Inscritos -->
        <div class="bg-white rounded-lg shadow-lg p-6">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-bold">Equipos Inscritos</h2>
                <span class="text-sm font-semibold text-primary"><?= count($equipos) ?> equipos</span>
            </div>
            
            <?php if (!empty($equipos)): ?>
            <div class="space-y-2">
                <?php foreach ($equipos as $equipo): ?>
                <a href="<?= BASE_URL ?>/equipos/detalle/<?= $equipo['id'] ?>" class="flex items-center p-3 rounded border border-gray-200 hover:bg-gray-50 hover:border-primary transition">
                    <?php if ($equipo['logo']): ?>
                    <img src="<?= BASE_URL ?>/<?= $equipo['logo'] ?>" alt="<?= htmlspecialchars($equipo['nombre']) ?>" 
                         class="w-10 h-10 rounded-full object-cover mr-3">
                    <?php else: ?>
                    <div class="w-10 h-10 rounded-full bg-primary flex items-center justify-center text-white text-sm font-bold mr-3">
                        <?= strtoupper(substr($equipo['nombre'], 0, 1)) ?>
                    </div>
                    <?php endif; ?>
                    <div class="flex-1">
                        <p class="text-sm font-medium text-gray-800"><?= htmlspecialchars($equipo['nombre']) ?></p>
                        <?php if ($equipo['grupo']): ?>
                        <p class="text-xs text-gray-500">Grupo <?= $equipo['grupo'] ?></p>
                        <?php endif; ?>
                    </div>
                    <span class="text-xs px-2 py-1 bg-<?= $equipo['inscripcion_status'] === 'APROBADO' ? 'green' : 'yellow' ?>-100 text-<?= $equipo['inscripcion_status'] === 'APROBADO' ? 'green' : 'yellow' ?>-800 rounded">
                        <?= $equipo['inscripcion_status'] ?>
                    </span>
                </a>
                <?php endforeach; ?>
            </div>
            <?php else: ?>
            <div class="text-center py-8">
                <i class="fas fa-users text-4xl text-gray-400 mb-3"></i>
                <p class="text-gray-500 text-sm">No hay equipos inscritos</p>
                <?php if ($torneo['status'] === 'INSCRIPCIONES' && in_array($user['rol_nombre'], ['SUPERADMIN', 'ORGANIZADOR', 'DELEGADO'])): ?>
                <a href="<?= BASE_URL ?>/torneos/inscribirEquipo/<?= $torneo['id'] ?>" 
                   class="inline-block mt-3 text-primary hover:underline text-sm">
                    <i class="fas fa-plus mr-1"></i>Inscribir primer equipo
                </a>
                <?php endif; ?>
            </div>
            <?php endif; ?>
        </div>
        
        <!-- Reglas -->
        <div class="bg-white rounded-lg shadow-lg p-6">
            <h2 class="text-xl font-bold mb-4">Sistema de Puntos</h2>
            
            <div class="space-y-2 text-sm">
                <div class="flex justify-between">
                    <span class="text-gray-600">Victoria:</span>
                    <span class="font-semibold"><?= $torneo['puntos_victoria'] ?> puntos</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-600">Empate:</span>
                    <span class="font-semibold"><?= $torneo['puntos_empate'] ?> puntos</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-600">Derrota:</span>
                    <span class="font-semibold"><?= $torneo['puntos_derrota'] ?> puntos</span>
                </div>
            </div>
        </div>
    </div>
</div>

</main>
</div>
