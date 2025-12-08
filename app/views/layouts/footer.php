    <!-- Footer -->
    <footer class="bg-gray-800 text-white mt-auto py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div>
                    <h3 class="text-lg font-bold mb-2"><?= $config['site_name'] ?? 'FutbolManager' ?></h3>
                    <p class="text-gray-400">Sistema de gestión de torneos de fútbol</p>
                </div>
                <div>
                    <h3 class="text-lg font-bold mb-2">Contacto</h3>
                    <p class="text-gray-400">
                        <i class="fas fa-envelope mr-2"></i><?= $config['contact_email'] ?? 'contacto@futbolmanager.com' ?>
                    </p>
                    <p class="text-gray-400">
                        <i class="fas fa-phone mr-2"></i><?= $config['contact_phone'] ?? '442-123-4567' ?>
                    </p>
                </div>
                <div>
                    <h3 class="text-lg font-bold mb-2">Horario</h3>
                    <p class="text-gray-400"><?= $config['business_hours'] ?? 'Lunes a Viernes: 9:00 AM - 6:00 PM' ?></p>
                </div>
            </div>
            <div class="border-t border-gray-700 mt-6 pt-6 text-center text-gray-400">
                <p>&copy; <?= date('Y') ?> <?= $config['site_name'] ?? 'FutbolManager' ?>. Todos los derechos reservados.</p>
            </div>
        </div>
    </footer>
</body>
</html>
