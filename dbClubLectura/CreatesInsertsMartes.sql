/*CREATE TABLE lugar (
    codigo SERIAL NOT NULL,
    nombre VARCHAR(30) NOT NULL,
    tipo VARCHAR(10) NOT NULL,
    moneda VARCHAR(15),
    nacionalidad VARCHAR(15),
    idioma VARCHAR(15),
    fk_lugar INT,
    CONSTRAINT pk_cod_lugar PRIMARY KEY (codigo),
    CONSTRAINT fk_lugar_lugar FOREIGN KEY (fk_lugar) REFERENCES lugar (codigo),
    CONSTRAINT tipo_lugar CHECK (tipo IN ('CIUDAD','PAIS'))
);

CREATE TABLE editorial (
    cod SERIAL NOT NULL,
    nombre VARCHAR (30) NOT NULL,
    fk_lugar INT NOT NULL,
    CONSTRAINT pk_id_edi PRIMARY KEY (cod),
    CONSTRAINT fk_lugar_editorial FOREIGN KEY (fk_lugar) REFERENCES lugar (codigo)
);

CREATE TABLE clase (
    cod SERIAL NOT NULL,
    nombre VARCHAR (30),
    fk_clase INT,
    tipo VARCHAR (10),
    CONSTRAINT pk_id_clase PRIMARY KEY (cod),
    CONSTRAINT fk_clase_clase FOREIGN KEY (fk_clase) REFERENCES clase (cod),
    CONSTRAINT tipo_clase CHECK (tipo IN ('SUBGENERO','OTRO'))
);

CREATE TABLE libro (
    cod SERIAL NOT NULL,
    titulo_original VARCHAR (30) NOT NULL,
    sinopsis VARCHAR (100) NOT NULL,
    nro_pags DECIMAL (1000) NOT NULL,
    ano INT NOT NULL,
    titulo_espanol VARCHAR (30),
    tema VARCHAR (30),
    fk_editorial INT NOT NULL,
    fk_clase INT NOT NULL,
    fk_libro_comp INT,
    CONSTRAINT pk_id_libro PRIMARY KEY (cod),
    CONSTRAINT fk_editorial_libro FOREIGN KEY (fk_editorial) REFERENCES editorial (cod),
    CONSTRAINT fk_clase_libro FOREIGN KEY (fk_clase) REFERENCES clase (cod),
    CONSTRAINT fk_libro_complementario FOREIGN KEY (fk_libro_comp) REFERENCES libro (cod)
);
*/
INSERT INTO lugar (nombre,tipo,moneda,nacionalidad,idioma,fk_lugar) VALUES
('VENEZUELA','PAIS','BOLIVAR','VENEZOLANO','ESPANOL',NULL),
('COREA DEL NORTE','PAIS','WON NORCOREANO','COREANO','COREANO',NULL),
('RUSIA','PAIS','RUBLO RUSO','RUSO','RUSO',NULL),
('GUASDUALITO','CIUDAD',NULL,NULL,NULL,1),
('PYONGYANG','CIUDAD',NULL,NULL,NULL,2),
('MOSCU','CIUDAD',NULL,NULL,NULL,3);

INSERT INTO editorial (nombre,fk_lugar) VALUES
('EDITORIAL GUASDUALITO',4),
('EDITORIAL MIR',6),
('EDITORIAL OFICIAL',5);

INSERT INTO clase (nombre, fk_clase, tipo) VALUES
('ODA', NULL, 'SUBGENERO'),
('ODA TRISTE', 1, 'OTRO'),
('EPICA', NULL, 'SUBGENERO');

INSERT INTO libro (titulo_original, sinopsis, nro_pags, ano, titulo_espanol, tema, fk_editorial, fk_clase, fk_libro_comp) VALUES
('ODYSSEY', 'Es un libro sobre la guerra y cosas tristes', 1000, 1312, 'LA ODISEA', 'GUERRA', 1, 1, NULL),
('ODYSSEY 2', 'Es un libro sobre la guerra y cosas tristes e la guerra, pero la segunda parte', 1033, 1323, 'LA ODISEA 2', 'GUERRA', 1, 1, 1),
('ILLIADE', 'Es un libro sobre cosas tristes despues', 1012, 1356, 'LA ILIADA', 'TRISTEZA', 2, 2, NULL);