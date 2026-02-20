CREATE DATABASE tienda_ropa;
USE tienda_ropa;


CREATE TABLE admin (
id INT AUTO_INCREMENT PRIMARY KEY,
usuario VARCHAR(50),
password VARCHAR(255)
);


CREATE TABLE productos (
id INT AUTO_INCREMENT PRIMARY KEY,
nombre VARCHAR(100),
descripcion TEXT,
precio DECIMAL(10,2),
imagen VARCHAR(255),
fecha TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);