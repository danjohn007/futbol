# FutbolManager - Sistema Online de Organización de Torneos de Fútbol

Sistema integral de gestión de torneos de fútbol desarrollado con PHP puro, MySQL y Tailwind CSS.

## 🎯 Características Principales

- **Gestión de Torneos**: Crear y administrar torneos de liga, eliminatoria o formato mixto
- **Sedes y Canchas**: Administración de múltiples sedes con sus respectivas canchas
- **Equipos y Jugadores**: Registro de equipos, plantillas y estadísticas de jugadores
- **Calendario de Partidos**: Programación automática y manual de partidos con fixture
- **Resultados en Tiempo Real**: Registro de marcadores, goles, tarjetas e incidencias
- **Tablas de Posiciones**: Actualización automática de estadísticas y clasificaciones
- **Sistema de Roles**: 7 roles de usuario con permisos específicos
- **Panel de Configuración**: Personalización completa del sistema
- **Diseño Responsivo**: Interfaz moderna con Tailwind CSS

## 🔐 Roles de Usuario

1. **SUPERADMIN**: Control total del sistema
2. **ADMIN_SEDE**: Gestión de canchas, horarios y partidos de su sede
3. **ORGANIZADOR**: Creación y gestión de torneos
4. **DELEGADO**: Registro de equipos y jugadores
5. **ARBITRO**: Registro de resultados y tarjetas
6. **JUGADOR**: Consulta de estadísticas personales
7. **AFICIONADO**: Consulta pública de resultados

## 📋 Requisitos del Sistema

- PHP 7.4 o superior
- MySQL 5.7 o superior
- Apache con mod_rewrite habilitado
- Extensiones PHP requeridas:
  - PDO
  - pdo_mysql
  - mbstring
  - json
  - session

## 🚀 Instalación

### 1. Clonar o descargar el repositorio

```bash
git clone https://github.com/danjohn007/futbol.git
cd futbol
```

### 2. Configurar la base de datos

Editar el archivo `config/config.php` y actualizar las credenciales de la base de datos:

```php
define('DB_HOST', 'localhost');
define('DB_NAME', 'futbol_torneos');
define('DB_USER', 'root');
define('DB_PASS', '');
```

### 3. Crear la base de datos

Ejecutar los siguientes archivos SQL en orden:

```bash
# 1. Crear la estructura de la base de datos
mysql -u root -p < database/schema.sql

# 2. Insertar datos de ejemplo de Querétaro
mysql -u root -p < database/sample_data.sql
```

O desde phpMyAdmin:
1. Crear una base de datos llamada `futbol_torneos`
2. Importar el archivo `database/schema.sql`
3. Importar el archivo `database/sample_data.sql`

### 4. Configurar permisos

```bash
# En Linux/Mac
chmod -R 755 public/uploads
chown -R www-data:www-data public/uploads

# O desde tu servidor web, asegúrate de que el directorio public/uploads tenga permisos de escritura
```

### 5. Configurar Apache

El sistema incluye un archivo `.htaccess` que configura automáticamente la URL base. Asegúrate de que:

1. `mod_rewrite` esté habilitado en Apache
2. `AllowOverride All` esté configurado en la configuración de Apache
3. El directorio del proyecto sea accesible desde tu servidor web

Para habilitar mod_rewrite en Ubuntu/Debian:
```bash
sudo a2enmod rewrite
sudo systemctl restart apache2
```

### 6. Acceder al sistema

Abre tu navegador y accede a:

```
http://localhost/futbol/
```

O si instalaste en un subdirectorio:

```
http://localhost/subdirectorio/futbol/
```

El sistema detectará automáticamente la URL base.

### 7. Verificar instalación

Visita la página de prueba de conexión:

```
http://localhost/futbol/test_connection.php
```

Esta página verificará:
- URL base detectada correctamente
- Conexión a la base de datos
- Permisos de escritura
- Extensiones PHP requeridas

## 👤 Usuarios de Prueba

El sistema incluye usuarios de prueba con datos del estado de Querétaro:

| Email | Contraseña | Rol |
|-------|-----------|-----|
| admin@futbolmanager.com | admin123 | SUPERADMIN |
| organizador@queretaro.com | admin123 | ORGANIZADOR |
| admin.centro@queretaro.com | admin123 | ADMIN_SEDE |
| arbitro1@queretaro.com | admin123 | ARBITRO |

## 📁 Estructura del Proyecto

```
futbol/
├── app/
│   ├── controllers/     # Controladores MVC
│   ├── models/         # Modelos de datos
│   ├── views/          # Vistas y plantillas
│   └── core/           # Clases base del framework
├── config/             # Archivos de configuración
│   ├── config.php      # Configuración principal
│   └── database.php    # Conexión a BD
├── database/           # Scripts SQL
│   ├── schema.sql      # Estructura de BD
│   └── sample_data.sql # Datos de ejemplo
├── public/             # Archivos públicos
│   ├── css/           # Estilos personalizados
│   ├── js/            # JavaScript
│   ├── images/        # Imágenes
│   └── uploads/       # Archivos subidos
├── .htaccess          # Configuración Apache
├── index.php          # Punto de entrada
├── test_connection.php # Test de conexión
└── README.md          # Este archivo
```

## 🎨 Tecnologías Utilizadas

- **Backend**: PHP 7.4+ (sin framework)
- **Base de Datos**: MySQL 5.7
- **Frontend**: 
  - HTML5
  - Tailwind CSS 3.x (CDN)
  - Font Awesome 6.x
  - JavaScript Vanilla
- **Arquitectura**: MVC (Model-View-Controller)
- **Seguridad**: 
  - Password hashing con bcrypt
  - Prepared statements (PDO)
  - Sanitización de inputs
  - Protección CSRF

## 📚 Módulos Implementados

### ✅ Fase 1 - Infraestructura Core
- [x] Estructura MVC
- [x] Sistema de rutas amigables
- [x] Autodetección de URL base
- [x] Conexión a base de datos
- [x] Autoloader de clases

### ✅ Fase 2 - Autenticación y Usuarios
- [x] Sistema de login/logout
- [x] Registro de usuarios
- [x] Gestión de sesiones
- [x] Sistema de roles y permisos

### ✅ Fase 3 - Base de Datos
- [x] Schema completo con 20+ tablas
- [x] Datos de ejemplo de Querétaro
- [x] Relaciones y índices optimizados

### ✅ Fase 4 - Interfaz Base
- [x] Layout responsivo con Tailwind CSS
- [x] Página de inicio pública
- [x] Dashboard por roles
- [x] Sidebar de navegación
- [x] Sistema de mensajes flash

## 🔧 Configuración del Sistema

Una vez dentro del sistema como SUPERADMIN, accede a **Configuración** para personalizar:

- Nombre del sitio y logo
- Colores del tema
- Información de contacto
- Configuración de correo (SMTP)
- Integración con PayPal
- API para códigos QR
- Horarios de atención

## 🚧 Próximos Módulos a Desarrollar

- Gestión completa de Torneos (CRUD)
- Gestión de Sedes y Canchas
- Gestión de Equipos y Jugadores
- Generación automática de fixture
- Registro de partidos y resultados
- Tablas de posiciones en tiempo real
- Estadísticas y gráficas
- Sistema de notificaciones
- Exportación de reportes (PDF/Excel)
- Integración con FullCalendar.js
- Integración con Google Maps
- Sistema de pagos con PayPal

## 🐛 Solución de Problemas

### Error de conexión a la base de datos
- Verifica las credenciales en `config/config.php`
- Asegúrate de que MySQL esté corriendo
- Verifica que la base de datos `futbol_torneos` exista

### URLs no funcionan (404)
- Verifica que mod_rewrite esté habilitado
- Verifica que `.htaccess` exista en la raíz
- Verifica permisos del archivo `.htaccess`
- El `.htaccess` está configurado para detectar automáticamente la URL base
- Si instalaste en un subdirectorio y sigues teniendo 404, verifica que AllowOverride esté en All
- Si necesitas forzar una base específica, edita `.htaccess` y descomenta la línea `RewriteBase`

### Error al subir archivos
- Verifica permisos del directorio `public/uploads`
- Verifica configuración de `upload_max_filesize` en php.ini

### Página en blanco
- Activa el modo debug en `config/config.php`: `define('DEBUG_MODE', true);`
- Revisa los logs de error de Apache/PHP

## 📝 Licencia

Este proyecto es de código abierto y está disponible bajo la licencia MIT.

## 👥 Contribuciones

Las contribuciones son bienvenidas. Por favor:

1. Fork el proyecto
2. Crea una rama para tu característica (`git checkout -b feature/AmazingFeature`)
3. Commit tus cambios (`git commit -m 'Add some AmazingFeature'`)
4. Push a la rama (`git push origin feature/AmazingFeature`)
5. Abre un Pull Request

## 📞 Soporte

Para soporte o preguntas, contacta a través de:
- Email: contacto@futbolmanager.com
- Issues en GitHub

---

Desarrollado con ❤️ para la comunidad futbolera
