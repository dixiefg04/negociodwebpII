use nwdb
CREATE TABLE carros(  
    id int NOT NULL PRIMARY KEY AUTO_INCREMENT COMMENT 'Primary Key',
    nombre VARCHAR(255),
    marca VARCHAR(128),
    estado CHAR(3)
) COMMENT 'Tabla de Carros de la flota de Venta';