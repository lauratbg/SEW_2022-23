CREATE DATABASE IF NOT EXISTS bd7 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;

CREATE TABLE PRODUCTO (
	id_producto VARCHAR(9) NOT NULL,
	nombre_producto VARCHAR(255) NOT NULL,
	descripcion_producto VARCHAR(255) NOT NULL,
	PRIMARY KEY (id_producto)
);

CREATE TABLE FACTURA_PRODUCTO (
	id_producto VARCHAR(9) NOT NULL,
	id_factura VARCHAR(9) NOT NULL,
	cantidad_producto INT NOT NULL,
	PRIMARY KEY (id_factura),
	FOREIGN KEY (id_producto) REFERENCES PRODUCTO(id_producto)
);

CREATE TABLE CLIENTE (
	id_cliente VARCHAR(9) NOT NULL,
	nombre_cliente VARCHAR(255) NOT NULL,
	direccion_cliente VARCHAR(255) NOT NULL,
	PRIMARY KEY (id_cliente)
);

CREATE TABLE TIENDA (
	id_tienda VARCHAR(9) NOT NULL,
	nombre_tienda VARCHAR(255) NOT NULL,
	direccion_tienda VARCHAR(255) NOT NULL,
	PRIMARY KEY (id_tienda)
);

CREATE TABLE FACTURA (
	id_cliente VARCHAR(9) NOT NULL,
	id_tienda VARCHAR(9) NOT NULL,
	id_factura VARCHAR(9) NOT NULL,
	cantidad_factura INT NOT NULL,
	descripcion_factura VARCHAR(255) NOT NULL,
	FOREIGN KEY (id_factura) REFERENCES FACTURA_PRODUCTO(id_factura),
	FOREIGN KEY (id_tienda) REFERENCES TIENDA(id_tienda),
	FOREIGN KEY (id_cliente) REFERENCES CLIENTE(id_cliente)
);

INSERT INTO PRODUCTO (id_producto, nombre_producto, descripcion_producto) VALUES
("P1", "Martillo", "Herramienta para golpear de color rojo"),
("P2", "Chupete", "Objeto que se da a los niños para chupar"),
("P3", 'Teléfono', "Aparato que recibe y emite comunicaciones a larga distancia y está conectado a una red telefónica"),
("P4", "Teclado", "Conjunto de teclas de un ordenador");

INSERT INTO FACTURA_PRODUCTO (id_producto, id_factura, cantidad_producto) VALUES
("P1", "FP1", 300),
("P2", "FP2", 150),
("P3", "FP3", 63),
("P4", "FP4", 85);

INSERT INTO CLIENTE (id_cliente, nombre_cliente, direccion_cliente) VALUES
("C1", "Laura", "Cangas del Narcea"),
("C2", "Miguel", "Cadavedo"),
("C3", 'Jairo', "Luarca"),
("C4", "Silvia", "San Juan de la Arena");

INSERT INTO TIENDA (id_tienda, nombre_tienda, direccion_tienda) VALUES
("T1", "Ferretería M&M", "Oviedo"),
("T2", "La tienda de María Luisa", "Gijón"),
("T3", 'La tiendina de Lucas', "Avilés"),
("T4", "Ultramarinos Asturias", "Oviedo");

INSERT INTO FACTURA (id_cliente, id_tienda, id_factura, cantidad_factura, descripcion_factura) VALUES
("C1", "T1", "FP1", 300, "Factura 1"),
("C2", "T2", "FP2", 150, "Factura 2"),
("C3", 'T3', "FP3", 63, "Factura 3"),
("C4", "T4", "FP4", 85, "Factura 4");