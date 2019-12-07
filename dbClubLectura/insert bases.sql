INSERT INTO lugar  (nombre,tipo,moneda,nacionalidad,idioma,fk_lugar) VALUES 
	('CHILE','PAÍS','PESO CHILENO','CHILENO','ESPAÑOL',NULL),
	('INGLATERRA','PAÍS','EURO','INGLÉS','INGLÉS',NULL),
	('SANTIAGO DE CHILE','CIUDAD',NULL,NULL,NULL,1),
	('PROVIDENCIA','CIUDAD',NULL,NULL,NULL,1),
	('LONDRES','CIUDAD',NULL,NULL,NULL,2),
	('MANCHESTER','CIUDAD',NULL,NULL,NULL,2);

INSERT INTO editorial (nombre,fk_lugar)  VALUES 
	('EDICIONES UDP',3),
	('MYTHICA EDICIONES',3),
	('ZIG ZAG',4),
	('TIEMPO PRESENTE',4),
	('SPECTRUM PRESS',5),
	('ELSEVIER',5),
	('NEWSCO INSIDER',6),
	('COMMA PRESS',6);

INSERT INTO clase (nombre,tipo,fk_clase) VALUES
	('FANTASÍA','SUBGENERO',NULL),
	('CIENCIA FICCIÓN','SUBGENERO',NULL),
	('CIENCIA FICCIÓN POLÍTICA','OTRO',2),
	('ALEGORÍA','SUBGENERO',NULL),
	('NOVELA','SUBGENERO',NULL),
	('NOVELA TRÁGICA','OTROS',5),
	('CIENCIA FICCIÓN ESPACIAL','OTRO',2),
	('ENSAYO','SUBGENERO',NULL);


INSERT INTO libro (titulo_original,sinopsis,nro_pags,ano,titulo_espanol,tema,fk_editorial,fk_clase,fk_libro_comp) VALUES
	('1984','INQUIETANTE INTERPRETACIÓN FUTURISTA BASADA EN LA CRÍTICA A LOS TOTALITARISMOS Y A LA OPRESIÓN DEL PODER, SITUADA EN 1984 EN UNA SOCIEDAD INGLESA',326,1948,'1984',NULL,5,3,NULL),
	('THE CHRONICLES OF NARNIA THE LION THE WITCH AND THE WARDROBE','CUATRO NIÑOS VIAJAN A TRAVES DE UN ROPERO A LA TIERRA DE NARNIA, DONDE VIVIRÁN INCREÍBLES AVENTURAS CON LA AYUDA DEL LEÓN ASLAN',208,1950,'LAS CRONICAS DE NARNIA EL LEON LA BRUJA Y EL ROPERO',NULL,4,1,NULL),
	('THE CHRONICLES OF NARNIA PRINCE CASPIAN','LOS CUATRO HERMANOS  REGRESAN A NARNIA Y AUNQUE PARA ELLOS HA PASADO UN AÑO ALLÁ HAN TRANSCURRIDO 1300 AÑOS. NARNIA ESTÁ AHORA SOMETIDA A LOS TELMARINOS A QUIENES DIRIGE EL MALVADO REY MIRAZ',195,1951,'LAS CRONICAS DE NARNIA EL PRINCIPE CASPIAN',NULL,5,1,2),
	('DIE VERWANDLUNG','CUENTA LA HISTORIA DE LA TRANSFORMACIÓN DE GREGORIO SAMSA EN UN MONSTRUOSO INSECTO, Y DEL DRAMA FAMILIAR QUE, A RAÍZ DE ESTE ACONTECIMIENTO, SE DESATA',128,1915,'LA METAMORFOSIS',8,4,NULL),
	('EL TÚNEL','JUAN PABLO CASTEL, PERSONAJE PRINCIPAL Y NARRADOR, CUENTA DESDE LA CÁRCEL LOS MOTIVOS QUE LO LLEVARON A ASESINAR A MARÍA IRIBARNE, SU AMANTE',184,1984,'EL TÚNEL',NULL,6,8,NULL),
	('BRAVE NEW WORLD','LA NOVELA ES UNA DISTOPÍA QUE ANTICIPA EL DESARROLLO EN TECNOLOGÍA REPRODUCTIVA, CULTIVOS HUMANOS E HIPNOPEDIA, MANEJO DE LAS EMOCIONES POR MEDIO DE DROGAS QUE, COMBINADAS, CAMBIAN RADICALMENTE LA SOCIEDAD',178,1932,'UN MUNDO FELIZ',NULL,3,3,NULL),
	('HOMBRES Y ENGRANAJES','HOMBRES Y ENGRANAJES EXAMINA EL LARGO CAMINO RECORRIDO POR LA CULTURA OCCIDENTAL DESDE EL RENACIMIENTO A IMPULSOS DE LA DOBLE INFLUENCIA DEL DINERO Y DE LA RAZÓN',144,1951,'HOMBRES Y ENGRANAJES',NULL,3,8,NULL),
	('2001: A SPACE ODYSSEY','LA SUPERCOMPUTADORA HAL 9000 GUÍA A UN EQUIPO DE TRES ASTRONAUTAS EN UN VIAJE EN EL QUE BUSCAN DESCUBRIR LOS ORÍGENES DE LA HUMANIDAD',240,1968,'2001:ODISEA EN EL ESPACIO',NULL,7,7,NULL);

INSERT INTO representante_externo (docidentidad,nombre1,apellido1,apellido2,nombre2)  VALUES
	 (711793712, 'DION', 'DITTS', 'HUTT', 'QUINCEY'),
 	(987892256, 'JUSTEN', 'AHRENDSEN', 'CAMBER', 'NERTY'),
 	(533519477, 'RAYMUND', 'EAKLY', 'CAHANI', 'CHRISTY'),
 	(520130964, 'HALIMEDA', 'CLEMETTS', 'TERZO', 'AMITY'),
 	(621398341, 'SILVANO', 'MAHY', 'MANIE', 'REBEKKAH'),
 	(744479435, 'BLONDELLE', 'CHIVERSTONE', 'MEDLING', 'KARI'),
 	(548219921, 'NANNI', 'ROMAIN', 'DARRIGRAND', 'JUDON'),
 	(631652901, 'EDI', 'LOVEGROVE', 'HANINGTON', 'MARIN');

INSERT INTO lector (docidentidad,fecha_nac,nombre1,apellido1,apellido2,genero,telefono,fk_nacionalidad,fk_rep,fk_rep_externo,nombre2) VALUES
	(448012254, '07-08-2004', 'MILLICENT', 'HERRIEVEN', 'SHEPLEY', 'F', 340 498 3557, 1, NULL, NULL, NULL),
	(617174421, '04-19-2002', 'DEVIN', 'LOVEITT', 'GRISLEY', 'M',670 870 6191, 1, NULL, NULL, NULL),
	(496583972, '06-12-2004', 'DEVONNE', 'MCENENY', 'EVITTS', 'F',893 922 4906, 2, NULL, NULL, NULL),
	(884614167, '02-29-2003', 'BERYLE', 'MORDE', 'NATALIE', 'F',284 950 2491, 2, NULL, NULL, NULL),
	(570098273, '10-19-2002', 'BRINEY', 'DOBBLE', 'MEBES', 'F',775 336 0482, 2, NULL, NULL, NULL),
	(018218935, '09-01-2008', 'MAL', 'KELD', 'BANTOCK', 'M',829 319 7177, 2,711793712, NULL, NULL),
	(335676685, '08-20-2010', 'DWAYNE', 'UNGERECHT', 'LOPEZ', 'M',814 728 3169, 2,987892256, NULL, NULL),
	(337599324, '03-02-2008', 'DARELLE', 'WHIGHTMAN', 'HASKUR', 'F',457 215 1305, 1, 533519477, NULL, NULL),
	(337021440, '03-08-2008', 'MERRILI', 'SHAUGHNESSY', 'MCNYSCHE', 'F',775 981 5871, 2, 520130964, NULL, NULL),
	(336109574, '05-27-2010', 'MELLI', 'MOSSON', 'CALIFORNIA', 'F',142 180 8883, 2, 621398341, NULL, NULL),
	(335351470, '03-11-2008', 'BALD', 'BURSTON', 'PENRITH', 'M',249 887 6965, 1, 744479435, NULL, NULL),
	(331832514, '01-21-2009', 'BRYNN', 'BURCHESS', 'HIXLEY', 'F',691 472 4404, 1, 548219921, NULL, NULL),
	(334061189, '05-15-2010', 'JADA', 'SOFFE', 'PIRES', 'F',401 613 1432, 2,631652901 , NULL, NULL);

INSERT INTO lec_libro (posicion,doc_lector,id_libro) VALUES
	(1,248012254,3), (2,248012254,7), (3,248012254,8),
	(1,217174421,4), (2,217174421,5), (3,217174421,6),
	(1,296583972,1), (2,296583972,2), (3,296583972,3),
	(1,284614167,3), (2,284614167,1), (3,284614167,7),
	(1,270098273,7), (2,270098273,5), (3,270098273,6),
	(1,318218935,1), (2,318218935,2), (3,318218935,3),
	(1,335676685,4), (2,335676685,1), (3,335676685,2),
	(1,337599324,7), (2,337599324,8), (3,337599324,4),
	(1,337021440,2), (2,337021440,1), (3,337021440,8),
	(1,336109574,1), (2,336109574,2), (3,336109574,3),
	(1,335351470,6), (2,335351470,2), (3,335351470,4),
	(1,331832514,2), (2,331832514,5), (3,331832514,8),
	(1,334061189,5), (2,334061189,6), (3,334061189,7);

INSERT INTO estructura VALUES

INSERT INTO institucion (nombre,detalle,fk_lugar) VALUES
	('BIBLIOTECA NACIONAL DE CHILE',NULL,3),
	('BIBLIOTECA MUNICIPAL DE PROVIDENCIA',NULL,4),
	('COLEGIO SAN IGNACIO',NULL,3),
	('COLEGIO MANANTIALES',NULL,4),
	('GUILDHALL LIBRARY',NULL,5),
	('THE MAUGHAN LIBRARY',NULL,5),
	('ARDEN UNIVERSITY',NULL,6),
	('THE MANCHESTER COLLEGE',NULL,6);

INSERT INTO club (codigo_postal,nombre,direccion,fk_lugar,fk_institucion,cuota) VALUES
	('8320000','TARDES DE LECTURA','AVENIDA APOQUINDO 6282 LAS CONDES',3,NULL,100),
	('8320000','UN LIBRO Y UN CAFÉ','AVENIDA BUZETA 4534 CERRILLOS',3,1,NULL),
	('7500000','LECTORES POR DIVERSIÓN','AVENIDA HERNANDO DE AGUIRRE 3645',4,2,NULL),
	('7500000','FORJADORES DE IDEAS','AVENIDA NUEVA PROVIDENCIA 2034',4,NULL,100),
	('N179EZ','BOOKS AND MEETING','65 HANBURY ST SPITALFIELDS',5,NULL,100),
	('N179EZ','READERS FROM NOWHERE','84 MARYLEBONE HIGH ST MARYLEBONE',5,5,NULL),
	('BL1','MANCHESTER READING FANS','1620 TURNER STREET NORTHERN QUARTER',6,6,NULL),
	('M15','LIBERAL CLUB BOOK ','47 BARLOW MORE ROAD DIDSBURY VILLAGE',6,5,NULL);

INSERT INTO sala (tipo,capacidad,nombre,direccion,fk_lugar,fk_club) VALUES 
	('PROPIA',30,'ANDRÉS BELLO','AVENIDA APOQUINDO 6282 LAS CONDES',3,1),
	('ALQUILADA',40,'LOS ENCUENTROS','AVENIDA BUZETA 4534 CERRILLOS',3,2),
	('PROPIA',20,'PABLO NERUDA','AVENIDA HERNANDO DE AGUIRRE 3645',4,3),
	('PROPIA',25,'NICANOR PARRA','AVENIDA NUEVA PROVIDENCIA 2034',4,4),
	('ALQUILADA',20,'MEETING PLACE','65 HANBURY ST, SPITALFIELDS',5,5),
	('ALQUILADA',20,'ADVENTURES PLACE','84 MARYLEBONE HIGH ST MARYLEBONE',5,6),
	('ALQUILADA',30,'CHARLES DICKENS','1620 TURNER STREET NORTHERN QUARTER',6,7),
	('PROPIA',20,'JANE AUSTEN','47 BARLOW MORE ROAD DIDSBURY VILLAGE',6,8);

INSERT INTO asoc_club (id_club,id_club_asoc) VALUES
	(1,2), (1,3), (1,4),
	(2,3), (2,4), (5,6),
	(5,7), (5,8);

INSERT INTO obra_actuada (resumen,precio,titulo,estatus_actividad,duracion,fk_sala) VALUES
	('BASADA EN LA NOVELA DE ORWELL ESTA CINTA NARRA LAS VIDAS DE WINSTON SMITH Y SU AMANTE  EN MEDIO DE UNA SOCIEDAD TOTALITARIA',10,'1984','ACTIVA',113,1),
	('AVENTURAS DE 4 HERMANOS EN UN MUNDO FANTASIOSO LLAMADO NARNIA',12,'NARNIA 1 Y 2','ACTIVA',200,2),
	('LA OBRA ES UNA CONTINUA METÁFORA QUE ALUDE AL HECHO DE QUE INCLUSO ANTES DE CONVERTIRSE EN UN INSECTO, GREGOR YA ESTABA SIENDO TRATADO COMO TAL',15,'LA METAMORFOSIS','ACTIVA',80,3),
	('JUAN PABLO CASTEL ES UN PINTOR RECLUIDO EN PRISIÓN POR EL ASESINATO DE MARÍA IRIBARNE. DURANTE SU ENCIERRO REMEMORA LA CADENA DE ACONTECIMIENTOS QUE LO LLEVARON A PERDER EL CONTROL.',10,'INACTIVA',NULL),
	('EN PLENA ERA FORDIANA, LA SOCIEDAD SE ESTRUCTURA EN UN SISTEMA DE CASTAS EN EL QUE TODOS LOS HUMANOS, DESDE LOS PRIVILEGIADOS ALFAS HASTA LOS DENOSTADOS ÉPSILON, HAN SIDO CREADOS ARTIFICIALMENTE Y CONDICIONADOS PARA DESEMPEÑAR UN DETERMINADO PAPEL SOCIAL',12,'ACTIVA',4),
	('')


INSERT INTO calendario (fecha,id_obra,hora_i,estatus_realizada,cantidad_asistencia) VALUES
();

INSERT INTO personaje (id_obra,nombre,descripcion) VALUES 
();

INSERT INTO hist_lector (fecha_ini,doc_lector,id_club,estatus,motivo_retiro,fecha_fin) VALUES
	('05-15-2019',248012254,5,'ACTIVO',NULL,NULL),
	('07-05-2018',217174421,5,'ACTIVO',NULL,NULL), 
	('07-20-2019',296583972,5,'ACTIVO',NULL,NULL),
	('07-25-2019',284614167,5,'ACTIVO',NULL,NULL),
	('07-25-2019',270098273,5,'ACTIVO',NULL,NULL),
	('06-30-2017',318218935,1,'ACTIVO',NULL,NULL),
	('09-23-2018',335676685,1,'ACTIVO',NULL,NULL),
	('10-14-2019',337599324,1,'ACTIVO',NULL,NULL),
	('05-02-2018',337021440,1,'ACTIVO',NULL,NULL),
	('01-10-2016',336109574,1,'ACTIVO',NULL,NULL),
	('08-12-2018',335351470,1,'ACTIVO',NULL,NULL),	
	('09-10-2016',331832514,1,'ACTIVO',NULL,NULL),
	('10-11-2016',331832514,1,'RETIRADO','VOLUNTARIO',NULL);




















