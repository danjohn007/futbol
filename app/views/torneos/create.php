<!-- Page Header -->
<div class="mb-8">
    <h1 class="text-3xl font-bold text-gray-800">Crear Torneo</h1>
    <p class="text-gray-600">Configurar un nuevo torneo de fútbol</p>
</div>

<?php if (isset($error)): ?>
<div class="mb-6 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
    <?= $error ?>
</div>
<?php endif; ?>

<form method="POST" action="<?= BASE_URL ?>/torneos/create" class="bg-white rounded-lg shadow-lg p-6">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        
        <!-- Información Básica -->
        <div class="md:col-span-2">
            <h2 class="text-xl font-bold mb-4 text-primary">Información Básica</h2>
        </div>
        
        <div class="md:col-span-2">
            <label class="block text-sm font-medium text-gray-700 mb-2">Nombre del Torneo *</label>
            <input type="text" name="nombre" required 
                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-primary focus:border-primary"
                   value="<?= $_POST['nombre'] ?? '' ?>"
                   placeholder="Ej: Liga Queretana Primavera 2025">
        </div>
        
        <div class="md:col-span-2">
            <label class="block text-sm font-medium text-gray-700 mb-2">Descripción</label>
            <textarea name="descripcion" rows="3"
                      class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-primary focus:border-primary"
                      placeholder="Descripción del torneo..."><?= $_POST['descripcion'] ?? '' ?></textarea>
        </div>
        
        <!-- Configuración del Torneo -->
        <div class="md:col-span-2">
            <h2 class="text-xl font-bold mb-4 text-primary">Configuración</h2>
        </div>
        
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Tipo de Torneo *</label>
            <select name="tipo" required 
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-primary focus:border-primary">
                <option value="LIGA" <?= ($_POST['tipo'] ?? '') === 'LIGA' ? 'selected' : '' ?>>Liga (Round Robin)</option>
                <option value="ELIMINATORIA" <?= ($_POST['tipo'] ?? '') === 'ELIMINATORIA' ? 'selected' : '' ?>>Eliminatoria (Knockout)</option>
                <option value="MIXTO" <?= ($_POST['tipo'] ?? '') === 'MIXTO' ? 'selected' : '' ?>>Mixto (Grupos + Eliminatoria)</option>
            </select>
        </div>
        
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Categoría</label>
            <select name="categoria_id" 
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-primary focus:border-primary">
                <option value="">Sin categoría</option>
                <?php foreach ($categorias as $cat): ?>
                <option value="<?= $cat['id'] ?>" <?= ($_POST['categoria_id'] ?? '') == $cat['id'] ? 'selected' : '' ?>>
                    <?= htmlspecialchars($cat['nombre']) ?>
                </option>
                <?php endforeach; ?>
            </select>
        </div>
        
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Sede</label>
            <select name="sede_id" 
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-primary focus:border-primary">
                <option value="">Sin sede específica</option>
                <?php foreach ($sedes as $sede): ?>
                <option value="<?= $sede['id'] ?>" <?= ($_POST['sede_id'] ?? '') == $sede['id'] ? 'selected' : '' ?>>
                    <?= htmlspecialchars($sede['nombre']) ?>
                </option>
                <?php endforeach; ?>
            </select>
        </div>
        
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Número de Equipos</label>
            <input type="number" name="num_equipos" min="2" 
                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-primary focus:border-primary"
                   value="<?= $_POST['num_equipos'] ?? 16 ?>">
        </div>
        
        <!-- Fechas -->
        <div class="md:col-span-2">
            <h2 class="text-xl font-bold mb-4 text-primary">Fechas</h2>
        </div>
        
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Fecha de Inicio *</label>
            <input type="date" name="fecha_inicio" required 
                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-primary focus:border-primary"
                   value="<?= $_POST['fecha_inicio'] ?? '' ?>">
        </div>
        
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Fecha de Finalización</label>
            <input type="date" name="fecha_fin" 
                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-primary focus:border-primary"
                   value="<?= $_POST['fecha_fin'] ?? '' ?>">
        </div>
        
        <!-- Sistema de Puntos -->
        <div class="md:col-span-2">
            <h2 class="text-xl font-bold mb-4 text-primary">Sistema de Puntos</h2>
        </div>
        
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Puntos por Victoria</label>
            <input type="number" name="puntos_victoria" min="0" 
                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-primary focus:border-primary"
                   value="<?= $_POST['puntos_victoria'] ?? 3 ?>">
        </div>
        
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Puntos por Empate</label>
            <input type="number" name="puntos_empate" min="0" 
                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-primary focus:border-primary"
                   value="<?= $_POST['puntos_empate'] ?? 1 ?>">
        </div>
        
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Puntos por Derrota</label>
            <input type="number" name="puntos_derrota" min="0" 
                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-primary focus:border-primary"
                   value="<?= $_POST['puntos_derrota'] ?? 0 ?>">
        </div>
        
        <!-- Opciones -->
        <div class="md:col-span-2">
            <div class="flex items-center mt-4">
                <input type="checkbox" name="publico" id="publico" 
                       <?= ($_POST['publico'] ?? true) ? 'checked' : '' ?>
                       class="h-4 w-4 text-primary focus:ring-primary border-gray-300 rounded">
                <label for="publico" class="ml-2 block text-sm text-gray-700">
                    Torneo público (visible para todos los usuarios)
                </label>
            </div>
        </div>
    </div>
    
    <!-- Botones de Acción -->
    <div class="mt-8 flex justify-end space-x-4">
        <a href="<?= BASE_URL ?>/torneos" class="px-6 py-2 border border-gray-300 rounded-lg hover:bg-gray-50">
            Cancelar
        </a>
        <button type="submit" class="px-6 py-2 bg-primary text-white rounded-lg hover:bg-secondary">
            <i class="fas fa-save mr-2"></i>Crear Torneo
        </button>
    </div>
</form>

</main>
</div>
