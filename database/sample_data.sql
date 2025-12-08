-- Datos de ejemplo del estado de Querétaro
USE futbol_torneos;

-- Insertar roles
INSERT INTO roles (nombre, descripcion) VALUES
('SUPERADMIN', 'Administrador general del sistema con todos los permisos'),
('ADMIN_SEDE', 'Administrador de una sede específica'),
('ORGANIZADOR', 'Organizador de torneos'),
('DELEGADO', 'Director técnico o delegado de equipo'),
('ARBITRO', 'Árbitro de partidos'),
('JUGADOR', 'Jugador de equipo'),
('AFICIONADO', 'Aficionado o invitado del sistema');

-- Insertar usuario superadmin (password: admin123)
INSERT INTO usuarios (email, password, nombre, apellidos, telefono, rol_id, email_verificado, activo) VALUES
('admin@futbolmanager.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Administrador', 'Sistema', '4421234567', 1, TRUE, TRUE),
('organizador@queretaro.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Carlos', 'Ramírez', '4421234568', 3, TRUE, TRUE),
('admin.centro@queretaro.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'María', 'González', '4421234569', 2, TRUE, TRUE),
('arbitro1@queretaro.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Pedro', 'Martínez', '4421234570', 5, TRUE, TRUE);

-- Insertar sedes en Querétaro
INSERT INTO sedes (nombre, direccion, ciudad, estado, codigo_postal, telefono, email, latitud, longitud) VALUES
('Unidad Deportiva Querétaro', 'Av. 5 de Febrero s/n, Col. Centro', 'Santiago de Querétaro', 'Querétaro', '76000', '4422123456', 'contacto@udqueretaro.com', 20.5888, -100.3899),
('Complejo Deportivo El Marqués', 'Carretera a Chichimequillas Km 5', 'El Marqués', 'Querétaro', '76240', '4422123457', 'info@deportivomarques.com', 20.6864, -100.2736),
('Centro Deportivo Juriquilla', 'Anillo Vial Fray Junípero Serra', 'Querétaro', 'Querétaro', '76230', '4422123458', 'contacto@juriquilladep.com', 20.7097, -100.4472),
('Estadio Corregidora', 'Av. de las Torres, Col. La Era', 'Santiago de Querétaro', 'Querétaro', '76030', '4422123459', 'estadio@corregidora.com', 20.6244, -100.4254);

-- Insertar canchas
INSERT INTO canchas (sede_id, nombre, tipo, superficie, capacidad, techada) VALUES
-- Unidad Deportiva Querétaro
(1, 'Cancha Principal', 'Fútbol 11', 'Pasto natural', 2000, FALSE),
(1, 'Cancha 2', 'Fútbol 7', 'Pasto sintético', 500, FALSE),
(1, 'Cancha Rápido 1', 'Fútbol 5', 'Pasto sintético', 200, TRUE),
(1, 'Cancha Rápido 2', 'Fútbol 5', 'Pasto sintético', 200, TRUE),
-- Complejo Deportivo El Marqués
(2, 'Campo Norte', 'Fútbol 11', 'Pasto natural', 1500, FALSE),
(2, 'Campo Sur', 'Fútbol 11', 'Pasto natural', 1500, FALSE),
(2, 'Cancha 7 vs 7', 'Fútbol 7', 'Pasto sintético', 400, FALSE),
-- Centro Deportivo Juriquilla
(3, 'Cancha Premier', 'Fútbol 11', 'Pasto sintético', 1000, FALSE),
(3, 'Cancha Express 1', 'Fútbol 5', 'Pasto sintético', 150, TRUE),
(3, 'Cancha Express 2', 'Fútbol 5', 'Pasto sintético', 150, TRUE),
-- Estadio Corregidora
(4, 'Estadio Principal', 'Fútbol 11', 'Pasto natural', 33000, FALSE);

-- Asignar administrador a sede
INSERT INTO admin_sede (usuario_id, sede_id) VALUES
(3, 1); -- María González administra la Unidad Deportiva Querétaro

-- Insertar categorías
INSERT INTO categorias (nombre, descripcion, edad_minima, edad_maxima, genero) VALUES
('Sub-13 Varonil', 'Categoría para niños de 11 a 13 años', 11, 13, 'MASCULINO'),
('Sub-15 Varonil', 'Categoría para jóvenes de 13 a 15 años', 13, 15, 'MASCULINO'),
('Sub-17 Varonil', 'Categoría para jóvenes de 15 a 17 años', 15, 17, 'MASCULINO'),
('Libre Varonil', 'Categoría abierta para adultos', 18, NULL, 'MASCULINO'),
('Veteranos', 'Categoría para mayores de 35 años', 35, NULL, 'MASCULINO'),
('Femenil Libre', 'Categoría abierta femenil', 16, NULL, 'FEMENINO'),
('Mixto Recreativo', 'Categoría mixta recreativa', 16, NULL, 'MIXTO');

-- Insertar torneos
INSERT INTO torneos (nombre, descripcion, tipo, categoria_id, sede_id, organizador_id, fecha_inicio, fecha_fin, num_equipos, status) VALUES
('Liga Queretana Primavera 2025', 'Torneo de liga regular categoría libre', 'LIGA', 4, 1, 2, '2025-03-01', '2025-06-30', 16, 'INSCRIPCIONES'),
('Copa El Marqués 2025', 'Torneo eliminatorio en el complejo El Marqués', 'ELIMINATORIA', 4, 2, 2, '2025-04-15', '2025-05-30', 8, 'INSCRIPCIONES'),
('Torneo Infantil Sub-13', 'Torneo de formación para niños', 'LIGA', 1, 3, 2, '2025-03-15', '2025-07-15', 12, 'INSCRIPCIONES');

-- Insertar equipos
INSERT INTO equipos (nombre, logo, color_primario, color_secundario, delegado_id, telefono, email) VALUES
('Gallos Blancos FC', NULL, '#0033A0', '#FFFFFF', 2, '4421111111', 'gallos@queretaro.com'),
('Águilas de Querétaro', NULL, '#FF0000', '#FFFF00', 2, '4421111112', 'aguilas@queretaro.com'),
('Toros del Norte', NULL, '#000000', '#C0C0C0', 2, '4421111113', 'toros@queretaro.com'),
('Halcones FC', NULL, '#008000', '#FFFFFF', 2, '4421111114', 'halcones@queretaro.com'),
('Leones de El Marqués', NULL, '#FFA500', '#000000', 2, '4421111115', 'leones@marques.com'),
('Tigres Juriquilla', NULL, '#FFD700', '#000000', 2, '4421111116', 'tigres@juriquilla.com'),
('Pumas Centro', NULL, '#003366', '#FFD700', 2, '4421111117', 'pumas@centro.com'),
('Lobos Querétaro', NULL, '#808080', '#000000', 2, '4421111118', 'lobos@queretaro.com');

-- Inscribir equipos a torneos
INSERT INTO inscripciones (torneo_id, equipo_id, status, grupo) VALUES
(1, 1, 'APROBADO', 'A'),
(1, 2, 'APROBADO', 'A'),
(1, 3, 'APROBADO', 'A'),
(1, 4, 'APROBADO', 'A'),
(1, 5, 'APROBADO', 'B'),
(1, 6, 'APROBADO', 'B'),
(1, 7, 'APROBADO', 'B'),
(1, 8, 'APROBADO', 'B');

-- Insertar jugadores de ejemplo
INSERT INTO jugadores (nombre, apellidos, fecha_nacimiento, numero_camisa, posicion) VALUES
-- Gallos Blancos FC
('Juan', 'Pérez García', '1995-05-15', 1, 'Portero'),
('Luis', 'Hernández Soto', '1997-08-20', 10, 'Delantero'),
('Miguel', 'Rodríguez Cruz', '1996-03-10', 7, 'Mediocampista'),
('Carlos', 'López Medina', '1998-11-25', 4, 'Defensa'),
-- Águilas de Querétaro
('Roberto', 'Martínez Luna', '1994-07-08', 9, 'Delantero'),
('Fernando', 'Sánchez Villa', '1996-12-30', 8, 'Mediocampista'),
('Diego', 'Ramírez Flores', '1995-09-14', 2, 'Defensa'),
('Antonio', 'González Ortiz', '1997-04-22', 1, 'Portero');

-- Asignar jugadores a equipos
INSERT INTO plantilla (equipo_id, jugador_id, fecha_alta, status) VALUES
(1, 1, '2025-02-01', 'ACTIVO'),
(1, 2, '2025-02-01', 'ACTIVO'),
(1, 3, '2025-02-01', 'ACTIVO'),
(1, 4, '2025-02-01', 'ACTIVO'),
(2, 5, '2025-02-01', 'ACTIVO'),
(2, 6, '2025-02-01', 'ACTIVO'),
(2, 7, '2025-02-01', 'ACTIVO'),
(2, 8, '2025-02-01', 'ACTIVO');

-- Insertar configuraciones del sistema
INSERT INTO configuracion (clave, valor, tipo, descripcion) VALUES
('site_name', 'FutbolManager Querétaro', 'text', 'Nombre del sitio web'),
('site_logo', '', 'file', 'Logo del sitio'),
('contact_email', 'contacto@futbolmanager.com', 'text', 'Correo electrónico de contacto'),
('contact_phone', '442-123-4567', 'text', 'Teléfono de contacto'),
('business_hours', 'Lunes a Viernes: 9:00 AM - 6:00 PM', 'text', 'Horario de atención'),
('primary_color', '#3B82F6', 'color', 'Color principal del sistema'),
('secondary_color', '#1E40AF', 'color', 'Color secundario del sistema'),
('paypal_email', '', 'text', 'Cuenta de PayPal principal'),
('paypal_mode', 'sandbox', 'text', 'Modo de PayPal (sandbox/live)'),
('smtp_host', 'smtp.gmail.com', 'text', 'Servidor SMTP'),
('smtp_port', '587', 'number', 'Puerto SMTP'),
('smtp_user', '', 'text', 'Usuario SMTP'),
('smtp_pass', '', 'text', 'Contraseña SMTP'),
('enable_notifications', '1', 'boolean', 'Habilitar notificaciones'),
('qr_api_key', '', 'text', 'API Key para generación de QR'),
('google_maps_api_key', '', 'text', 'API Key de Google Maps');

-- Inicializar tabla de posiciones para el torneo 1
INSERT INTO tabla_posiciones (torneo_id, equipo_id) VALUES
(1, 1), (1, 2), (1, 3), (1, 4), (1, 5), (1, 6), (1, 7), (1, 8);
