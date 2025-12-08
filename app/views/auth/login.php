<div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8">
        <div>
            <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
                Iniciar Sesión
            </h2>
            <p class="mt-2 text-center text-sm text-gray-600">
                Accede a tu cuenta para gestionar torneos
            </p>
        </div>
        
        <?php if (isset($error)): ?>
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
            <span class="block sm:inline"><?= $error ?></span>
        </div>
        <?php endif; ?>
        
        <form class="mt-8 space-y-6" method="POST" action="<?= BASE_URL ?>/auth/login">
            <div class="rounded-md shadow-sm -space-y-px">
                <div>
                    <label for="email" class="sr-only">Email</label>
                    <input id="email" name="email" type="email" required 
                           class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-primary focus:border-primary focus:z-10 sm:text-sm" 
                           placeholder="Correo electrónico">
                </div>
                <div>
                    <label for="password" class="sr-only">Contraseña</label>
                    <input id="password" name="password" type="password" required 
                           class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:ring-primary focus:border-primary focus:z-10 sm:text-sm" 
                           placeholder="Contraseña">
                </div>
            </div>
            
            <div>
                <button type="submit" 
                        class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-primary hover:bg-secondary focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary">
                    <i class="fas fa-sign-in-alt mr-2"></i>
                    Iniciar Sesión
                </button>
            </div>
            
            <div class="text-center">
                <p class="text-sm text-gray-600">
                    ¿No tienes cuenta? 
                    <a href="<?= BASE_URL ?>/auth/register" class="font-medium text-primary hover:text-secondary">
                        Regístrate aquí
                    </a>
                </p>
            </div>
        </form>
        
        <div class="mt-6 p-4 bg-blue-50 rounded-lg">
            <h3 class="text-sm font-semibold text-gray-700 mb-2">Usuarios de prueba:</h3>
            <div class="text-xs text-gray-600 space-y-1">
                <p><strong>Admin:</strong> admin@futbolmanager.com / admin123</p>
                <p><strong>Organizador:</strong> organizador@queretaro.com / admin123</p>
                <p><strong>Admin Sede:</strong> admin.centro@queretaro.com / admin123</p>
                <p><strong>Árbitro:</strong> arbitro1@queretaro.com / admin123</p>
            </div>
        </div>
    </div>
</div>
