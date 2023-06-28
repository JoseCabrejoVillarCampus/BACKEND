# Quiz PHP, DB,PDO

[Descripción del proyecto]

En este proyecto, estamos creando los metodos CRUD para la base de datos campusland, que crearemos por consola.

Aplicamos PHP y conectamos mediante composer los archivos.

[Advertencia]

Fue necesario ejecutar el archivo desde un host virtual, debido a problemas de servidor local del equipo

CREACION DE LA BASE DE DATOS

Usamos el  comando CREATE DATABASE campuslands; -> para crear la base de datos

Usamos el comando USE campuslands-> para accceder a la base de datos;

Para crear la tabla pais :

mysql> CREATE TABLE pais(
    -> idPais int(20),
    -> nombrePais int(20),
    -> CONSTRAINT pk_pais PRIMARY KEY pais(idPais)
    -> );

Para crear la tabla departamento :

CREATE TABLE departamento(
    -> idDep int(20),
    -> nombreDep varchar(20),
    -> CONSTRAINT pk_departamento PRIMARY KEY departamento(idDep)
    -> );

Para crear la tabla region :

CREATE TABLE region(
    -> idReg int(20),
    -> nombreReg varchar(60),
    -> idDep int(20),
    -> CONSTRAINT pk_region PRIMARY KEY region(idReg)
    -> );

Para crear la tabla campers :

CREATE TABLE campers(
    -> idCamper int(20),
    -> nombreCamper varchar(50),
    -> apellidoCamper varchar(50),
    -> fechaNac date,
    -> idReg int(20),
    -> CONSTRAINT pk_camper PRIMARY KEY camper(idCamper)
    -> );

Agregamos la Foreign Key a las tablas:

ALTER TABLE campers
    -> ADD CONSTRAINT idCamper FOREIGN KEY (idReg) REFERENCES region(idReg);

ALTER TABLE region
    -> ADD CONSTRAINT idReg FOREIGN KEY (idDep) REFERENCES departamento(idDep);

ARREGLAMOS la tabla departamento:

ALTER TABLE departamento
    -> ADD COLUMN idPais int(20);

ALTER TABLE departamento
    -> ADD CONSTRAINT idDep FOREIGN KEY (idPais) REFERENCES pais(idPais);

Usamos DESCRIBE  -> para verificar que las tablas esten correctas

[Estado del proyecto]

Finalizado

[Características de la aplicación y demostración]

CRUD de 4 tablas para el consumo del front

[Acceso al proyecto]

Publico

[Tecnologías utilizadas]

PHP, HTML, CSS, JS, COMPOSER, MySQL, apache, thunder client

[Personas-Desarrolladores del Proyecto]

Jose Alberto Cabrejo Villar

[Grupo]

M1