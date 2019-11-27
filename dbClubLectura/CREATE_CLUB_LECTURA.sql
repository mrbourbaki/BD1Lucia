CREATE TABLE lugar (
    codigo SERIAL NOT NULL,
    nombre VARCHAR(30) NOT NULL,
    tipo VARCHAR(10) NOT NULL,
    moneda VARCHAR(15),
    nacionalidad VARCHAR(),
    fk_lugar INT,
    CONSTRAINT pk_cod_lugar PRIMARY KEY (codigo),
    CONSTRAINT fk_lugar_lugar FOREIGN KEY(fk_lugar) REFERENCES lugar(codigo)
    CONSTRAINT tipo_lugar CHECK (tipo_lugar IN ('CIUDAD','PAIS')),
);

CREATE TABLE editorial (
    id SERIAL NOT NULL,
    nombre VARCHAR(30) NOT NULL,
    ciudad VARCHAR(15) NOT NULL,
    fk_lugar INT NOT NULL,
    CONSTRAINT pk_id_edi PRIMARY KEY (id),
    CONSTRAINT fk_lugar_editorial FOREIGN KEY (fk_lugar) REFERENCES lugar (codigo)

);

CREATE TABLE clase (
    id SERIAL NOT NULL,
    nombre VARCHAR(30),
    fk_clase INT,
    CONSTRAINT pk_id_clase PRIMARY KEY (id),
    CONSTRAINT fk_clase_clase FOREIGN KEY (fk_clase) REFERENCES clase(id) 
);

CREATE TABLE libro (
    id SERIAL NOT NULL,
    titulo_original VARCHAR(30) NOT NULL,
    sinopsis VARCHAR(100) NOT NULL,
    nro_pags DECIMAL(1000) NOT NULL,
    ano DECIMAL(3000) NOT NULL,
    titulo_espanol VARCHAR(30),
    tema VARCHAR(30),
    fk_editorial INT NOT NULL,
    fk_clase INT NOT NULL,
    fk_libro_comp INT,
    CONSTRAINT pk_id_libro PRIMARY KEY (id),
    CONSTRAINT fk_editorial_libro FOREIGN KEY (fk_editorial) REFERENCES editorial (id),
    CONSTRAINT fk_clase_libro FOREIGN KEY (fk_clase) REFERENCES clase (id),
    CONSTRAINT fk_libro_complementario FOREIGN KEY (fk_libro_comp) REFERENCES libro (id)
);

CREATE TABLE lec_libro (
    posicion SMALLINT NOT NULL,
    doc_lector INT NOT NULL,
    id_libro INT NOT NULL,
    CONSTRAINT pk_lec_libro PRIMARY KEY (doc_lector,id_libro),
    CONSTRAINT fk_lector_lec_libro  FOREIGN KEY (doc_lector) REFERENCES lector(docidentidad),
    CONSTRAINT fk_libro_lec_libro FOREIGN KEY (id_libro) REFERENCES libro(id),
    CONSTRAINT posicion_libro CHECK (posicion IN ('1','2','3'))
);

CREATE TABLE estructura (
    id SERIAL NOT NULL,
    id_libro SERIAL NOT NULL,
    nombre VARCHAR(30) NOT NULL,
    tipo VARCHAR(8) NOT NULL,
    titulo VARCHAR(30),
    fk_libro INT NOT NULL,
    fk_estructura SERIAL,
    CONSTRAINT pk_estruc_lib PRIMARY KEY (id,id_libro),
    CONSTRAINT fk_libro FOREIGN KEY (fk_libro) REFERENCES libro(id),
    CONSTRAINT fk_libro_estructura FOREIGN KEY (fk_estructura,fk_estructura)REFERENCES estructura(id,fk_libro),
    CONSTRAINT Tipo_estructura CHECK(tipo IN('capitulo','seccion','otra'))
);

CREATE TABLE sala (
    id SERIAL NOT NULL,
    tipo VARCHAR(10) NOT NULL,
    capacidad SMALLINT NOT NULL,
    nombre VARCHAR(30) NOT NULL,
    direccion VARCHAR(50) NOT NULL,
    fk_lugar INT NOT NULL,
    fk_club SERIAL,
    fk_club_cod INT,
    CONSTRAINT pk_id_sala PRIMARY KEY (id),
    CONSTRAINT fk_lugar_sala FOREIGN KEY (fk_lugar) REFERENCES lugar(codigo),
    CONSTRAINT fk_club_sala FOREIGN KEY (fk_club,fk_club_cod)REFERENCES club(id,codigo_postal),
    CONSTRAINT tipo_sala CHECK(tipo IN('ALQUILADA','PROPIA'))  
);

CREATE TABLE club (
	id SERIAL NOT NULL,
	codigo_postal INT NOT NULL,
	nombre VARCHAR(20) NOT NULL,	
	direccion VARCHAR(40) NOT NULL,
	fk_lugar SERIAL NOT NULL,
	fk_institucion SERIAL,
	cuota INT,
	CONSTRAINT pk_club PRIMARY KEY (id, codigo_postal),
	CONSTRAINT fK_lugar_club FOREIGN KEY (fk_lugar) REFERENCES lugar(codigo),
	CONSTRAINT fK_institucion_club FOREIGN KEY (fk_institucion) REFERENCES institucion(id) 
);

CREATE TABLE asoc_club (
    id_club INT NOT NULL,
    id_club_asoc INT NOT NULL,
    CONSTRAINT pk_asoc_club PRIMARY KEY (id_club,id_club_asoc),
    CONSTRAINT fk_id_club FOREIGN KEY (id_club,id_club) references(id,codigo_postal),
    CONSTRAINT fk_id_club_asoc FOREIGN KEY (id_club_asoc,id_club_asoc) references(id,codigo_postal)
);

CREATE TABLE calendario (
    fecha DATE NOT NULL,
    id_obra INT NOT NULL,
    hora_i TIME NOT NULL,
    estatus_realizada BOOLEAN NOT NULL,
    valoracion SMALLINT,
    cantidad_asistencia INT,
    CONSTRAINT pk_calendario PRIMARY KEY (fecha,id_obra),
    CONSTRAINT fk_obra FOREIGN KEY (id_obra) REFERENCES obra_actuada (id),
    CONSTRAINT valoracion_obra CHECK (valoracion IN('1','2','3','4','5'))
);

CREATE TABLE mejor_actor (

);

CREATE TABLE cal_club (
    id_club INT NOT NULL,
    cod_postal_club INT NOT NULL,
    fecha_cal DATE NOT NULL,
    id_obra INT NOT NULL,
    CONSTRAINT pk_cal_club PRIMARY KEY (id_club,cod_postal_club,fecha_cal,id_obra),
    CONSTRAINT fk_cal_club FOREIGN KEY (id_club,cod_postal_club) REFERENCES club(id,codigo_postal),
    CONSTRAINT fk_cal_club_cal FOREIGN KEY (fecha_cal,id_obra) REFERENCES calendario(fecha,id_obra)
);

CREATE TABLE obra_actuada (
    id SERIAL NOT NULL,
    resumen VARCHAR(100) NOT NULL,
    precio INTEGER NOT NULL,
    titulo VARCHAR(30) NOT NULL,
    estatus_actividad BOOLEAN NOT NULL,
    duracion SMALLINT NOT NULL,
    fk_sala INT NOT NULL,
    CONSTRAINT pk_id_obra PRIMARY KEY (id),
    CONSTRAINT fk_sala_obra FOREIGN KEY (fk_sala) REFERENCES sala(id) 
);

CREATE TABLE obra_libro (
    id_obra INT NOT NULL,
    id_libro INT NOT NULL,
    CONTRAINT pk_obra_libro PRIMARY KEY (id_obra,id_libro),
    CONSTRAINT FK_id_obra FOREIGN KEY(id_obra) REFERENCES obra_actuada(id),
    CONSTRAINT Fk_id_libro FOREIGN KEY(id_libro) REFERENCES libro(id)
)

CREATE TABLE personaje (
    id SERIAL NOT NULL,
    nombre VARCHAR(30) NOT NULL,
    descripcion VARCHAR(100) NOT NULL,
    fk_obra INT NOT NULL,
    CONSTRAINT pk_id_personaje PRIMARY KEY (id,fk_obra),
    CONSTRAINT fk_obra_personaje FOREIGN KEY (fk_obra) REFERENCES obra_actuada(id)
);

CREATE TABLE elenco (
    principal BOOLEAN NOT NULL,
    id_personaje INT NOT NULL,
    id_personaje_obra INT NOT NULL,
    id_obra INT NOT NULL,
    fecha_ini_hlector DATE NOT NULL,
    doc_lector INT NOT NULL,
    id_club INT NOT NULL,
    cod_postal_club INT NOT NULL,
    CONSTRAINT pk_elenco PRIMARY KEY (id_personaje,id_personaje_obra,id_obra,fecha_ini_hlector,doc_lector,id_club,cod_postal_club),
    CONSTRAINT fk_personaje_elenco FOREIGN KEY (id_personaje,id_personaje_obra) REFERENCES personaje (id,id),
    CONSTRAINT fk_obra_elenco FOREIGN KEY (id_obra)REFERENCES obra_actuada(id),
    CONSTRAINT fk_hlector_elenco FOREIGN KEY (fecha_ini_hlector,doc_lector,id_club,cod_postal_club) REFERENCES hist_lector(fecha_ini,fk_lector,fk_club,fk_club_codigo_postal)
)

CREATE TABLE representante_externo(
	docidentidad INT NOT NULL,
	nombre1 VARCHAR(15) NOT NULL,
	apellido1 VARCHAR(15) NOT NULL,
	apellido2 VARCHAR(15) NOT NULL,
	nombre2 VARCHAR(15),
	CONSTRAINT pk_representante_externo PRIMARY KEY (docidentidad)
);

CREATE TABLE lector (
	docidentidad INT NOT NULL,
	nombre1 VARCHAR(15) NOT NULL,
	apellido1 VARCHAR(15) NOT NULL,
	apellido2 VARCHAR(15) NOT NULL,
	genero VARCHAR(1) NOT NULL,
	telefono INT NOT NULL,
	fk_rep INT,
	fk_rep_externo INT,
	nombre2 VARCHAR(15),
    CONSTRAINT pk_lector PRIMARY KEY (docidentidad),
	CONSTRAINT fK_representante_lector FOREIGN KEY(fk_rep)REFERENCES lector(docidentidad),
	CONSTRAINT fK_representante_externo_lector FOREIGN KEY(fk_rep_externo)REFERENCES representante_externo(docidentidad)
);

CREATE TABLE institucion (
	id SERIAL NOT NULL,
    fk_lugar INT NOT NULL,
	nombre VARCHAR(20) NOT NULL,
	detalle VARCHAR(30),
    CONSTRAINT pk_institucion PRIMARY KEY (id),
	CONSTRAINT fk_lugar_ins FOREIGN KEY (fk_lugar) REFERENCES lugar(codigo)
);


CREATE TABLE his_lector(
	fecha_ini DATE NOT NULL,
    fk_lector INT NOT NULL,
	fk_club_id INT NOT NULL,
    fk_club_codigo_postal INT NOT NULL,
	estatus BOOLEAN NOT NULL,
	motivo_retiro VARCHAR(10),
	fecha_fin DATE,
	CONSTRAINT pk_his_lector PRIMARY KEY (fecha_ini,fk_lector,fk_club_id,fk_club_codigo_postal),
	CONSTRAINT fk_lector_his FOREIGN KEY (fk_lector) REFERENCES lector(docidentidad),
	CONSTRAINT fk_club_his FOREIGN KEY (fk_club,fk_club_codigo_postal) REFERENCES club(id,codigo_postal),
    CONSTRAINT Motivo_retiro CHECK (motivo_retiro IN ('INASISTENCIA','PAGO','VOLUNTARIO'))
);

CREATE TABLE pago (
	id SERIAL NOT NULL ,
	fecha_pago DATE NOT NULL,
	tipo_pago varchar(8) NOT NULL,
    fk_hlector DATE NOT NULL,
    fk_lector INT NOT NULL,
	fk_club   INT NOT NULL,
    fk_club_cod INT NOT NULL,
	CONSTRAINT pk_pago PRIMARY KEY(id,fk_hlector,fk_lector,fk_club,fk_club_cod),
	CONSTRAINT fk_historial_lector_pago FOREIGN KEY (fk_hlector,fk_lector,fk_club,fk_club_cod)REFERENCES his_lector(fecha_ini,fk_lector,fk_club,fk_club_codigo_postal),
    CONSTRAINT Tipo_pago CHECK (tipo_pago IN('CREDITO','DEBITO'))
);

CREATE TABLE grupo_lectura (
	id SERIAL NOT NULL ,
	fk_club INT NOT NULL,
    fk_cod_postal INT NOT NULL,
	tipo_grupo VARCHAR(7) NOT NULL,
	dia NUMERIC NOT NULL,
	hora_ini TIME NOT NULL,	
	hora_fin TIME NOT NULL,
	CONSTRAINT pk_grupo PRIMARY KEY (id,fk_club, fk_cod_postal),
	CONSTRAINT fk_club_grupo FOREIGN KEY(fk_club,fk_cod_postal) REFERENCES club(id,codigo_postal),
    CONSTRAINT Dia CHECK(dia IN('1','2','3','4','5')),
    CONSTRAINT Tipo_grupo CHECK(tipo_grupo IN('NINO','ADULTO','JOVEN'))	
);

CREATE TABLE his_grupo (
	fecha_ini_grupo DATE NOT NULL, 
	fk_fecha_ini_hlector DATE NOT NULL,
	fk_lector INT NOT NULL,
	fk_club   INT NOT NULL,
    fk_club_cod INT NOT NULL,

    fk_cod_postal INT NOT NULL,
	fk_grupo INT NOT NULL,
    fk_grupo_club INT NOT NULL,

    fecha_fin DATE,

	CONSTRAINT pk_hist_grupo PRIMARY KEY(fecha_ini,fk_fecha_ini_hlector,fk_lector,fk_club,fk_club_cod,fk_cod_postal,fk_grupo,fk_grupo_club),
	CONSTRAINT fk_grupo_historico_grupo FOREIGN KEY(fk_grupo,fk_club,fk_cod_postal)REFERENCES grupo_lectura(id,fk_club,fk_cod_postal),
	CONSTRAINT fk_hist_lector FOREIGN KEY (fk_fecha_ini_hlector,fk_lector,fk_club,fk_club_cod)REFERENCES his_lector(fecha_ini,fk_lector,fk_club,fk_club_codigo_postal)
);

CREATE TABLE reunion (
    id SERIAL NOT NULL,

    id_grupo INT NOT NULL,
    id_club INT NOT NULL,
    cod_postal_club INT NOT NULL,

    fecha_ini_grupo DATE NOT NULL,
    fecha_ini_hlector DATE NOT NULL
    doc_lector INT NOT NULL,

    id_libro INT NOT NULL,

    fecha DATE NOT NULL,
    conclusiones VARCHAR(100),
    valoracion SMALLINT,
    CONSTRAINT pk_reunion PRIMARY KEY (id,id_grupo,id_club,cod_postal_club),
    CONSTRAINT fk_grupo_reunion FOREIGN KEY (id_grupo,id_club,cod_postal_club) REFERENCES grupo_lectura(id,fk_club,fk_cod_postal),
    CONSTRAINT fk_libro_reunion FOREIGN KEY (id_libro),
    CONSTRAINT fk_his_grupo_reunion FOREIGN KEY (fecha_ini_grupo,id_grupo,fecha_ini_hlector,doc_lector,id_club,cod_postal_club),
    CONSTRAINT valoracion_libro CHECK(valoracion IN ('1','2','3','4','5'))
);

CREATE TABLE inasistencia (
    fecha_ini_grupo DATE NOT NULL,

    id_grupo INT NOT NULL,
    fecha_ini_hlector DATE NOT NULL,
    doc_lector INT NOT NULL,
    id_club INT NOT NULL,
    id_cod_postal INT NOT NULL,
    id_reunion INT NOT NULL,
    CONSTRAINT pk_inasistencia PRIMARY KEY (fecha_ini_grupo,id_grupo,fecha_ini_hlector,doc_lector,id_club,id_cod_postal,id_reunion),
    CONSTRAINT fk_his_grupo_inasitencia FOREIGN KEY (fecha_ini_grupo,fecha_ini_hlector,doc_lector,id_club,id_cod_postal,id_grupo) REFERENCES his_grupo ()
    CONSTRAINT fk_lector_inasistencia FOREIGN KEY (doc_lector) REFERENCES lector(docidentidad),
    CONSTRAINT fk_grupo_lectura_inasistencia FOREIGN KEY (id_grupo,id_club,) REFERENCES grupo_lectura (id,fk_club),
    CONSTRAINT fk_reunion_inasistencia FOREIGN KEY (id_reunion,id_grupo) REFERENCES reunion(id,fk_grupo)
);

CREATE TABLE mejor_actor(
    fk_cal_fecha DATE NOT NULL,
    fk_cal_obra INT NOT NULL,
    id_personaje INT NOT NULL,
    id_personaje_obra INT NOT NULL,
    id_obra INT NOT NULL,
    fecha_ini_hlector DATE NOT NULL,
    doc_lector INT NOT NULL,
    id_club INT NOT NULL,
    cod_postal_club INT NOT NULL,
    CONSTRAINT pk_mejor_actor PRIMARY KEY ( fk_cal_fecha, fk_cal_obra, id_personaje,id_personaje_obra,id_obra, fecha_ini_hlector,doc_lector, id_club,cod_postal_club),
    CONSTRAINT FK_mejor_act_elenco FOREIGN KEY (id_personaje,id_personaje_obra,id_obra, fecha_ini_hlector,doc_lector, id_club,cod_postal_club) REFERENCES elenco(id_personaje,id_personaje_obra,id_obra, fecha_ini_hlector,doc_lector, id_club,cod_postal_club),
    CONSTRAINT Fk _mejor_act_ cal FOREIGN KEY (fk_cal_fecha, fk_cal_obra) REFERENCES calendario(fecha,id_obra)

);
