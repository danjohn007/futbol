<?php
/**
 * Punto de entrada principal del sistema
 */

// Iniciar sesión
session_start();

// Cargar configuración
require_once 'config/config.php';
require_once 'config/database.php';

// Cargar el router
require_once APP_PATH . '/core/Router.php';

// Iniciar la aplicación
new Router();
