DROP TABLE IF EXISTS estancias;
DROP TABLE IF EXISTS hoteles;
DROP TABLE IF EXISTS clientes;
CREATE TABLE clientes(
    id int AUTO_INCREMENT PRIMARY KEY,
    apellidos varchar(90) NOT NULL,
    nombre varchar(20) NOT NULL,
    email varchar(90) UNIQUE NOT NULL
);
CREATE TABLE hoteles(
    id int AUTO_INCREMENT PRIMARY KEY,
    nombre varchar(80) UNIQUE NOT NULL,
    localidad varchar(100) NOT NULL,
    direccion varchar(100) NOT NULL
);

CREATE TABLE estancias(
    id int AUTO_INCREMENT PRIMARY KEY,
    cliente_id int,
    hotel_id int,
    fecha_entrada datetime DEFAULT CURRENT_TIMESTAMP,
    fecha_salida date,
    CONSTRAINT estancia_cliente FOREIGN KEY(cliente_id) REFERENCES clientes(id) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT estancia_hotel FOREIGN KEY(hotel_id) REFERENCES hoteles(id) ON DELETE CASCADE ON UPDATE CASCADE
);