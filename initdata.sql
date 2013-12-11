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
