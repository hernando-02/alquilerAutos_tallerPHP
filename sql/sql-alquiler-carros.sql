CREATE DATABASE `alquiler_carros`;
create table carros (
	id int auto_increment not null,
	marca varchar(50) not null,
	modelo int not null,
	placa varchar(10) not null,
	primary key(id)
);
create table alquileres(
	id int auto_increment not null,
	id_auto int NOT NULL,
	nombre_cliente varchar(100) NOT null,
	nombre_prestador varchar(100) NOT NULL,
	hora_inicio datetime NOT null,
	fecha_devolucion date NOT NULL,
	km_recorridos int NOT NULL,
	precio float NOT NULL,
	email_cliente varchar(150),
	primary key(id),
	-- foreign key
	foreign key(id_auto) REFERENCES carros(id)
);
-- VALORES CARRO
INSERT INTO carros(id, marca, modelo, placa)
VALUES (NULL, 'NISSAN', 2022, "KIJ-563");
INSERT INTO carros(marca, modelo, placa)
VALUES ('HUMMER', 2022, "NJM-578");
INSERT INTO carros(marca, modelo, placa)
VALUES ('CAMARO', 2021, "NJH-543");
INSERT INTO carros(marca, modelo, placa)
VALUES ('TOYOTA', 2022, "NEM-563");
INSERT INTO carros(marca, modelo, placa)
VALUES ('NISSAN', 2023, "OJM-863");
INSERT INTO carros(marca, modelo, placa)
VALUES ('FERRARI', 2020, "PJM-893");
INSERT INTO carros(marca, modelo, placa)
VALUES ('BMW', 2021, "NDM-563");
INSERT INTO carros(marca, modelo, placa)
VALUES ('MERCEDES-BENZ', 2022, "NYM-563");
INSERT INTO carros(marca, modelo, placa)
VALUES ('MERCEDES-BENZ', 2023, "NDDF-163");
INSERT INTO carros(marca, modelo, placa)
VALUES ('MERCEDES-BENZ', 2020, "JHJ-333");
-- VALORES ALQUILERES
INSERT INTO alquileres(
		id_auto,
		nombre_cliente,
		nombre_prestador,
		hora_inicio,
		fecha_devolucion,
		km_recorridos,
		precio,
		email_cliente
	)
VALUES (
		1,
		'Juan',
		'Fernando',
		'2021-09-10 10:00:59',
		'2021-09-15',
		30,
		200000,
		'juan@correo.com'
	);
INSERT INTO alquileres(
		id_auto,
		nombre_cliente,
		nombre_prestador,
		hora_inicio,
		fecha_devolucion,
		km_recorridos,
		precio,
		email_cliente
	)
VALUES (
		1,
		'Carlos',
		'Fernando',
		'2021-09-10 10:00:59',
		'2021-09-20',
		50,
		500000,
		'carlos@correo.com'
	);
INSERT INTO alquileres(
		id_auto,
		nombre_cliente,
		nombre_prestador,
		hora_inicio,
		fecha_devolucion,
		km_recorridos,
		precio,
		email_cliente
	)
VALUES (
		2,
		'Andrea',
		'Pedro',
		'2021-09-10 10:00:59',
		'2021-09-20',
		50,
		500000,
		'andrea@correo.com'
	);