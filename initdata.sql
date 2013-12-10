CREATE OR REPLACE VIEW public.view_get_personas_init AS
select p.id, ( p.nombre || ' ' || p.apellidos) as nombres , p.edad, to_char(n.creacion,'mm/dd/yy')  as convertido,
(select r.id from red r where r.int_red_id = n.red_id) as red, n.red_id ,
( select (q.nombre || '' || p.apellidos) from persona q where q.id = p.ganado_por) as ganado , p.ganado_por as ganado_id
  from persona p inner join nivel_crecimiento n
on n.persona_id = p.id and n.int_nivelcrecimiento_escala = 0 
where p.activo=true order by n.creacion desc limit 300;
ALTER TABLE public.view_get_personas_init
  OWNER TO actumbes;