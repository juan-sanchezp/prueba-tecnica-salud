-- Crear base de datos
CREATE DATABASE IF NOT EXISTS Desarrollo;
USE Desarrollo;

-- Tabla PACIENTES
CREATE TABLE pacientes (
    id_paciente INT PRIMARY KEY AUTO_INCREMENT,
    nombre_paciente VARCHAR(100) NOT NULL,
    apellido_paciente VARCHAR(100) NOT NULL,
    documento VARCHAR(20) UNIQUE,
    telefono VARCHAR(20),
    email VARCHAR(100),
    direccion TEXT
);

-- Tabla MEDICOS
CREATE TABLE medicos (
    id_medico INT PRIMARY KEY AUTO_INCREMENT,
    nombre_medico VARCHAR(100) NOT NULL,
    especialidad_consulta VARCHAR(100) NOT NULL,
    telefono VARCHAR(20),
    email VARCHAR(100)
);

-- Tabla CITAS_MEDICAS
CREATE TABLE citas_medicas (
    id_cita INT PRIMARY KEY AUTO_INCREMENT,
    id_paciente INT NOT NULL,
    id_medico INT NOT NULL,
    fecha_cita DATE NOT NULL,
    hora_cita TIME NOT NULL,
    estado_cita ENUM('Programada', 'Atendida', 'Cancelada') DEFAULT 'Programada',
    valor_cita DECIMAL(10,2) NOT NULL,
    observaciones TEXT,
    FOREIGN KEY (id_paciente) REFERENCES pacientes(id_paciente) ON DELETE CASCADE,
    FOREIGN KEY (id_medico) REFERENCES medicos(id_medico) ON DELETE CASCADE,
    INDEX idx_fecha_cita (fecha_cita)
);

-- Tabla FACTURA
CREATE TABLE factura (
    id_factura INT PRIMARY KEY AUTO_INCREMENT,
    id_cita INT NOT NULL,
    fecha_factura DATETIME NOT NULL,
    subtotal DECIMAL(10,2) NOT NULL,
    iva DECIMAL(10,2) NOT NULL,
    total DECIMAL(10,2) NOT NULL,
    estado ENUM('Pendiente', 'Pagado', 'Anulado') DEFAULT 'Pendiente',
    FOREIGN KEY (id_cita) REFERENCES citas_medicas(id_cita) ON DELETE CASCADE
);

-- Tabla DETALLE_FACTURA
CREATE TABLE detalle_factura (
    id_detalle INT PRIMARY KEY AUTO_INCREMENT,
    id_factura INT NOT NULL,
    concepto VARCHAR(200) NOT NULL,
    cantidad INT NOT NULL,
    valor_unitario DECIMAL(10,2) NOT NULL,
    valor_total DECIMAL(10,2) NOT NULL,
    FOREIGN KEY (id_factura) REFERENCES factura(id_factura) ON DELETE CASCADE
);

-- Insertar datos de prueba
INSERT INTO pacientes (nombre_paciente, apellido_paciente, documento, telefono) VALUES
('Juan', 'Pérez', '12345678', '3001234567'),
('María', 'Gómez', '87654321', '3007654321'),
('Carlos', 'López', '11223344', '3009988776');

INSERT INTO medicos (nombre_medico, especialidad_consulta, telefono) VALUES
('Dr. Roberto Martínez', 'Cardiología', '3111234567'),
('Dra. Ana Rodríguez', 'Pediatría', '3117654321'),
('Dr. Luis Sánchez', 'Dermatología', '3119988776');

INSERT INTO citas_medicas (id_paciente, id_medico, fecha_cita, hora_cita, estado_cita, valor_cita) VALUES
(1, 1, '2012-05-15', '09:00:00', 'Programada', 150000),
(2, 2, '2012-05-15', '10:30:00', 'Programada', 120000),
(3, 3, '2012-05-15', '14:00:00', 'Atendida', 180000),
(1, 2, '2012-05-16', '11:00:00', 'Cancelada', 120000);

INSERT INTO factura (id_cita, fecha_factura, subtotal, iva, total, estado) VALUES
(1, '2012-05-15 09:30:00', 150000, 28500, 178500, 'Pagado'),
(2, '2012-05-15 11:00:00', 120000, 22800, 142800, 'Pendiente'),
(3, '2012-05-15 15:30:00', 180000, 34200, 214200, 'Pagado');

INSERT INTO detalle_factura (id_factura, concepto, cantidad, valor_unitario, valor_total) VALUES
(1, 'Consulta Cardiología', 1, 150000, 150000),
(2, 'Consulta Pediatría', 1, 120000, 120000),
(3, 'Consulta Dermatología', 1, 180000, 180000);