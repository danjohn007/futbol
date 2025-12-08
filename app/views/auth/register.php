<div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8">
        <div>
            <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
                Crear Cuenta
            </h2>
            <p class="mt-2 text-center text-sm text-gray-600">
                Regístrate para seguir tus torneos favoritos
            </p>
        </div>
        
        <?php if (!empty($errors)): ?>
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
            <ul class="list-disc list-inside">
                <?php foreach ($errors as $error): ?>
                    <li><?= $error ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
        <?php endif; ?>
        
        <form class="mt-8 space-y-6" method="POST" action="<?= BASE_URL ?>/auth/register">
            <div class="space-y-4">
                <div>
                    <label for="nombre" class="block text-sm font-medium text-gray-700">Nombre *</label>
                    <input id="nombre" name="nombre" type="text" required 
                           class="mt-1 appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-primary focus:border-primary sm:text-sm"
                           value="<?= $_POST['nombre'] ?? '' ?>">
                </div>
                
                <div>
                    <label for="apellidos" class="block text-sm font-medium text-gray-700">Apellidos</label>
                    <input id="apellidos" name="apellidos" type="text" 
                           class="mt-1 appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-primary focus:border-primary sm:text-sm"
                           value="<?= $_POST['apellidos'] ?? '' ?>">
                </div>
                
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Email *</label>
                    <input id="email" name="email" type="email" required 
                           class="mt-1 appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-primary focus:border-primary sm:text-sm"
                           value="<?= $_POST['email'] ?? '' ?>">
                </div>
                
                <div>
                    <label for="telefono" class="block text-sm font-medium text-gray-700">Teléfono</label>
                    <input id="telefono" name="telefono" type="tel" 
                           class="mt-1 appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-primary focus:border-primary sm:text-sm"
                           value="<?= $_POST['telefono'] ?? '' ?>">
                </div>
                
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700">Contraseña *</label>
                    <input id="password" name="password" type="password" required 
                           class="mt-1 appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-primary focus:border-primary sm:text-sm">
                    <p class="mt-1 text-xs text-gray-500">Mínimo 6 caracteres</p>
                </div>
                
                <div>
                    <label for="confirm_password" class="block text-sm font-medium text-gray-700">Confirmar Contraseña *</label>
                    <input id="confirm_password" name="confirm_password" type="password" required 
                           class="mt-1 appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-primary focus:border-primary sm:text-sm">
                </div>
            </div>
            
            <div>
                <button type="submit" 
                        class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-primary hover:bg-secondary focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary">
                    <i class="fas fa-user-plus mr-2"></i>
                    Registrarse
                </button>
            </div>
            
            <div class="text-center">
                <p class="text-sm text-gray-600">
                    ¿Ya tienes cuenta? 
                    <a href="<?= BASE_URL ?>/auth/login" class="font-medium text-primary hover:text-secondary">
                        Inicia sesión aquí
                    </a>
                </p>
            </div>
        </form>
    </div>
</div>
