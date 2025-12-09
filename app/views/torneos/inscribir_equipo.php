<!-- Page Header -->
<div class="mb-8">
    <h1 class="text-3xl font-bold text-gray-800">Inscribir Equipo</h1>
    <p class="text-gray-600">Inscribe un equipo al torneo: <?= htmlspecialchars($torneo['nombre']) ?></p>
</div>

<?php if (isset($error)): ?>
<div class="mb-6 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
    <?= htmlspecialchars($error) ?>
</div>
<?php endif; ?>

<div class="bg-white rounded-lg shadow-lg p-6 max-w-3xl">
    
    <?php if (empty($equipos)): ?>
    <div class="text-center py-8">
        <i class="fas fa-info-circle text-4xl text-gray-400 mb-4"></i>
        <p class="text-gray-600">No hay equipos disponibles para inscribir en este torneo.</p>
        <p class="text-sm text-gray-500 mt-2">Todos los equipos ya están inscritos o no tienes equipos registrados.</p>
        <div class="mt-6">
            <a href="<?= BASE_URL ?>/torneos/detalle/<?= $torneo['id'] ?>" 
               class="px-6 py-2 bg-primary text-white rounded-lg hover:bg-secondary">
                Volver al Torneo
            </a>
        </div>
    </div>
    <?php else: ?>
    
    <form method="POST">
        <div class="space-y-6">
            
            <!-- Información del Torneo -->
            <div class="bg-gray-50 rounded-lg p-4">
                <h3 class="font-bold text-gray-800 mb-2"><?= htmlspecialchars($torneo['nombre']) ?></h3>
                <div class="text-sm text-gray-600 space-y-1">
                    <p><i class="fas fa-calendar mr-2"></i>Fecha de inicio: <?= date('d/m/Y', strtotime($torneo['fecha_inicio'])) ?></p>
                    <p><i class="fas fa-trophy mr-2"></i>Tipo: <?= htmlspecialchars($torneo['tipo']) ?></p>
                </div>
            </div>
            
            <!-- Seleccionar Equipo -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Selecciona el Equipo <span class="text-red-500">*</span>
                </label>
                <select name="equipo_id" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary">
                    <option value="">-- Selecciona un equipo --</option>
                    <?php foreach ($equipos as $equipo): ?>
                    <option value="<?= $equipo['id'] ?>"><?= htmlspecialchars($equipo['nombre']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            
            <!-- Grupo (opcional) -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Grupo (opcional)
                </label>
                <input type="text" name="grupo" maxlength="10" 
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary"
                       placeholder="A, B, C, etc.">
                <p class="text-sm text-gray-500 mt-1">Solo si el torneo tiene grupos</p>
            </div>
            
        </div>
        
        <!-- Botones -->
        <div class="flex justify-end space-x-4 mt-6">
            <a href="<?= BASE_URL ?>/torneos/detalle/<?= $torneo['id'] ?>" 
               class="px-6 py-2 border border-gray-300 rounded-lg hover:bg-gray-50">
                Cancelar
            </a>
            <button type="submit" 
                    class="px-6 py-2 bg-primary text-white rounded-lg hover:bg-secondary">
                <i class="fas fa-check mr-2"></i>Inscribir Equipo
            </button>
        </div>
    </form>
    
    <?php endif; ?>
</div>

</main>
</div>
