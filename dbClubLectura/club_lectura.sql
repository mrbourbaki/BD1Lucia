/* 
Para borrar todas las tablas*/
DROP SCHEMA public CASCADE;

CREATE SCHEMA public;
GRANT ALL ON SCHEMA public TO postgres;
GRANT ALL ON SCHEMA public TO public;

/* te permite cambiar la variable de entorno en el formato dd/mm/yyyy*/
SET DATESTYLE TO 'European';

CREATE TABLE ofj_lugar (
    codigo SERIAL NOT NULL,
    nombre VARCHAR(30) NOT NULL,
    tipo VARCHAR(10) NOT NULL,
    moneda VARCHAR(15),
    nacionalidad VARCHAR(15),
    idioma VARCHAR(15),
    fk_lugar INT,
    CONSTRAINT pk_cod_lugar PRIMARY KEY (codigo),
    CONSTRAINT fk_lugar_lugar FOREIGN KEY (fk_lugar) REFERENCES ofj_lugar (codigo),
    CONSTRAINT tipo_lugar CHECK (tipo IN ('CIUDAD','PAIS'))
);

CREATE TABLE ofj_editorial (
    cod SERIAL NOT NULL,
    nombre VARCHAR (30) NOT NULL,
    fk_lugar INT NOT NULL,
    CONSTRAINT pk_id_edi PRIMARY KEY (cod),
    CONSTRAINT fk_lugar_editorial FOREIGN KEY (fk_lugar) REFERENCES ofj_lugar (codigo)
);

CREATE TABLE ofj_clase (
    cod SERIAL NOT NULL,
    nombre VARCHAR (30),
    tipo VARCHAR (10) NOT NULL,
    fk_clase INT,
    CONSTRAINT pk_id_clase PRIMARY KEY (cod),
    CONSTRAINT fk_clase_clase FOREIGN KEY (fk_clase) REFERENCES ofj_clase (cod) ON DELETE CASCADE,
    CONSTRAINT tipo_clase CHECK (tipo IN ('SUBGENERO','OTRO'))
);

CREATE TABLE ofj_libro (
    cod SERIAL NOT NULL,
    titulo_original VARCHAR (80) NOT NULL,
    sinopsis VARCHAR (400) NOT NULL,
    nro_pags DECIMAL (1000) NOT NULL,
    ano INT NOT NULL,
    titulo_espanol VARCHAR (80),
    tema VARCHAR (80),
    fk_editorial INT NOT NULL,
    fk_clase INT NOT NULL,
    fk_libro_comp INT,
    CONSTRAINT pk_id_libro PRIMARY KEY (cod),
    CONSTRAINT fk_editorial_libro FOREIGN KEY (fk_editorial) REFERENCES ofj_editorial (cod) ON DELETE SET DEFAULT,
    CONSTRAINT fk_clase_libro FOREIGN KEY (fk_clase) REFERENCES ofj_clase (cod) ON DELETE SET DEFAULT,
    CONSTRAINT fk_libro_complementario FOREIGN KEY (fk_libro_comp) REFERENCES ofj_libro (cod) ON DELETE SET DEFAULT
);

CREATE TABLE ofj_representante_externo ( 
	docidentidad INT NOT NULL,
	nombre1 VARCHAR (15) NOT NULL,
	apellido1 VARCHAR (15) NOT NULL,
	apellido2 VARCHAR (15) NOT NULL,
	nombre2 VARCHAR (15),
	CONSTRAINT pk_representante_externo PRIMARY KEY (docidentidad)
);

CREATE TABLE ofj_lector (
	docidentidad INT NOT NULL,
    fecha_nac DATE NOT NULL,
	nombre1 VARCHAR (15) NOT NULL,
	apellido1 VARCHAR (15) NOT NULL,
	apellido2 VARCHAR (15) NOT NULL,
	genero VARCHAR (1) NOT NULL,
	telefono NUMERIC(14) NOT NULL,  /*  cambie a numerico para que no diera error cuando uno ingrese el numero ya que el int estabamos fuera del rango */
    fk_nacionalidad INT NOT NULL,
	fk_rep INT,
	fk_rep_externo INT,
	nombre2 VARCHAR(15),
    CONSTRAINT pk_lector PRIMARY KEY (docidentidad),
    CONSTRAINT fk_nacionalidad_lector FOREIGN KEY (fk_nacionalidad) REFERENCES ofj_lugar (codigo),
	CONSTRAINT fK_representante_lector FOREIGN KEY (fk_rep) REFERENCES ofj_lector(docidentidad),
	CONSTRAINT fK_representante_externo_lector FOREIGN KEY (fk_rep_externo) REFERENCES ofj_representante_externo(docidentidad),
    CONSTRAINT Tipo_genero CHECK (genero IN ('F','M'))

);

CREATE TABLE ofj_lec_libro (
    posicion SMALLINT NOT NULL,
    doc_lector INT NOT NULL,
    id_libro INT NOT NULL,
    CONSTRAINT pk_lec_libro PRIMARY KEY (doc_lector,id_libro),
    CONSTRAINT fk_lector_lec_libro  FOREIGN KEY (doc_lector) REFERENCES ofj_lector(docidentidad),
    CONSTRAINT fk_libro_lec_libro FOREIGN KEY (id_libro) REFERENCES ofj_libro (cod),
    CONSTRAINT posicion_libro CHECK (posicion IN (1,2,3))
);

CREATE TABLE ofj_estructura (
    cod SERIAL NOT NULL,
    id_libro INT NOT NULL,
    nombre VARCHAR(30) NOT NULL,    
    tipo VARCHAR(8) NOT NULL,
    titulo VARCHAR(30),
    CONSTRAINT pk_estruc_lib PRIMARY KEY (cod,id_libro),
    CONSTRAINT fk_libro FOREIGN KEY (id_libro) REFERENCES ofj_libro(cod),
    CONSTRAINT fk_estructura_estructura FOREIGN KEY (cod,id_libro) REFERENCES ofj_estructura (cod,id_libro),
    CONSTRAINT Tipo_estructura CHECK (tipo IN ('CAPITULO','SECCION','OTRO'))
);

CREATE TABLE ofj_institucion (
	cod SERIAL NOT NULL,
	nombre VARCHAR(40) NOT NULL,
	detalle VARCHAR(30),
    fk_lugar INT NOT NULL,
    CONSTRAINT pk_institucion PRIMARY KEY (cod),
	CONSTRAINT fk_lugar_ins FOREIGN KEY (fk_lugar) REFERENCES ofj_lugar (codigo)
);

CREATE TABLE ofj_club (
	cod SERIAL NOT NULL,
	codigo_postal VARCHAR(15) NOT NULL,
	nombre VARCHAR(30) NOT NULL,	
	direccion VARCHAR(40) NOT NULL,
	fk_lugar SERIAL NOT NULL,
	fk_institucion INT,
	cuota INT,
	CONSTRAINT pk_club PRIMARY KEY (cod),
	CONSTRAINT fK_lugar_club FOREIGN KEY (fk_lugar) REFERENCES ofj_lugar (codigo),
	CONSTRAINT fK_institucion_club FOREIGN KEY (fk_institucion) REFERENCES ofj_institucion (cod) 
);

CREATE TABLE ofj_sala (
    cod SERIAL NOT NULL,
    tipo VARCHAR(10) NOT NULL,
    capacidad SMALLINT NOT NULL,
    nombre VARCHAR(30) NOT NULL,
    direccion VARCHAR(50) NOT NULL,
    fk_lugar INT NOT NULL,
    fk_club INT,
    CONSTRAINT pk_id_sala PRIMARY KEY (cod),
    CONSTRAINT fk_lugar_sala FOREIGN KEY (fk_lugar) REFERENCES ofj_lugar (codigo),
    CONSTRAINT fk_club_sala FOREIGN KEY (fk_club) REFERENCES ofj_club (cod),
    CONSTRAINT tipo_sala CHECK(tipo IN('ALQUILADA','PROPIA'))  
);

CREATE TABLE ofj_asoc_club (
    id_club INT NOT NULL,
    id_club_asoc INT NOT NULL,
    CONSTRAINT pk_asoc_club PRIMARY KEY (id_club,id_club_asoc),
    CONSTRAINT fk_id_club FOREIGN KEY (id_club) REFERENCES ofj_club (cod),
    CONSTRAINT fk_id_club_asoc FOREIGN KEY (id_club_asoc) REFERENCES ofj_club (cod)
);

CREATE TABLE ofj_obra_actuada (
    cod SERIAL NOT NULL,
    resumen VARCHAR(400) NOT NULL,
    precio INTEGER NOT NULL,
    titulo VARCHAR(30) NOT NULL,
    estatus_actividad BOOLEAN NOT NULL,
    duracion SMALLINT NOT NULL,
    fk_sala INT NOT NULL ,
    CONSTRAINT pk_id_obra PRIMARY KEY (cod),
    CONSTRAINT fk_sala_obra FOREIGN KEY (fk_sala) REFERENCES ofj_sala(cod) ON DELETE SET DEFAULT
);

CREATE TABLE ofj_calendario (
    fecha DATE NOT NULL,
    id_obra INT NOT NULL,
    hora_i TIME NOT NULL,
    estatus_realizada BOOLEAN NOT NULL,
    valoracion SMALLINT,
    cantidad_asistencia INT,
    CONSTRAINT pk_calendario PRIMARY KEY (fecha,id_obra),
    CONSTRAINT fk_obra FOREIGN KEY (id_obra) REFERENCES ofj_obra_actuada (cod),
    CONSTRAINT valoracion_obra CHECK (valoracion IN (1,2,3,4,5))
);

CREATE TABLE ofj_personaje (
    cod SERIAL NOT NULL,
    id_obra INT NOT NULL,
    nombre VARCHAR(30) NOT NULL,
    descripcion VARCHAR(300) NOT NULL,
    CONSTRAINT pk_id_personaje PRIMARY KEY (cod,id_obra),
    CONSTRAINT fk_obra_personaje FOREIGN KEY (id_obra) REFERENCES ofj_obra_actuada (cod)
);

CREATE TABLE ofj_hist_lector(
	fecha_ini DATE NOT NULL,
    doc_lector INT NOT NULL,
	id_club INT NOT NULL,
	estatus VARCHAR(10) NOT NULL,
	motivo_retiro VARCHAR(10),
	fecha_fin DATE,
	CONSTRAINT pk_hist_lector PRIMARY KEY (fecha_ini,doc_lector,id_club),
	CONSTRAINT fk_lector_hist FOREIGN KEY (doc_lector) REFERENCES ofj_lector(docidentidad),
	CONSTRAINT fk_club_hist FOREIGN KEY (id_club) REFERENCES ofj_club(cod),
    CONSTRAINT estatus CHECK (estatus IN ('ACTIVO', 'RETIRADO')),
    CONSTRAINT motivo_retiro CHECK (motivo_retiro IN ('INASISTENCIA','PAGO','VOLUNTARIO'))
);

CREATE TABLE ofj_elenco (
    id_personaje INT NOT NULL,
    id_obra_personaje INT NOT NULL,
    id_obra_elenco INT NOT NULL,
    fecha_hist_lector DATE NOT NULL,
    doc_lector_hist_lector INT NOT NULL,
    id_club_hist_lector INT NOT NULL,
    principal BOOLEAN,
    CONSTRAINT pk_elenco PRIMARY KEY (id_personaje,id_obra_personaje,id_obra_elenco,fecha_hist_lector,doc_lector_hist_lector,id_club_hist_lector),
    CONSTRAINT fk_personaje_elenco FOREIGN KEY (id_personaje,id_obra_personaje) REFERENCES ofj_personaje (cod,id_obra),
    CONSTRAINT fk_obra_elenco FOREIGN KEY (id_obra_elenco) REFERENCES ofj_obra_actuada (cod),
    CONSTRAINT fk_hist_lector_elenco FOREIGN KEY (fecha_hist_lector,doc_lector_hist_lector,id_club_hist_lector) REFERENCES ofj_hist_lector(fecha_ini,doc_lector,id_club)
);

CREATE TABLE ofj_mejor_actor (
    fecha_cal DATE NOT NULL,
    id_obra_cal INT NOT NULL,
    id_personaje INT NOT NULL,
    id_obra_personaje INT NOT NULL,
    id_obra_elenco INT NOT NULL,
    fecha_hist_lector_elenco DATE NOT NULL,
    doc_lector_hist_elenco INT NOT NULL,
    id_club_hist_elenco INT NOT NULL,
    CONSTRAINT pk_mejor_actor PRIMARY KEY (fecha_cal,id_obra_cal,id_personaje,id_obra_personaje,id_obra_elenco,fecha_hist_lector_elenco,doc_lector_hist_elenco,id_club_hist_elenco),
    CONSTRAINT fk_cal_mejor_actor FOREIGN KEY (fecha_cal,id_obra_cal) REFERENCES ofj_calendario (fecha,id_obra),
    CONSTRAINT fk_elenco_mejor_actor FOREIGN KEY (id_personaje,id_obra_personaje,id_obra_elenco,fecha_hist_lector_elenco,doc_lector_hist_elenco,id_club_hist_elenco) REFERENCES ofj_elenco (id_personaje,id_obra_personaje,id_obra_elenco,fecha_hist_lector,doc_lector_hist_lector,id_club_hist_lector)
);

CREATE TABLE ofj_cal_club (
    id_club INT NOT NULL,
    fecha_cal DATE NOT NULL,
    id_obra INT NOT NULL,
    CONSTRAINT pk_cal_club PRIMARY KEY (id_club,fecha_cal,id_obra),
    CONSTRAINT fk_cal_club_club FOREIGN KEY (id_club) REFERENCES ofj_club (cod),
    CONSTRAINT fk_cal_club_cal FOREIGN KEY (fecha_cal,id_obra) REFERENCES ofj_calendario (fecha,id_obra)
);

CREATE TABLE ofj_obra_libro (
    id_obra INT NOT NULL,
    id_libro INT NOT NULL,
    CONSTRAINT pk_obra_libro PRIMARY KEY (id_obra,id_libro),
    CONSTRAINT fk_id_obra FOREIGN KEY (id_obra) REFERENCES ofj_obra_actuada (cod),
    CONSTRAINT fk_id_libro FOREIGN KEY (id_libro) REFERENCES ofj_libro (cod)
);

CREATE TABLE ofj_pago (
	cod SERIAL NOT NULL,
    fecha_hist_lector DATE NOT NULL,
    doc_lector_hist_lector INT NOT NULL, 
	id_club_hist_lector INT NOT NULL,
	fecha_pago DATE NOT NULL,
	tipo_pago varchar(8) NOT NULL,
	CONSTRAINT pk_pago PRIMARY KEY (cod,fecha_hist_lector,doc_lector_hist_lector,id_club_hist_lector),
	CONSTRAINT fk_hist_lector_pago FOREIGN KEY (fecha_hist_lector,doc_lector_hist_lector,id_club_hist_lector) REFERENCES ofj_hist_lector (fecha_ini,doc_lector,id_club),
    CONSTRAINT tipo_pago CHECK (tipo_pago IN('CRÉDITO','DÉBITO'))
);

CREATE TABLE ofj_grupo_lectura (
	cod SERIAL NOT NULL,
	id_club INT NOT NULL,
	tipo_grupo VARCHAR(7) NOT NULL,
	dia NUMERIC NOT NULL,
	hora_ini TIME NOT NULL,	
	hora_fin TIME NOT NULL,
	CONSTRAINT pk_grupo PRIMARY KEY (cod,id_club),
	CONSTRAINT fk_club_grupo FOREIGN KEY (id_club) REFERENCES ofj_club (cod),
    CONSTRAINT dia CHECK (dia IN(2,3,4,5,6)),
    CONSTRAINT tipo_grupo CHECK (tipo_grupo IN ('NINO','ADULTO','JOVEN'))
);

CREATE TABLE ofj_hist_grupo (
	fecha_hist_lector DATE NOT NULL,
	doc_lector_hist_lector INT NOT NULL,
	id_club_hist_lector INT NOT NULL,
	id_grupo INT NOT NULL,
    id_club_grupo INT NOT NULL,
    fecha_ini DATE NOT NULL,
    fecha_fin DATE,
	CONSTRAINT pk_hist_grupo PRIMARY KEY (fecha_hist_lector,doc_lector_hist_lector,id_club_hist_lector,id_grupo,id_club_grupo),
	CONSTRAINT fk_hist_grupo_grupo FOREIGN KEY (id_grupo,id_club_grupo) REFERENCES ofj_grupo_lectura (cod,id_club) ON DELETE CASCADE,
	CONSTRAINT fk_hist_lector_grupo FOREIGN KEY (fecha_hist_lector,doc_lector_hist_lector,id_club_hist_lector) REFERENCES ofj_hist_lector (fecha_ini,doc_lector,id_club)
);

CREATE TABLE ofj_reunion (
    cod SERIAL NOT NULL,
    id_grupo INT NOT NULL,
    id_club_grupo INT NOT NULL,
    id_grupo_hist_grupo INT NOT NULL,
    id_club_hist_grupo INT NOT NULL,
    fecha_hlector DATE NOT NULL,
    doc_lector INT NOT NULL,
    id_club_hist_lector INT NOT NULL,
    id_libro INT NOT NULL,
    fecha DATE NOT NULL,
    conclusiones VARCHAR(300),
    valoracion SMALLINT,
    CONSTRAINT pk_reunion PRIMARY KEY (cod,id_grupo,id_club_grupo),
    CONSTRAINT fk_grupo_reunion FOREIGN KEY (id_grupo,id_club_grupo) REFERENCES ofj_grupo_lectura(cod,id_club),
    CONSTRAINT fk_libro_reunion FOREIGN KEY (id_libro) REFERENCES ofj_libro(cod),
    CONSTRAINT fk_hist_grupo_reunion FOREIGN KEY (id_grupo_hist_grupo,id_club_hist_grupo,fecha_hlector,doc_lector,id_club_hist_lector) REFERENCES ofj_hist_grupo(id_grupo,id_club_grupo,fecha_hist_lector,doc_lector_hist_lector,id_club_hist_lector),
    CONSTRAINT valoracion_libro CHECK(valoracion IN (1,2,3,4,5))
);

CREATE TABLE ofj_inasistencia (
    id_reunion INT NOT NULL,
    id_grupo_reunion INT NOT NULL,
    id_club_grupo_reunion INT NOT NULL,
    id_grupo INT NOT NULL,
    id_club_grupo INT NOT NULL,
    id_grupo_hist_grupo INT NOT NULL,
    id_club_grupo_hist_grupo INT NOT NULL,
    fecha_hlector DATE NOT NULL,
    doc_lector INT NOT NULL,
    id_club_hist_lector INT NOT NULL,
    CONSTRAINT pk_inasistencia PRIMARY KEY (id_reunion,id_grupo_reunion,id_club_grupo_reunion,id_grupo_hist_grupo,id_club_grupo_hist_grupo,fecha_hlector,doc_lector,id_club_hist_lector),
    CONSTRAINT fk_hist_grupo_inasistencia FOREIGN KEY (id_grupo_hist_grupo,id_club_grupo_hist_grupo,fecha_hlector,doc_lector,id_club_hist_lector) REFERENCES ofj_hist_grupo(id_grupo,id_club_grupo,fecha_hist_lector,doc_lector_hist_lector,id_club_hist_lector),
    CONSTRAINT fk_lector_inasistencia FOREIGN KEY (doc_lector) REFERENCES ofj_lector(docidentidad),
    CONSTRAINT fk_grupo_lectura_inasistencia FOREIGN KEY (id_grupo,id_club_grupo) REFERENCES ofj_grupo_lectura(cod,id_club),
    CONSTRAINT fk_reunion_inasistencia FOREIGN KEY (id_reunion,id_grupo,id_club_grupo) REFERENCES ofj_reunion(cod,id_grupo,id_club_grupo)
);
