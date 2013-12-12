CREATE OR REPLACE VIEW public.view_get_personas_init AS
select p.id, ( p.nombre || ' ' || p.apellidos) as nombres , p.edad, to_char(n.creacion,'mm/dd/yy')  as convertido,
(select r.id from red r where r.int_red_id = n.red_id) as red, n.red_id ,
( select (q.nombre || '' || p.apellidos) from persona q where q.id = p.ganado_por) as ganado , p.ganado_por as ganado_id
  from persona p inner join nivel_crecimiento n
on n.persona_id = p.id and n.int_nivelcrecimiento_escala = 0 
where p.activo=true order by n.creacion desc limit 300;
ALTER TABLE public.view_get_personas_init
  OWNER TO actumbes;
  

CREATE OR REPLACE VIEW view_get_personas_all AS 
 SELECT p.id, 
    (p.nombre::text || ' '::text) || p.apellidos::text AS nombres, 
    p.edad, 
    to_char(n.creacion::timestamp with time zone, 'mm/dd/yy'::text) AS convertido, 
    ( SELECT r.id
           FROM red r
          WHERE r.int_red_id = n.red_id) AS red, 
    n.red_id, 
    ( SELECT (q.nombre::text || ''::text) || p.apellidos::text
           FROM persona q
          WHERE q.id = p.ganado_por) AS ganado, 
    p.ganado_por AS ganado_id, 
    (p.telefono::text || '<br>'::text) || p.celular::text AS telefono, 
    '' AS acciones
   FROM persona p
   JOIN nivel_crecimiento n ON n.persona_id = p.id AND n.int_nivelcrecimiento_escala = 0
  WHERE p.activo = true
  ORDER BY n.creacion DESC;

ALTER TABLE view_get_personas_all
  OWNER TO actumbes;

  -- View: view_get_ganador_all

-- DROP VIEW view_get_ganador_all;

CREATE OR REPLACE VIEW view_get_ganador_all AS 
 SELECT persona.id, 
    (persona.nombre::text || ' '::text) || persona.apellidos::text AS label
   FROM persona
  WHERE persona.activo = true;

ALTER TABLE view_get_ganador_all
  OWNER TO actumbes;

ALTER TABLE red
   ADD COLUMN pastor bigint;
  
  
CREATE OR REPLACE VIEW view_get_lider_red_complete_all AS 
 SELECT p.id, 
    (p.nombre::text || ' '::text) || p.apellidos::text AS label
   FROM persona p
   JOIN nivel_crecimiento n ON n.persona_id = p.id AND n.int_nivelcrecimiento_estadoactual = 1 AND n.int_nivelcrecimiento_escala = 2;

ALTER TABLE view_get_lider_red_complete_all
  OWNER TO actumbes;
CREATE OR REPLACE VIEW view_get_pastor_complete_all AS 
 SELECT p.id, 
    (p.nombre::text || ' '::text) || p.apellidos::text AS label
   FROM persona p
   JOIN nivel_crecimiento n ON n.persona_id = p.id AND n.int_nivelcrecimiento_estadoactual = 1 AND n.int_nivelcrecimiento_escala = 11;


 CREATE OR REPLACE FUNCTION get_niveles_complete_red(IN red integer, IN escala integer , IN estado integer,  OUT id bigint, OUT label text)
  RETURNS SETOF record AS
$BODY$
BEGIN

-- escala: 0 => 'ROLE_USER', 1 => 'ROLE_LIDER', 2 => 'ROLE_LIDER_RED', 3 =>'ROLE_CONSOLIDADOR', 
-- 4 => 'ROLE_ESTUDIANTE', 5 => 'ROLE_DOCENTE', 6 => 'ROLE_GANAR',
-- 7 => 'ROLE_CONSOLIDAR', 8 => 'ROLE_ENVIAR', 9=> 'ROLE_DISCIPULAR', 
-- 10 => 'ROLE_TESORERIA', 11 => 'ROLE_PASTOR' , 12 =>'ROLE_ADMIN'

-- estado: 0 desactivo 1 activo

return query SELECT p.id, 
    (p.nombre::text || ' '::text) || p.apellidos::text AS label
   FROM persona p
   JOIN nivel_crecimiento n ON n.persona_id = p.id AND n.int_nivelcrecimiento_estadoactual = estado AND n.int_nivelcrecimiento_escala = escala AND
    p.red_id =red;

return;
 
END;$BODY$
  LANGUAGE plpgsql VOLATILE
  COST 100
  ROWS 10000;



