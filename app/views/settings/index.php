<!-- Flash Message -->
<?php if ($flash): ?>
<div class="mb-6 bg-<?= $flash['type'] === 'success' ? 'green' : 'red' ?>-100 border border-<?= $flash['type'] === 'success' ? 'green' : 'red' ?>-400 text-<?= $flash['type'] === 'success' ? 'green' : 'red' ?>-700 px-4 py-3 rounded relative" role="alert">
    <span class="block sm:inline"><?= $flash['message'] ?></span>
</div>
<?php endif; ?>

<!-- Page Header -->
<div class="mb-8">
    <h1 class="text-3xl font-bold text-gray-800">
        <i class="fas fa-cog mr-2"></i>Configuración del Sistema
    </h1>
    <p class="text-gray-600">Personaliza el sistema según tus necesidades</p>
</div>

<form method="POST" action="<?= BASE_URL ?>/settings" enctype="multipart/form-data">
    <div class="space-y-6">
        
        <!-- Información General -->
        <div class="bg-white rounded-lg shadow-lg p-6">
            <h2 class="text-xl font-bold mb-4 flex items-center">
                <i class="fas fa-info-circle text-primary mr-2"></i>
                Información General
            </h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Nombre del Sitio</label>
                    <input type="text" name="site_name" value="<?= htmlspecialchars($config['site_name'] ?? 'FutbolManager') ?>"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-primary focus:border-primary">
                </div>
                
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Logo del Sitio</label>
                    <input type="file" name="site_logo" accept="image/*"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-primary focus:border-primary">
                    <?php if (!empty($config['site_logo'])): ?>
                    <img src="<?= BASE_URL ?>/<?= $config['site_logo'] ?>" alt="Logo" class="mt-2 h-16">
                    <?php endif; ?>
                </div>
            </div>
        </div>
        
        <!-- Información de Contacto -->
        <div class="bg-white rounded-lg shadow-lg p-6">
            <h2 class="text-xl font-bold mb-4 flex items-center">
                <i class="fas fa-phone text-primary mr-2"></i>
                Información de Contacto
            </h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Email de Contacto</label>
                    <input type="email" name="contact_email" value="<?= htmlspecialchars($config['contact_email'] ?? '') ?>"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-primary focus:border-primary">
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Teléfono de Contacto</label>
                    <input type="text" name="contact_phone" value="<?= htmlspecialchars($config['contact_phone'] ?? '') ?>"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-primary focus:border-primary">
                </div>
                
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Horario de Atención</label>
                    <input type="text" name="business_hours" value="<?= htmlspecialchars($config['business_hours'] ?? '') ?>"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-primary focus:border-primary"
                           placeholder="Lunes a Viernes: 9:00 AM - 6:00 PM">
                </div>
            </div>
        </div>
        
        <!-- Colores del Sistema -->
        <div class="bg-white rounded-lg shadow-lg p-6">
            <h2 class="text-xl font-bold mb-4 flex items-center">
                <i class="fas fa-palette text-primary mr-2"></i>
                Colores del Sistema
            </h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Color Principal</label>
                    <div class="flex items-center space-x-2">
                        <input type="color" name="primary_color" value="<?= $config['primary_color'] ?? '#3B82F6' ?>"
                               class="h-10 w-20 border border-gray-300 rounded cursor-pointer">
                        <input type="text" value="<?= $config['primary_color'] ?? '#3B82F6' ?>" readonly
                               class="flex-1 px-4 py-2 border border-gray-300 rounded-lg bg-gray-50">
                    </div>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Color Secundario</label>
                    <div class="flex items-center space-x-2">
                        <input type="color" name="secondary_color" value="<?= $config['secondary_color'] ?? '#1E40AF' ?>"
                               class="h-10 w-20 border border-gray-300 rounded cursor-pointer">
                        <input type="text" value="<?= $config['secondary_color'] ?? '#1E40AF' ?>" readonly
                               class="flex-1 px-4 py-2 border border-gray-300 rounded-lg bg-gray-50">
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Configuración de Correo (SMTP) -->
        <div class="bg-white rounded-lg shadow-lg p-6">
            <h2 class="text-xl font-bold mb-4 flex items-center">
                <i class="fas fa-envelope text-primary mr-2"></i>
                Configuración de Correo (SMTP)
            </h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Servidor SMTP</label>
                    <input type="text" name="smtp_host" value="<?= htmlspecialchars($config['smtp_host'] ?? 'smtp.gmail.com') ?>"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-primary focus:border-primary">
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Puerto SMTP</label>
                    <input type="number" name="smtp_port" value="<?= htmlspecialchars($config['smtp_port'] ?? '587') ?>"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-primary focus:border-primary">
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Usuario SMTP</label>
                    <input type="text" name="smtp_user" value="<?= htmlspecialchars($config['smtp_user'] ?? '') ?>"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-primary focus:border-primary">
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Contraseña SMTP</label>
                    <input type="password" name="smtp_pass" value="<?= htmlspecialchars($config['smtp_pass'] ?? '') ?>"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-primary focus:border-primary">
                </div>
            </div>
        </div>
        
        <!-- Integración con PayPal -->
        <div class="bg-white rounded-lg shadow-lg p-6">
            <h2 class="text-xl font-bold mb-4 flex items-center">
                <i class="fab fa-paypal text-primary mr-2"></i>
                Integración con PayPal
            </h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Email de PayPal</label>
                    <input type="email" name="paypal_email" value="<?= htmlspecialchars($config['paypal_email'] ?? '') ?>"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-primary focus:border-primary">
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Modo de PayPal</label>
                    <select name="paypal_mode" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-primary focus:border-primary">
                        <option value="sandbox" <?= ($config['paypal_mode'] ?? 'sandbox') === 'sandbox' ? 'selected' : '' ?>>Sandbox (Pruebas)</option>
                        <option value="live" <?= ($config['paypal_mode'] ?? '') === 'live' ? 'selected' : '' ?>>Live (Producción)</option>
                    </select>
                </div>
            </div>
        </div>
        
        <!-- Integración con Google Maps -->
        <div class="bg-white rounded-lg shadow-lg p-6">
            <h2 class="text-xl font-bold mb-4 flex items-center">
                <i class="fas fa-map text-primary mr-2"></i>
                Integración con Google Maps
            </h2>
            
            <div class="grid grid-cols-1 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">API Key de Google Maps</label>
                    <input type="text" name="google_maps_api_key" value="<?= htmlspecialchars($config['google_maps_api_key'] ?? '') ?>"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-primary focus:border-primary"
                           placeholder="Tu API Key de Google Maps">
                    <p class="mt-1 text-xs text-gray-500">
                        Obtén tu API Key en: <a href="https://console.cloud.google.com/google/maps-apis" target="_blank" class="text-blue-600 hover:underline">Google Cloud Console</a>
                    </p>
                </div>
            </div>
        </div>
        
        <!-- API para Códigos QR -->
        <div class="bg-white rounded-lg shadow-lg p-6">
            <h2 class="text-xl font-bold mb-4 flex items-center">
                <i class="fas fa-qrcode text-primary mr-2"></i>
                API para Códigos QR
            </h2>
            
            <div class="grid grid-cols-1 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">API Key para QR</label>
                    <input type="text" name="qr_api_key" value="<?= htmlspecialchars($config['qr_api_key'] ?? '') ?>"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-primary focus:border-primary"
                           placeholder="Tu API Key para generar códigos QR">
                    <p class="mt-1 text-xs text-gray-500">Puedes usar servicios como api.qrserver.com o quickchart.io</p>
                </div>
            </div>
        </div>
        
        <!-- Configuraciones Globales -->
        <div class="bg-white rounded-lg shadow-lg p-6">
            <h2 class="text-xl font-bold mb-4 flex items-center">
                <i class="fas fa-sliders-h text-primary mr-2"></i>
                Configuraciones Globales
            </h2>
            
            <div class="space-y-4">
                <div class="flex items-center">
                    <input type="checkbox" name="enable_notifications" id="enable_notifications" 
                           <?= ($config['enable_notifications'] ?? '1') === '1' ? 'checked' : '' ?>
                           class="h-4 w-4 text-primary focus:ring-primary border-gray-300 rounded">
                    <label for="enable_notifications" class="ml-2 block text-sm text-gray-700">
                        Habilitar sistema de notificaciones
                    </label>
                </div>
            </div>
        </div>
        
        <!-- Botones de Acción -->
        <div class="flex justify-end space-x-4">
            <a href="<?= BASE_URL ?>/dashboard" class="px-6 py-2 border border-gray-300 rounded-lg hover:bg-gray-50">
                Cancelar
            </a>
            <button type="submit" name="submit" class="px-6 py-2 bg-primary text-white rounded-lg hover:bg-secondary">
                <i class="fas fa-save mr-2"></i>Guardar Configuración
            </button>
        </div>
    </div>
</form>

</main>
</div>
