<?php
/**
 * Autoloader para cargar clases automáticamente
 */
class Autoloader {
    public static function register() {
        spl_autoload_register([__CLASS__, 'autoload']);
    }
    
    private static function autoload($className) {
        $paths = [
            APP_PATH . '/core/' . $className . '.php',
            APP_PATH . '/controllers/' . $className . '.php',
            APP_PATH . '/models/' . $className . '.php',
        ];
        
        foreach ($paths as $path) {
            if (file_exists($path)) {
                require_once $path;
                return;
            }
        }
    }
}

Autoloader::register();
