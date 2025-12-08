<!-- Page Header -->
<div class="mb-8">
    <h1 class="text-3xl font-bold text-gray-800">Crear Sede</h1>
    <p class="text-gray-600">Registrar nueva sede deportiva</p>
</div>

<?php if (isset($error)): ?>
<div class="mb-6 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
    <?= $error ?>
</div>
<?php endif; ?>

<div class="bg-white rounded-lg shadow-lg p-6">
    <form method="POST" action="<?= BASE_URL ?>/sedes/create">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Nombre -->
            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-700 mb-2">Nombre de la Sede *</label>
                <input type="text" name="nombre" required 
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-primary focus:border-primary"
                       value="<?= $_POST['nombre'] ?? '' ?>">
            </div>
            
            <!-- Dirección -->
            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-700 mb-2">Dirección *</label>
                <textarea name="direccion" required rows="2"
                          class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-primary focus:border-primary"><?= $_POST['direccion'] ?? '' ?></textarea>
            </div>
            
            <!-- Ciudad -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Ciudad *</label>
                <input type="text" name="ciudad" required 
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-primary focus:border-primary"
                       value="<?= $_POST['ciudad'] ?? '' ?>">
            </div>
            
            <!-- Estado -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Estado *</label>
                <input type="text" name="estado" required 
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-primary focus:border-primary"
                       value="<?= $_POST['estado'] ?? '' ?>">
            </div>
            
            <!-- Código Postal -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Código Postal</label>
                <input type="text" name="codigo_postal" 
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-primary focus:border-primary"
                       value="<?= $_POST['codigo_postal'] ?? '' ?>">
            </div>
            
            <!-- Teléfono -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Teléfono</label>
                <input type="tel" name="telefono" 
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-primary focus:border-primary"
                       value="<?= $_POST['telefono'] ?? '' ?>">
            </div>
            
            <!-- Email -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                <input type="email" name="email" 
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-primary focus:border-primary"
                       value="<?= $_POST['email'] ?? '' ?>">
            </div>
            
            <!-- Latitud -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Latitud</label>
                <input type="text" name="latitud" placeholder="20.588817"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-primary focus:border-primary"
                       value="<?= $_POST['latitud'] ?? '' ?>">
            </div>
            
            <!-- Longitud -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Longitud</label>
                <input type="text" name="longitud" placeholder="-100.389880"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-primary focus:border-primary"
                       value="<?= $_POST['longitud'] ?? '' ?>">
            </div>
        </div>
        
        <div class="mt-6 flex justify-end space-x-4">
            <a href="<?= BASE_URL ?>/sedes" class="px-6 py-2 border border-gray-300 rounded-lg hover:bg-gray-50">
                Cancelar
            </a>
            <button type="submit" class="px-6 py-2 bg-primary text-white rounded-lg hover:bg-secondary">
                <i class="fas fa-save mr-2"></i>Guardar Sede
            </button>
        </div>
    </form>
</div>

</main>
</div>
