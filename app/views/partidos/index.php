<!-- Page Header -->
<div class="mb-8">
    <h1 class="text-3xl font-bold text-gray-800">Calendario de Partidos</h1>
    <p class="text-gray-600">Partidos próximos y resultados recientes</p>
</div>

<!-- Tabs -->
<div class="mb-6">
    <div class="border-b border-gray-200">
        <nav class="-mb-px flex space-x-8">
            <button onclick="showTab('proximos')" id="tab-proximos" class="tab-btn border-b-2 border-primary text-primary py-4 px-1 font-medium">
                Próximos Partidos
            </button>
            <button onclick="showTab('recientes')" id="tab-recientes" class="tab-btn border-b-2 border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 py-4 px-1 font-medium">
                Resultados Recientes
            </button>
        </nav>
    </div>
</div>

<!-- Próximos Partidos -->
<div id="content-proximos" class="tab-content">
    <?php if (!empty($proximos)): ?>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <?php foreach ($proximos as $partido): ?>
        <div class="bg-white rounded-lg shadow-lg p-6 hover:shadow-xl transition">
            <div class="flex justify-between items-center mb-4">
                <span class="text-xs font-semibold text-gray-500"><?= htmlspecialchars($partido['torneo_nombre']) ?></span>
                <span class="text-xs text-gray-500">
                    <i class="fas fa-clock mr-1"></i>
                    <?= date('d/m/Y H:i', strtotime($partido['fecha_hora'])) ?>
                </span>
            </div>
            
            <div class="flex items-center justify-between mb-4">
                <div class="text-center flex-1">
                    <p class="font-bold text-gray-800 text-lg"><?= htmlspecialchars($partido['equipo_local']) ?></p>
                </div>
                <div class="mx-4 text-gray-400 font-bold text-xl">VS</div>
                <div class="text-center flex-1">
                    <p class="font-bold text-gray-800 text-lg"><?= htmlspecialchars($partido['equipo_visitante']) ?></p>
                </div>
            </div>
            
            <?php if ($partido['cancha_nombre']): ?>
            <p class="text-sm text-gray-600 text-center mb-2">
                <i class="fas fa-map-marker-alt mr-1"></i>
                <?= htmlspecialchars($partido['cancha_nombre']) ?>
            </p>
            <?php endif; ?>
            
            <a href="<?= BASE_URL ?>/partidos/detalle/<?= $partido['id'] ?>" class="block text-center bg-primary text-white py-2 rounded hover:bg-secondary transition">
                Ver Detalles
            </a>
        </div>
        <?php endforeach; ?>
    </div>
    <?php else: ?>
    <div class="bg-white rounded-lg shadow p-8 text-center">
        <i class="fas fa-calendar-alt text-4xl text-gray-400 mb-4"></i>
        <p class="text-gray-600">No hay partidos programados próximamente</p>
    </div>
    <?php endif; ?>
</div>

<!-- Resultados Recientes -->
<div id="content-recientes" class="tab-content hidden">
    <?php if (!empty($recientes)): ?>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <?php foreach ($recientes as $partido): ?>
        <div class="bg-white rounded-lg shadow-lg p-6 hover:shadow-xl transition">
            <div class="flex justify-between items-center mb-4">
                <span class="text-xs font-semibold text-gray-500"><?= htmlspecialchars($partido['torneo_nombre']) ?></span>
                <span class="text-xs text-gray-500"><?= date('d/m/Y', strtotime($partido['fecha_hora'])) ?></span>
            </div>
            
            <div class="flex items-center justify-between mb-4">
                <div class="text-center flex-1">
                    <p class="font-bold text-gray-800"><?= htmlspecialchars($partido['equipo_local']) ?></p>
                    <p class="text-3xl font-bold text-primary mt-2"><?= $partido['goles_local'] ?></p>
                </div>
                <div class="mx-4 text-gray-400 font-bold">-</div>
                <div class="text-center flex-1">
                    <p class="font-bold text-gray-800"><?= htmlspecialchars($partido['equipo_visitante']) ?></p>
                    <p class="text-3xl font-bold text-primary mt-2"><?= $partido['goles_visitante'] ?></p>
                </div>
            </div>
            
            <a href="<?= BASE_URL ?>/partidos/detalle/<?= $partido['id'] ?>" class="block text-center bg-gray-200 text-gray-700 py-2 rounded hover:bg-gray-300 transition">
                Ver Estadísticas
            </a>
        </div>
        <?php endforeach; ?>
    </div>
    <?php else: ?>
    <div class="bg-white rounded-lg shadow p-8 text-center">
        <i class="fas fa-info-circle text-4xl text-gray-400 mb-4"></i>
        <p class="text-gray-600">No hay resultados recientes</p>
    </div>
    <?php endif; ?>
</div>

<script>
function showTab(tab) {
    // Hide all tabs
    document.querySelectorAll('.tab-content').forEach(el => el.classList.add('hidden'));
    document.querySelectorAll('.tab-btn').forEach(el => {
        el.classList.remove('border-primary', 'text-primary');
        el.classList.add('border-transparent', 'text-gray-500');
    });
    
    // Show selected tab
    document.getElementById('content-' + tab).classList.remove('hidden');
    document.getElementById('tab-' + tab).classList.add('border-primary', 'text-primary');
    document.getElementById('tab-' + tab).classList.remove('border-transparent', 'text-gray-500');
}
</script>

</main>
</div>
