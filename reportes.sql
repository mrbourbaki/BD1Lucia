1)
SELECT l.titulo_original" Titulo", l.titulo_espanol "Titulo en Español",l.tema,l.sinopsis ,cl.nombre "Genero" ,l.nro_pags "Paginas",
 ( e.nombre||', '|| lu.nombre||' ,'|| l.ano) AS "Editorial , Pais y año de publicacion",
 lc.titulo_original" complementario"
FROM ofj_libro l ,ofj_editorial e,ofj_lugar lu,ofj_clase cl , (SELECT cod ,titulo_original FROM ofj_libro) lc  
WHERE  l.fk_editorial=e.cod AND e.fk_lugar =lu.codigo AND l.fk_clase=cl.cod AND l.fk_libro_comp= lc.cod

2)
--PAGOS
SELECT p.id_club_hist_lector AS club, INITCAP(l.nombre1) AS nombre_miembro, INITCAP(l.apellido1) AS apellido_miembro, 
	   p.cod AS número_pago, INITCAP(p.tipo_pago) AS tipo_pago 	
FROM ofj_pago p, ofj_lector l
WHERE l.docidentidad=p.doc_lector_hist_lector
ORDER BY p.id_club_hist_lector,número_pago;
--ASISTENCIAS

--GRUPOS
SELECT INITCAP(c.nombre) AS nombre_club, g.cod AS grupo_lectura, g.tipo_grupo AS tipo_grupo
FROM ofj_club c, ofj_grupo_lectura g
WHERE c.cod=g.id_club 
ORDER BY c.nombre,g.cod;

3)
SELECT DISTINCT c.cod AS Club, TO_CHAR(AVG(a.valoracion),'9.9')  AS Valoración, l.titulo_original AS Nombre_libro
FROM ofj_reunion a, ofj_grupo_lectura g, ofj_libro l, ofj_club c 
WHERE a.id_libro=l.cod AND c.cod=a.id_club_grupo
GROUP BY c.cod, a.id_libro, l.titulo_original
ORDER BY  Club, Valoración;

4)
SELECT   s.Nombre_lector, s.Apellido_lector, ROUND((s.Inasistencias::DECIMAL/s.Cantidad_reuniones)*100) AS Porcentaje_inasistencias
                 FROM (SELECT COUNT(l.docidentidad) AS Inasistencias,l.nombre1 AS Nombre_lector, l.apellido1 AS Apellido_lector, c.cantidad AS Cantidad_Reuniones
                        FROM ofj_reunion r, ofj_inasistencia i, ofj_lector l, ofj_grupo_lectura g,(SELECT COUNT(r.id_grupo)  AS cantidad, r.id_club_grupo AS grupo FROM ofj_reunion r, ofj_grupo_lectura g WHERE g.cod=r.id_grupo AND r.fecha BETWEEN '04/11/2019' AND '11/11/2019' GROUP BY g.cod,grupo) c
                        WHERE i.id_reunion=r.cod AND l.docidentidad=i.doc_lector AND g.cod=r.id_grupo AND g.cod=c.grupo AND g.id_club=1
                        GROUP BY   l.nombre1, l.apellido1, c.cantidad) s
                 WHERE (s.Inasistencias::DECIMAL/s.Cantidad_reuniones) >= 0.30
                 GROUP BY s.Nombre_lector, s.Apellido_lector, s.Inasistencias , s.Cantidad_reuniones;

5)

6)
SELECT INITCAP(o.titulo) AS titulo_obra, INITCAP(p.nombre) AS personaje, INITCAP(l.nombre1) AS Nombre_actor,
	   INITCAP(l.apellido1) AS Apellido_actor
FROM ofj_obra_actuada o, ofj_personaje p, ofj_lector l, ofj_elenco e
WHERE o.cod=p.id_obra AND p.cod=e.id_personaje AND l.docidentidad=e.doc_lector_hist_lector
ORDER BY titulo_obra;



7)
SELECT l.docidentidad AS Documento_identidad, INITCAP(l.nombre1) AS Primer_nombre , INITCAP(l.nombre2) AS Segundo_Nombre, 
INITCAP(l.apellido1) AS Primer_Apellido, INITCAP(l.apellido2) AS Segundo_Apellido, l.genero AS Genero, lu.nacionalidad AS Nacionalidad,
INITCAP(lu.nombre) AS País, l.telefono AS Teléfono, INITCAP(L1.titulo) AS Libro1,INITCAP(L2.titulo) AS Libro2, INITCAP(L3.titulo) AS Libro3
FROM ofj_lector l, ofj_representante_externo r, ofj_lugar lu,
	(SELECT  l.id_libro, l.doc_lector AS docidentidad, li.titulo_original AS titulo FROM ofj_lec_libro l, ofj_libro li WHERE li.cod=l.id_libro AND l.posicion=1) AS L1,
	(SELECT  l.id_libro, l.doc_lector AS docidentidad, li.titulo_original AS titulo FROM ofj_lec_libro l, ofj_libro li WHERE li.cod=l.id_libro AND l.posicion=2) AS L2,
	(SELECT  l.id_libro, l.doc_lector AS docidentidad, li.titulo_original AS titulo FROM ofj_lec_libro l, ofj_libro li WHERE li.cod=l.id_libro AND l.posicion=3) AS L3
WHERE l.fk_nacionalidad=lu.codigo AND L1.docidentidad=l.docidentidad AND L2.docidentidad=l.docidentidad
	  AND L3.docidentidad=l.docidentidad
GROUP BY l.docidentidad, l.nombre1, l.nombre2, l.apellido1, l.apellido2,l.genero, lu.nacionalidad,l.telefono,
		 L1.titulo,L2.titulo,L3.titulo; 


8)
SELECT TO_CHAR(MAX(r.fecha),'DD" de "MON" de "YYYY') AS fecha_analizado, r.id_club_grupo AS grupo, INITCAP(l.titulo_original) AS título_libro
FROM ofj_reunion r, ofj_libro l
WHERE r.id_libro=l.cod
GROUP BY título_libro, grupo
ORDER BY fecha_analizado;

9)
SELECT  INITCAP(o.titulo) AS nombre_obra, TO_CHAR(AVG(g.valoracion),'9.9') AS valoracion_global, c.valoracion AS valoración_obra, 
	   INITCAP(l.nombre1) AS nombre_mejor_actor, INITCAP(l.apellido1) AS apellido_mejor_actor 
FROM ofj_obra_actuada o, ofj_mejor_actor m, ofj_lector l,ofj_calendario c,
	 (SELECT c.id_obra AS id_obra,c.valoracion AS valoracion FROM ofj_calendario c) AS g
WHERE o.cod=c.id_obra AND l.docidentidad=m.doc_lector_hist_elenco AND m.fecha_cal=c.fecha AND c.valoracion IS NOT NULL
      AND g.id_obra=c.id_obra 
GROUP BY o.titulo,valoración_obra,nombre_mejor_actor,apellido_mejor_actor
ORDER BY o.titulo;

10)

11)
SELECT INITCAP(o.titulo) AS Título, SUM(c.cantidad_asistencia * o.precio) AS Ganancias_generadas, TO_CHAR(AVG(c.valoracion),'9') AS Valoración
FROM ofj_obra_actuada o, ofj_calendario c 
WHERE o.cod=c.id_obra AND c.fecha BETWEEN Fecha_i AND Fecha_f
GROUP BY o.titulo; 

