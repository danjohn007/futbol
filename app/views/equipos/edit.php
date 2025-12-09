<!-- Page Header -->
<div class="mb-8">
    <h1 class="text-3xl font-bold text-gray-800">Editar Equipo</h1>
    <p class="text-gray-600">Actualiza la información del equipo</p>
</div>

<?php if (isset($error)): ?>
<div class="mb-6 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
    <?= htmlspecialchars($error) ?>
</div>
<?php endif; ?>

<div class="bg-white rounded-lg shadow-lg p-6 max-w-3xl">
    <form method="POST" enctype="multipart/form-data">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            
            <!-- Nombre -->
            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Nombre del Equipo <span class="text-red-500">*</span>
                </label>
                <input type="text" name="nombre" value="<?= htmlspecialchars($equipo['nombre']) ?>" 
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary"
                       required>
            </div>
            
            <!-- Color Primario -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Color Primario
                </label>
                <div class="flex items-center space-x-3">
                    <input type="color" name="color_primario" value="<?= htmlspecialchars($equipo['color_primario'] ?? '#3B82F6') ?>" 
                           class="w-20 h-10 border border-gray-300 rounded cursor-pointer">
                    <span class="text-sm text-gray-600">Selecciona el color principal</span>
                </div>
            </div>
            
            <!-- Color Secundario -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Color Secundario
                </label>
                <div class="flex items-center space-x-3">
                    <input type="color" name="color_secundario" value="<?= htmlspecialchars($equipo['color_secundario'] ?? '#10B981') ?>" 
                           class="w-20 h-10 border border-gray-300 rounded cursor-pointer">
                    <span class="text-sm text-gray-600">Selecciona el color secundario</span>
                </div>
            </div>
            
            <!-- Teléfono -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Teléfono
                </label>
                <input type="tel" name="telefono" value="<?= htmlspecialchars($equipo['telefono'] ?? '') ?>" 
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary"
                       placeholder="442 123 4567">
            </div>
            
            <!-- Email -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Email
                </label>
                <input type="email" name="email" value="<?= htmlspecialchars($equipo['email'] ?? '') ?>" 
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary"
                       placeholder="equipo@ejemplo.com">
            </div>
            
            <!-- Logo -->
            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Logo del Equipo
                </label>
                
                <?php if ($equipo['logo']): ?>
                <div class="mb-3">
                    <img src="<?= BASE_URL ?>/<?= htmlspecialchars($equipo['logo']) ?>" 
                         alt="Logo actual" class="w-24 h-24 rounded-lg object-cover border border-gray-300">
                    <p class="text-sm text-gray-600 mt-1">Logo actual</p>
                </div>
                <?php endif; ?>
                
                <input type="file" name="logo" accept="image/*" 
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary">
                <p class="text-sm text-gray-500 mt-1">Formatos permitidos: JPG, PNG, GIF (máx. 2MB)</p>
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
                <i class="fas fa-save mr-2"></i>Guardar Cambios
            </button>
        </div>
    </form>
</div>

</main>
</div>
