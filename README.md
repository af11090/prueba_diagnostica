# PRUEBA DIAGNOSTICA DE PROGRAMACION


## Descripción
Sistema web para la gestión de empleados y recursos humanos desarrollado con Laravel.

## Características
- Gestión de empleados (CRUD)
- Filtrado por área, cargo y local
- Reportes estadísticos
- Diseño responsive

## Requisitos técnicos
- PHP 7.3
- Laravel 7
- MySQL 8.0
- Boostrapp 4.0
- Node.js y NPM para assets

## Instalación
1. Clonar el repositorio
configurar la base de datos
2. Los datos de prueba de las demas tablas se encuentran en seed y migración.
3. Ya esta compilado el framework de boostrapp no se necesita ejecutar otros comandos.
4. Ejecutar `composer intall`
5. Copiar `.env.example` a `.env` y configurar la base de datos
6. Genear la clave del proyecto `php artisan key:generate`
7. Ejecutar `php artisan migrate --seed`
8. Ejecutar `php artisan serve`

# Estructura del Proyecto

## Arquitectura MVC

El sistema sigue el patrón Modelo-Vista-Controlador de Laravel:

### Modelos
- `Empleado`: Representa los datos de un empleado
- `Contrato`: Gestiona la relación de contrato con un empleado
- `Area`, `Cargo`, `Local`: Representan las los datos empresariales

### Controladores
- `EmpleadoController`: Gestiona todas las operaciones CRUD de empleados y el registro del contrado como ademas de los filtros
- `AreaController`:
Se creo un método para
retornar las areas usando AJAX para el registro del contrato
de igual manera para `Cargo`.


### Vistas
- `/resources/views/empleado/`: Contiene las vistas para gestión de empleados
- `/resources/views/layout/`: Contiene la plantillas principal.
  - `plantilla.blade.php`: Layout principal con el navbar y estructura común
- `/resources/views/welcome`:
Index de la página.

### Otros
- Se uso una API gratuita para obtener los nombres de https://apisperu.com/
- Diagrama de base de datos
  https://github.com/af11090/prueba_diagnostica/blob/main/database/Diagram_DB.png
##### No se uso plugins
