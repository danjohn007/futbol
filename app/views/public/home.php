<!-- Hero Section -->
<div class="bg-gradient-to-r from-primary to-secondary text-white py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h1 class="text-5xl font-bold mb-4">
            <i class="fas fa-futbol"></i> Bienvenido a FutbolManager
        </h1>
        <p class="text-xl mb-8">Sistema integral de gestión de torneos de fútbol</p>
        <?php if (!isset($_SESSION['user_id'])): ?>
        <a href="<?= BASE_URL ?>/auth/register" class="bg-white text-primary px-8 py-3 rounded-lg font-bold hover:bg-gray-100 inline-block">
            Comenzar Ahora
        </a>
        <?php endif; ?>
    </div>
</div>

<!-- Torneos Activos -->
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <h2 class="text-3xl font-bold mb-8">
        <i class="fas fa-trophy text-primary"></i> Torneos Activos
    </h2>
    
    <?php if (!empty($torneos)): ?>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <?php foreach ($torneos as $torneo): ?>
        <div class="bg-white rounded-lg shadow-lg p-6 hover:shadow-xl transition">
            <div class="flex items-start justify-between mb-4">
                <h3 class="text-xl font-bold text-gray-800"><?= htmlspecialchars($torneo['nombre']) ?></h3>
                <span class="px-3 py-1 bg-<?= $torneo['status'] === 'ACTIVO' ? 'green' : 'blue' ?>-100 text-<?= $torneo['status'] === 'ACTIVO' ? 'green' : 'blue' ?>-800 text-xs font-semibold rounded-full">
                    <?= $torneo['status'] ?>
                </span>
            </div>
            
            <div class="space-y-2 text-sm text-gray-600 mb-4">
                <?php if ($torneo['categoria_nombre']): ?>
                <p><i class="fas fa-tag mr-2"></i><?= htmlspecialchars($torneo['categoria_nombre']) ?></p>
                <?php endif; ?>
                
                <?php if ($torneo['sede_nombre']): ?>
                <p><i class="fas fa-map-marker-alt mr-2"></i><?= htmlspecialchars($torneo['sede_nombre']) ?></p>
                <?php endif; ?>
                
                <p><i class="fas fa-calendar mr-2"></i><?= date('d/m/Y', strtotime($torneo['fecha_inicio'])) ?></p>
                <p><i class="fas fa-user mr-2"></i>Org: <?= htmlspecialchars($torneo['organizador_nombre']) ?></p>
            </div>
            
            <a href="<?= BASE_URL ?>/torneos/view/<?= $torneo['id'] ?>" class="block text-center bg-primary text-white py-2 rounded hover:bg-secondary transition">
                Ver Detalles
            </a>
        </div>
        <?php endforeach; ?>
    </div>
    <?php else: ?>
    <div class="bg-white rounded-lg shadow p-8 text-center">
        <i class="fas fa-info-circle text-4xl text-gray-400 mb-4"></i>
        <p class="text-gray-600">No hay torneos activos en este momento</p>
    </div>
    <?php endif; ?>
</div>

<!-- Próximos Partidos -->
<?php if (!empty($proximos_partidos)): ?>
<div class="bg-gray-100 py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-3xl font-bold mb-8">
            <i class="fas fa-calendar-alt text-primary"></i> Próximos Partidos
        </h2>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <?php foreach ($proximos_partidos as $partido): ?>
            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex justify-between items-center mb-4">
                    <span class="text-xs font-semibold text-gray-500"><?= htmlspecialchars($partido['torneo_nombre']) ?></span>
                    <span class="text-xs text-gray-500">
                        <i class="fas fa-clock mr-1"></i>
                        <?= date('d/m/Y H:i', strtotime($partido['fecha_hora'])) ?>
                    </span>
                </div>
                
                <div class="flex items-center justify-between">
                    <div class="text-center flex-1">
                        <p class="font-bold text-gray-800"><?= htmlspecialchars($partido['equipo_local']) ?></p>
                    </div>
                    <div class="mx-4 text-gray-400 font-bold">VS</div>
                    <div class="text-center flex-1">
                        <p class="font-bold text-gray-800"><?= htmlspecialchars($partido['equipo_visitante']) ?></p>
                    </div>
                </div>
                
                <?php if ($partido['cancha_nombre']): ?>
                <p class="mt-4 text-sm text-gray-600 text-center">
                    <i class="fas fa-map-marker-alt mr-1"></i>
                    <?= htmlspecialchars($partido['cancha_nombre']) ?>
                </p>
                <?php endif; ?>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
<?php endif; ?>

<!-- Features -->
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <h2 class="text-3xl font-bold mb-8 text-center">Funcionalidades del Sistema</h2>
    
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <div class="text-center">
            <div class="bg-primary text-white rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-trophy text-2xl"></i>
            </div>
            <h3 class="text-xl font-bold mb-2">Gestión de Torneos</h3>
            <p class="text-gray-600">Crea y administra torneos de diferentes categorías y formatos</p>
        </div>
        
        <div class="text-center">
            <div class="bg-primary text-white rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-users text-2xl"></i>
            </div>
            <h3 class="text-xl font-bold mb-2">Equipos y Jugadores</h3>
            <p class="text-gray-600">Registra equipos, plantillas y estadísticas de jugadores</p>
        </div>
        
        <div class="text-center">
            <div class="bg-primary text-white rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-chart-line text-2xl"></i>
            </div>
            <h3 class="text-xl font-bold mb-2">Estadísticas</h3>
            <p class="text-gray-600">Tablas de posiciones, goleadores y estadísticas en tiempo real</p>
        </div>
    </div>
</div>
