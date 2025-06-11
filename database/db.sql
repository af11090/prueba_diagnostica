--script para base de datos mysql
create database dbEmpleados;
use dbEmpleados;

-- Tabla de empleados
CREATE TABLE empleados(
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL,
    apellido VARCHAR(50) NOT NULL,
    dni VARCHAR(8) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE,
    fecha_nacimiento DATE NOT NULL
);

-- Área de trabajo
CREATE TABLE areas(
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL UNIQUE,
    descripcion TEXT
);

-- Cargo de trabajo
CREATE TABLE cargos(
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL UNIQUE,
    descripcion TEXT
);

-- Local de trabajo
CREATE TABLE locales(
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL UNIQUE,
    direccion VARCHAR(100) NOT NULL
);

-- Tabla local_area (muchos a muchos)
CREATE TABLE local_area (
    id_local INT NOT NULL,
    id_area INT NOT NULL,
    PRIMARY KEY (id_local, id_area),
    FOREIGN KEY (id_local) REFERENCES locales(id),
    FOREIGN KEY (id_area) REFERENCES areas(id)
);

-- Tabla area_cargo (muchos a muchos)
CREATE TABLE area_cargo (
    id_area INT NOT NULL,
    id_cargo INT NOT NULL,
    PRIMARY KEY (id_area, id_cargo),
    FOREIGN KEY (id_area) REFERENCES areas(id),
    FOREIGN KEY (id_cargo) REFERENCES cargos(id)
);

-- Tabla de tipos de contrato
CREATE TABLE tipos_contrato(
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL UNIQUE,
    descripcion TEXT
);

CREATE TABLE contrato(
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    id_empleado INT NOT NULL,
    id_tipo_contrato INT NOT NULL,
    fecha_inicio DATE NOT NULL,
    fecha_fin DATE,
    estado ENUM('activo', 'inactivo') NOT NULL DEFAULT 'activo',
    FOREIGN KEY (id_empleado) REFERENCES empleados(id),
    FOREIGN KEY (id_tipo_contrato) REFERENCES tipos_contrato(id)
);

