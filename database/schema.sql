-- Base de datos para Sistema de Torneos de Fútbol
-- MySQL 5.7

DROP DATABASE IF EXISTS futbol_torneos;
CREATE DATABASE futbol_torneos CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE futbol_torneos;

-- Tabla de roles
CREATE TABLE roles (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(50) NOT NULL UNIQUE,
    descripcion TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- Tabla de usuarios
CREATE TABLE usuarios (
    id INT PRIMARY KEY AUTO_INCREMENT,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    nombre VARCHAR(100) NOT NULL,
    apellidos VARCHAR(100),
    telefono VARCHAR(20),
    foto VARCHAR(255),
    rol_id INT NOT NULL,
    email_verificado BOOLEAN DEFAULT FALSE,
    activo BOOLEAN DEFAULT TRUE,
    token_recuperacion VARCHAR(100),
    token_expiracion DATETIME,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (rol_id) REFERENCES roles(id),
    INDEX idx_email (email),
    INDEX idx_rol (rol_id)
) ENGINE=InnoDB;

-- Tabla de sedes
CREATE TABLE sedes (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(150) NOT NULL,
    direccion TEXT,
    ciudad VARCHAR(100),
    estado VARCHAR(100),
    codigo_postal VARCHAR(10),
    telefono VARCHAR(20),
    email VARCHAR(100),
    latitud DECIMAL(10, 8),
    longitud DECIMAL(11, 8),
    activo BOOLEAN DEFAULT TRUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_ciudad (ciudad),
    INDEX idx_estado (estado)
) ENGINE=InnoDB;

-- Tabla de canchas
CREATE TABLE canchas (
    id INT PRIMARY KEY AUTO_INCREMENT,
    sede_id INT NOT NULL,
    nombre VARCHAR(100) NOT NULL,
    tipo VARCHAR(50), -- Fútbol 11, 7, 5, Rápido
    superficie VARCHAR(50), -- Pasto natural, sintético, cemento
    capacidad INT,
    techada BOOLEAN DEFAULT FALSE,
    activo BOOLEAN DEFAULT TRUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (sede_id) REFERENCES sedes(id) ON DELETE CASCADE,
    INDEX idx_sede (sede_id)
) ENGINE=InnoDB;

-- Tabla de administradores de sede
CREATE TABLE admin_sede (
    id INT PRIMARY KEY AUTO_INCREMENT,
    usuario_id INT NOT NULL,
    sede_id INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id) ON DELETE CASCADE,
    FOREIGN KEY (sede_id) REFERENCES sedes(id) ON DELETE CASCADE,
    UNIQUE KEY unique_admin_sede (usuario_id, sede_id)
) ENGINE=InnoDB;

-- Tabla de categorías
CREATE TABLE categorias (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(100) NOT NULL,
    descripcion TEXT,
    edad_minima INT,
    edad_maxima INT,
    genero ENUM('MASCULINO', 'FEMENINO', 'MIXTO') DEFAULT 'MIXTO',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- Tabla de torneos
CREATE TABLE torneos (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(200) NOT NULL,
    descripcion TEXT,
    tipo ENUM('LIGA', 'ELIMINATORIA', 'MIXTO') DEFAULT 'LIGA',
    categoria_id INT,
    sede_id INT,
    organizador_id INT NOT NULL,
    fecha_inicio DATE,
    fecha_fin DATE,
    num_equipos INT DEFAULT 0,
    puntos_victoria INT DEFAULT 3,
    puntos_empate INT DEFAULT 1,
    puntos_derrota INT DEFAULT 0,
    status ENUM('INSCRIPCIONES', 'ACTIVO', 'FINALIZADO', 'CANCELADO') DEFAULT 'INSCRIPCIONES',
    publico BOOLEAN DEFAULT TRUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (categoria_id) REFERENCES categorias(id),
    FOREIGN KEY (sede_id) REFERENCES sedes(id),
    FOREIGN KEY (organizador_id) REFERENCES usuarios(id),
    INDEX idx_status (status),
    INDEX idx_fecha_inicio (fecha_inicio)
) ENGINE=InnoDB;

-- Tabla de equipos
CREATE TABLE equipos (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(150) NOT NULL,
    logo VARCHAR(255),
    color_primario VARCHAR(7),
    color_secundario VARCHAR(7),
    delegado_id INT NOT NULL,
    telefono VARCHAR(20),
    email VARCHAR(100),
    activo BOOLEAN DEFAULT TRUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (delegado_id) REFERENCES usuarios(id),
    INDEX idx_delegado (delegado_id)
) ENGINE=InnoDB;

-- Tabla de inscripciones de equipos a torneos
CREATE TABLE inscripciones (
    id INT PRIMARY KEY AUTO_INCREMENT,
    torneo_id INT NOT NULL,
    equipo_id INT NOT NULL,
    fecha_inscripcion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    status ENUM('PENDIENTE', 'APROBADO', 'RECHAZADO') DEFAULT 'PENDIENTE',
    grupo VARCHAR(10),
    FOREIGN KEY (torneo_id) REFERENCES torneos(id) ON DELETE CASCADE,
    FOREIGN KEY (equipo_id) REFERENCES equipos(id) ON DELETE CASCADE,
    UNIQUE KEY unique_inscripcion (torneo_id, equipo_id),
    INDEX idx_torneo (torneo_id),
    INDEX idx_equipo (equipo_id)
) ENGINE=InnoDB;

-- Tabla de jugadores
CREATE TABLE jugadores (
    id INT PRIMARY KEY AUTO_INCREMENT,
    usuario_id INT,
    nombre VARCHAR(100) NOT NULL,
    apellidos VARCHAR(100),
    fecha_nacimiento DATE,
    numero_camisa INT,
    posicion VARCHAR(50),
    foto VARCHAR(255),
    activo BOOLEAN DEFAULT TRUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id) ON DELETE SET NULL,
    INDEX idx_usuario (usuario_id)
) ENGINE=InnoDB;

-- Tabla de plantilla de jugadores por equipo
CREATE TABLE plantilla (
    id INT PRIMARY KEY AUTO_INCREMENT,
    equipo_id INT NOT NULL,
    jugador_id INT NOT NULL,
    fecha_alta DATE,
    fecha_baja DATE,
    status ENUM('ACTIVO', 'SUSPENDIDO', 'LESIONADO', 'BAJA') DEFAULT 'ACTIVO',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (equipo_id) REFERENCES equipos(id) ON DELETE CASCADE,
    FOREIGN KEY (jugador_id) REFERENCES jugadores(id) ON DELETE CASCADE,
    INDEX idx_equipo (equipo_id),
    INDEX idx_jugador (jugador_id)
) ENGINE=InnoDB;

-- Tabla de partidos
CREATE TABLE partidos (
    id INT PRIMARY KEY AUTO_INCREMENT,
    torneo_id INT NOT NULL,
    equipo_local_id INT NOT NULL,
    equipo_visitante_id INT NOT NULL,
    cancha_id INT,
    arbitro_id INT,
    fecha_hora DATETIME NOT NULL,
    jornada INT,
    fase VARCHAR(50), -- Grupo, Octavos, Cuartos, Semifinal, Final
    goles_local INT DEFAULT 0,
    goles_visitante INT DEFAULT 0,
    status ENUM('PROGRAMADO', 'EN_CURSO', 'FINALIZADO', 'SUSPENDIDO', 'POSPUESTO') DEFAULT 'PROGRAMADO',
    validado BOOLEAN DEFAULT FALSE,
    observaciones TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (torneo_id) REFERENCES torneos(id) ON DELETE CASCADE,
    FOREIGN KEY (equipo_local_id) REFERENCES equipos(id),
    FOREIGN KEY (equipo_visitante_id) REFERENCES equipos(id),
    FOREIGN KEY (cancha_id) REFERENCES canchas(id),
    FOREIGN KEY (arbitro_id) REFERENCES usuarios(id),
    INDEX idx_torneo (torneo_id),
    INDEX idx_fecha (fecha_hora),
    INDEX idx_status (status)
) ENGINE=InnoDB;

-- Tabla de goles
CREATE TABLE goles (
    id INT PRIMARY KEY AUTO_INCREMENT,
    partido_id INT NOT NULL,
    jugador_id INT NOT NULL,
    equipo_id INT NOT NULL,
    minuto INT,
    tipo ENUM('NORMAL', 'PENAL', 'AUTOGOL') DEFAULT 'NORMAL',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (partido_id) REFERENCES partidos(id) ON DELETE CASCADE,
    FOREIGN KEY (jugador_id) REFERENCES jugadores(id),
    FOREIGN KEY (equipo_id) REFERENCES equipos(id),
    INDEX idx_partido (partido_id),
    INDEX idx_jugador (jugador_id)
) ENGINE=InnoDB;

-- Tabla de tarjetas
CREATE TABLE tarjetas (
    id INT PRIMARY KEY AUTO_INCREMENT,
    partido_id INT NOT NULL,
    jugador_id INT NOT NULL,
    tipo ENUM('AMARILLA', 'ROJA') NOT NULL,
    minuto INT,
    motivo TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (partido_id) REFERENCES partidos(id) ON DELETE CASCADE,
    FOREIGN KEY (jugador_id) REFERENCES jugadores(id),
    INDEX idx_partido (partido_id),
    INDEX idx_jugador (jugador_id)
) ENGINE=InnoDB;

-- Tabla de incidencias
CREATE TABLE incidencias (
    id INT PRIMARY KEY AUTO_INCREMENT,
    partido_id INT NOT NULL,
    tipo VARCHAR(100),
    descripcion TEXT,
    minuto INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (partido_id) REFERENCES partidos(id) ON DELETE CASCADE,
    INDEX idx_partido (partido_id)
) ENGINE=InnoDB;

-- Tabla de tabla de posiciones
CREATE TABLE tabla_posiciones (
    id INT PRIMARY KEY AUTO_INCREMENT,
    torneo_id INT NOT NULL,
    equipo_id INT NOT NULL,
    partidos_jugados INT DEFAULT 0,
    partidos_ganados INT DEFAULT 0,
    partidos_empatados INT DEFAULT 0,
    partidos_perdidos INT DEFAULT 0,
    goles_favor INT DEFAULT 0,
    goles_contra INT DEFAULT 0,
    diferencia_goles INT DEFAULT 0,
    puntos INT DEFAULT 0,
    tarjetas_amarillas INT DEFAULT 0,
    tarjetas_rojas INT DEFAULT 0,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (torneo_id) REFERENCES torneos(id) ON DELETE CASCADE,
    FOREIGN KEY (equipo_id) REFERENCES equipos(id) ON DELETE CASCADE,
    UNIQUE KEY unique_tabla (torneo_id, equipo_id),
    INDEX idx_torneo (torneo_id),
    INDEX idx_puntos (puntos)
) ENGINE=InnoDB;

-- Tabla de configuración del sistema
CREATE TABLE configuracion (
    id INT PRIMARY KEY AUTO_INCREMENT,
    clave VARCHAR(100) NOT NULL UNIQUE,
    valor TEXT,
    tipo VARCHAR(50), -- text, number, boolean, color, file
    descripcion TEXT,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- Tabla de notificaciones
CREATE TABLE notificaciones (
    id INT PRIMARY KEY AUTO_INCREMENT,
    usuario_id INT NOT NULL,
    titulo VARCHAR(255) NOT NULL,
    mensaje TEXT,
    tipo VARCHAR(50), -- info, warning, success, error
    leida BOOLEAN DEFAULT FALSE,
    url VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id) ON DELETE CASCADE,
    INDEX idx_usuario (usuario_id),
    INDEX idx_leida (leida)
) ENGINE=InnoDB;

-- Tabla de actividad/logs
CREATE TABLE actividad (
    id INT PRIMARY KEY AUTO_INCREMENT,
    usuario_id INT,
    accion VARCHAR(100),
    tabla VARCHAR(100),
    registro_id INT,
    descripcion TEXT,
    ip_address VARCHAR(45),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id) ON DELETE SET NULL,
    INDEX idx_usuario (usuario_id),
    INDEX idx_created (created_at)
) ENGINE=InnoDB;
