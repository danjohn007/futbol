<!-- Page Header -->
<div class="mb-8">
    <h1 class="text-3xl font-bold text-gray-800">Agregar Jugador</h1>
    <p class="text-gray-600">Agrega un nuevo jugador al equipo: <?= htmlspecialchars($equipo['nombre']) ?></p>
</div>

<?php if (isset($error)): ?>
<div class="mb-6 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
    <?= htmlspecialchars($error) ?>
</div>
<?php endif; ?>

<div class="bg-white rounded-lg shadow-lg p-6 max-w-3xl">
    <form method="POST">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            
            <!-- Nombre -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Nombre <span class="text-red-500">*</span>
                </label>
                <input type="text" name="nombre" 
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary"
                       required placeholder="Juan">
            </div>
            
            <!-- Apellidos -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Apellidos <span class="text-red-500">*</span>
                </label>
                <input type="text" name="apellidos" 
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary"
                       required placeholder="Pérez García">
            </div>
            
            <!-- Fecha de Nacimiento -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Fecha de Nacimiento
                </label>
                <input type="date" name="fecha_nacimiento" 
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary">
            </div>
            
            <!-- Número de Camisa -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Número de Camisa
                </label>
                <input type="number" name="numero_camisa" min="1" max="99" 
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary"
                       placeholder="10">
            </div>
            
            <!-- Posición -->
            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Posición
                </label>
                <select name="posicion" 
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary">
                    <option value="">Seleccionar posición</option>
                    <option value="Portero">Portero</option>
                    <option value="Defensa">Defensa</option>
                    <option value="Lateral Derecho">Lateral Derecho</option>
                    <option value="Lateral Izquierdo">Lateral Izquierdo</option>
                    <option value="Mediocampista">Mediocampista</option>
                    <option value="Mediocampista Defensivo">Mediocampista Defensivo</option>
                    <option value="Mediocampista Ofensivo">Mediocampista Ofensivo</option>
                    <option value="Extremo Derecho">Extremo Derecho</option>
                    <option value="Extremo Izquierdo">Extremo Izquierdo</option>
                    <option value="Delantero">Delantero</option>
                    <option value="Delantero Centro">Delantero Centro</option>
                </select>
            </div>
            
        </div>
        
        <!-- Botones -->
        <div class="flex justify-end space-x-4 mt-6">
            <a href="<?= BASE_URL ?>/equipos/detalle/<?= $equipo['id'] ?>" 
               class="px-6 py-2 border border-gray-300 rounded-lg hover:bg-gray-50">
                Cancelar
            </a>
            <button type="submit" 
                    class="px-6 py-2 bg-primary text-white rounded-lg hover:bg-secondary">
                <i class="fas fa-user-plus mr-2"></i>Agregar Jugador
            </button>
        </div>
    </form>
</div>

</main>
</div>
