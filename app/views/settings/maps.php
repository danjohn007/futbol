<!-- Google Maps API Configuration Section -->
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
