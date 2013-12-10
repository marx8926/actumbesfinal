--
-- PostgreSQL database dump
--

-- Dumped from database version 9.3.1
-- Dumped by pg_dump version 9.3.1
-- Started on 2013-12-10 09:59:05

SET statement_timeout = 0;
SET lock_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SET check_function_bodies = false;
SET client_min_messages = warning;

--
-- TOC entry 2112 (class 1262 OID 68201)
-- Name: AE_Final_dev; Type: DATABASE; Schema: -; Owner: postgres
--

SET statement_timeout = 0;
SET lock_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SET check_function_bodies = false;
SET client_min_messages = warning;

--
-- TOC entry 205 (class 3079 OID 11750)
-- Name: plpgsql; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS plpgsql WITH SCHEMA pg_catalog;


--
-- TOC entry 2115 (class 0 OID 0)
-- Dependencies: 205
-- Name: EXTENSION plpgsql; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION plpgsql IS 'PL/pgSQL procedural language';


SET search_path = public, pg_catalog;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- TOC entry 175 (class 1259 OID 68204)
-- Name: ae_user; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE ae_user (
    id integer NOT NULL,
    username character varying(255) NOT NULL,
    username_canonical character varying(255) NOT NULL,
    email character varying(255) NOT NULL,
    email_canonical character varying(255) NOT NULL,
    enabled boolean NOT NULL,
    salt character varying(255) NOT NULL,
    password character varying(255) NOT NULL,
    last_login timestamp(0) without time zone DEFAULT NULL::timestamp without time zone,
    locked boolean NOT NULL,
    expired boolean NOT NULL,
    expires_at timestamp(0) without time zone DEFAULT NULL::timestamp without time zone,
    confirmation_token character varying(255) DEFAULT NULL::character varying,
    password_requested_at timestamp(0) without time zone DEFAULT NULL::timestamp without time zone,
    roles text NOT NULL,
    credentials_expired boolean NOT NULL,
    credentials_expire_at timestamp(0) without time zone DEFAULT NULL::timestamp without time zone,
    id_persona bigint
);


ALTER TABLE public.ae_user OWNER TO postgres;

--
-- TOC entry 2116 (class 0 OID 0)
-- Dependencies: 175
-- Name: COLUMN ae_user.roles; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN ae_user.roles IS '(DC2Type:array)';


--
-- TOC entry 174 (class 1259 OID 68202)
-- Name: ae_user_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE ae_user_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.ae_user_id_seq OWNER TO postgres;

--
-- TOC entry 204 (class 1259 OID 68648)
-- Name: archivo; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE archivo (
    id bigint NOT NULL,
    direccion text NOT NULL,
    peso bigint,
    tipo character varying(25),
    extension character varying(10),
    nombre text,
    fecha date,
    id_tema_celula integer,
    id_tema_curso integer,
    id_leche_espiritual integer
);


ALTER TABLE public.archivo OWNER TO postgres;

--
-- TOC entry 2117 (class 0 OID 0)
-- Dependencies: 204
-- Name: COLUMN archivo.peso; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN archivo.peso IS 'tamaño del archivo en Bytes';


--
-- TOC entry 2118 (class 0 OID 0)
-- Dependencies: 204
-- Name: COLUMN archivo.tipo; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN archivo.tipo IS 'el tipo de archivo: PDF, EXCEL, WORD, CORELDRAW, etc.';


--
-- TOC entry 2119 (class 0 OID 0)
-- Dependencies: 204
-- Name: COLUMN archivo.extension; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN archivo.extension IS 'la extension que tiene el archivo: .pdf, .xls, .xlsx, .doc, .docx, etc';


--
-- TOC entry 2120 (class 0 OID 0)
-- Dependencies: 204
-- Name: COLUMN archivo.id_leche_espiritual; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN archivo.id_leche_espiritual IS 'Identificador de la clase leche';


--
-- TOC entry 203 (class 1259 OID 68646)
-- Name: archivo_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE archivo_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.archivo_id_seq OWNER TO postgres;

--
-- TOC entry 2121 (class 0 OID 0)
-- Dependencies: 203
-- Name: archivo_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE archivo_id_seq OWNED BY archivo.id;


--
-- TOC entry 192 (class 1259 OID 68537)
-- Name: celula; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE celula (
    id bigint NOT NULL,
    fecha_creacion date NOT NULL,
    tipo smallint NOT NULL,
    familia character varying(100) NOT NULL,
    telefono character varying(20),
    id_ubicacion bigint NOT NULL,
    id_red integer,
    activo boolean DEFAULT true,
    dia character varying(25) DEFAULT 'Miercoles'::character varying,
    hora character varying(10) DEFAULT '00:00:00'::character varying
);


ALTER TABLE public.celula OWNER TO postgres;

--
-- TOC entry 2122 (class 0 OID 0)
-- Dependencies: 192
-- Name: COLUMN celula.tipo; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN celula.tipo IS 'Evangelica, Discipulado';


--
-- TOC entry 2123 (class 0 OID 0)
-- Dependencies: 192
-- Name: COLUMN celula.familia; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN celula.familia IS 'Nombre de la familia que acoge la célula';


--
-- TOC entry 2124 (class 0 OID 0)
-- Dependencies: 192
-- Name: COLUMN celula.id_ubicacion; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN celula.id_ubicacion IS 'Identificador de la Ubicación, en este caso es un entero autoincremental';


--
-- TOC entry 2125 (class 0 OID 0)
-- Dependencies: 192
-- Name: COLUMN celula.dia; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN celula.dia IS 'dia de dictado de célula';


--
-- TOC entry 191 (class 1259 OID 68535)
-- Name: celula_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE celula_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.celula_id_seq OWNER TO postgres;

--
-- TOC entry 2126 (class 0 OID 0)
-- Dependencies: 191
-- Name: celula_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE celula_id_seq OWNED BY celula.id;


--
-- TOC entry 198 (class 1259 OID 68599)
-- Name: curso; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE curso (
    id bigint NOT NULL,
    fecha_creacion date NOT NULL,
    descripcion text NOT NULL,
    numero_sesiones smallint NOT NULL,
    activo boolean DEFAULT true NOT NULL,
    titulo character varying(120)
);


ALTER TABLE public.curso OWNER TO postgres;

--
-- TOC entry 197 (class 1259 OID 68597)
-- Name: curso_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE curso_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.curso_id_seq OWNER TO postgres;

--
-- TOC entry 2127 (class 0 OID 0)
-- Dependencies: 197
-- Name: curso_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE curso_id_seq OWNED BY curso.id;


--
-- TOC entry 180 (class 1259 OID 68240)
-- Name: iglesia; Type: TABLE; Schema: public; Owner: actumbes; Tablespace: 
--

CREATE TABLE iglesia (
    int_iglesia_id bigint NOT NULL,
    dat_iglesia_fecregistro time without time zone,
    dat_iglesia_fecreacion date,
    var_iglesia_telefono character(18),
    var_iglesia_siglas character(20),
    var_iglesia_nombre character(150),
    var_iglesia_direccion character(150),
    var_iglesia_referencia character(150),
    dou_iglesia_longitud double precision,
    dou_iglesia_latitud double precision,
    ubigeo_id integer
);


ALTER TABLE public.iglesia OWNER TO actumbes;

--
-- TOC entry 178 (class 1259 OID 68236)
-- Name: iglesia_int_iglesia_id_seq; Type: SEQUENCE; Schema: public; Owner: actumbes
--

CREATE SEQUENCE iglesia_int_iglesia_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.iglesia_int_iglesia_id_seq OWNER TO actumbes;

--
-- TOC entry 2128 (class 0 OID 0)
-- Dependencies: 178
-- Name: iglesia_int_iglesia_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: actumbes
--

ALTER SEQUENCE iglesia_int_iglesia_id_seq OWNED BY iglesia.int_iglesia_id;


--
-- TOC entry 179 (class 1259 OID 68238)
-- Name: iglesia_ubigeo_id_seq; Type: SEQUENCE; Schema: public; Owner: actumbes
--

CREATE SEQUENCE iglesia_ubigeo_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.iglesia_ubigeo_id_seq OWNER TO actumbes;

--
-- TOC entry 2129 (class 0 OID 0)
-- Dependencies: 179
-- Name: iglesia_ubigeo_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: actumbes
--

ALTER SEQUENCE iglesia_ubigeo_id_seq OWNED BY iglesia.ubigeo_id;


--
-- TOC entry 194 (class 1259 OID 68574)
-- Name: leche_espiritual; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE leche_espiritual (
    id integer NOT NULL,
    nombre character varying(100) NOT NULL,
    resumen text NOT NULL,
    fecha_creacion date NOT NULL
);


ALTER TABLE public.leche_espiritual OWNER TO postgres;

--
-- TOC entry 2130 (class 0 OID 0)
-- Dependencies: 194
-- Name: TABLE leche_espiritual; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON TABLE leche_espiritual IS 'Tabla enla que se almacenan las clase de leche espiritual';


--
-- TOC entry 2131 (class 0 OID 0)
-- Dependencies: 194
-- Name: COLUMN leche_espiritual.id; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN leche_espiritual.id IS 'Identificador de la clase leche';


--
-- TOC entry 193 (class 1259 OID 68572)
-- Name: leche_espiritual_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE leche_espiritual_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.leche_espiritual_id_seq OWNER TO postgres;

--
-- TOC entry 2132 (class 0 OID 0)
-- Dependencies: 193
-- Name: leche_espiritual_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE leche_espiritual_id_seq OWNED BY leche_espiritual.id;


--
-- TOC entry 186 (class 1259 OID 68419)
-- Name: lugar; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE lugar (
    int_lugar_id integer NOT NULL,
    var_lugar_descripcion character varying(100),
    var_lugar_estado character varying(1)
);


ALTER TABLE public.lugar OWNER TO postgres;

--
-- TOC entry 185 (class 1259 OID 68417)
-- Name: lugar_int_lugar_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE lugar_int_lugar_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.lugar_int_lugar_id_seq OWNER TO postgres;

--
-- TOC entry 2133 (class 0 OID 0)
-- Dependencies: 185
-- Name: lugar_int_lugar_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE lugar_int_lugar_id_seq OWNED BY lugar.int_lugar_id;


--
-- TOC entry 190 (class 1259 OID 68497)
-- Name: nivel_crecimiento; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE nivel_crecimiento (
    int_nivelcrecimiento_id bigint NOT NULL,
    int_nivelcrecimiento_escala integer,
    int_nivelcrecimiento_estadoactual integer,
    persona_id bigint,
    red_id integer,
    celula_id integer,
    creacion date
);


ALTER TABLE public.nivel_crecimiento OWNER TO postgres;

--
-- TOC entry 189 (class 1259 OID 68495)
-- Name: nivel_crecimiento_int_nivelcrecimiento_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE nivel_crecimiento_int_nivelcrecimiento_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.nivel_crecimiento_int_nivelcrecimiento_id_seq OWNER TO postgres;

--
-- TOC entry 2134 (class 0 OID 0)
-- Dependencies: 189
-- Name: nivel_crecimiento_int_nivelcrecimiento_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE nivel_crecimiento_int_nivelcrecimiento_id_seq OWNED BY nivel_crecimiento.int_nivelcrecimiento_id;


--
-- TOC entry 182 (class 1259 OID 68326)
-- Name: persona; Type: TABLE; Schema: public; Owner: actumbes; Tablespace: 
--

CREATE TABLE persona (
    id bigint NOT NULL,
    nombre character varying(150) NOT NULL,
    apellidos character varying(100) NOT NULL,
    estado_civil smallint NOT NULL,
    edad smallint NOT NULL,
    telefono character varying(20),
    celular character varying(20),
    fecha_nacimiento date NOT NULL,
    email character varying(100),
    website character varying(100),
    sexo smallint NOT NULL,
    id_ubicacion integer,
    id_iglesia bigint,
    dni character varying(10),
    ocupacion character varying(150),
    lugar_id integer,
    red_id integer,
    activo boolean DEFAULT true,
    ganado_por bigint,
    peticion character varying(300),
    dia character varying(30),
    hora character varying(10)
);


ALTER TABLE public.persona OWNER TO actumbes;

--
-- TOC entry 2135 (class 0 OID 0)
-- Dependencies: 182
-- Name: TABLE persona; Type: COMMENT; Schema: public; Owner: actumbes
--

COMMENT ON TABLE persona IS 'Tabla en la que se almacena la imformacion básica de la persona';


--
-- TOC entry 2136 (class 0 OID 0)
-- Dependencies: 182
-- Name: COLUMN persona.id; Type: COMMENT; Schema: public; Owner: actumbes
--

COMMENT ON COLUMN persona.id IS 'Identificador de la persona';


--
-- TOC entry 2137 (class 0 OID 0)
-- Dependencies: 182
-- Name: COLUMN persona.nombre; Type: COMMENT; Schema: public; Owner: actumbes
--

COMMENT ON COLUMN persona.nombre IS 'Nombres de la persona';


--
-- TOC entry 2138 (class 0 OID 0)
-- Dependencies: 182
-- Name: COLUMN persona.apellidos; Type: COMMENT; Schema: public; Owner: actumbes
--

COMMENT ON COLUMN persona.apellidos IS 'Apellidos de la persona';


--
-- TOC entry 2139 (class 0 OID 0)
-- Dependencies: 182
-- Name: COLUMN persona.estado_civil; Type: COMMENT; Schema: public; Owner: actumbes
--

COMMENT ON COLUMN persona.estado_civil IS 'Estado civil de la persona:
0 - Soltero,
1 - Casado,
2 - Viudo,
3 - Divorciado';


--
-- TOC entry 2140 (class 0 OID 0)
-- Dependencies: 182
-- Name: COLUMN persona.edad; Type: COMMENT; Schema: public; Owner: actumbes
--

COMMENT ON COLUMN persona.edad IS 'Edad de la persona';


--
-- TOC entry 2141 (class 0 OID 0)
-- Dependencies: 182
-- Name: COLUMN persona.telefono; Type: COMMENT; Schema: public; Owner: actumbes
--

COMMENT ON COLUMN persona.telefono IS 'telefono fijo de la persona';


--
-- TOC entry 2142 (class 0 OID 0)
-- Dependencies: 182
-- Name: COLUMN persona.celular; Type: COMMENT; Schema: public; Owner: actumbes
--

COMMENT ON COLUMN persona.celular IS 'Telefono celular de la persona';


--
-- TOC entry 2143 (class 0 OID 0)
-- Dependencies: 182
-- Name: COLUMN persona.fecha_nacimiento; Type: COMMENT; Schema: public; Owner: actumbes
--

COMMENT ON COLUMN persona.fecha_nacimiento IS 'Fecha en la que nació la persona';


--
-- TOC entry 2144 (class 0 OID 0)
-- Dependencies: 182
-- Name: COLUMN persona.email; Type: COMMENT; Schema: public; Owner: actumbes
--

COMMENT ON COLUMN persona.email IS 'Dirección e-mail de la persona';


--
-- TOC entry 2145 (class 0 OID 0)
-- Dependencies: 182
-- Name: COLUMN persona.website; Type: COMMENT; Schema: public; Owner: actumbes
--

COMMENT ON COLUMN persona.website IS 'Página web de la persona';


--
-- TOC entry 2146 (class 0 OID 0)
-- Dependencies: 182
-- Name: COLUMN persona.sexo; Type: COMMENT; Schema: public; Owner: actumbes
--

COMMENT ON COLUMN persona.sexo IS 'Sexo de la persona:1-Masculino2-femenino';


--
-- TOC entry 2147 (class 0 OID 0)
-- Dependencies: 182
-- Name: COLUMN persona.id_ubicacion; Type: COMMENT; Schema: public; Owner: actumbes
--

COMMENT ON COLUMN persona.id_ubicacion IS 'Identificador de la Ubicación, en este caso es un entero autoincremental';


--
-- TOC entry 2148 (class 0 OID 0)
-- Dependencies: 182
-- Name: COLUMN persona.id_iglesia; Type: COMMENT; Schema: public; Owner: actumbes
--

COMMENT ON COLUMN persona.id_iglesia IS 'Identificador de la iglesia';


--
-- TOC entry 2149 (class 0 OID 0)
-- Dependencies: 182
-- Name: COLUMN persona.dni; Type: COMMENT; Schema: public; Owner: actumbes
--

COMMENT ON COLUMN persona.dni IS 'dni de la persona';


--
-- TOC entry 2150 (class 0 OID 0)
-- Dependencies: 182
-- Name: COLUMN persona.ocupacion; Type: COMMENT; Schema: public; Owner: actumbes
--

COMMENT ON COLUMN persona.ocupacion IS 'ocupación de la persona';


--
-- TOC entry 181 (class 1259 OID 68324)
-- Name: persona_id_seq; Type: SEQUENCE; Schema: public; Owner: actumbes
--

CREATE SEQUENCE persona_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.persona_id_seq OWNER TO actumbes;

--
-- TOC entry 2151 (class 0 OID 0)
-- Dependencies: 181
-- Name: persona_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: actumbes
--

ALTER SEQUENCE persona_id_seq OWNED BY persona.id;


--
-- TOC entry 184 (class 1259 OID 68407)
-- Name: red; Type: TABLE; Schema: public; Owner: actumbes; Tablespace: 
--

CREATE TABLE red (
    int_red_id integer NOT NULL,
    id character varying(10),
    id_ubicacion bigint,
    inicio date,
    activo boolean,
    lider bigint
);


ALTER TABLE public.red OWNER TO actumbes;

--
-- TOC entry 183 (class 1259 OID 68405)
-- Name: red_int_red_id_seq; Type: SEQUENCE; Schema: public; Owner: actumbes
--

CREATE SEQUENCE red_int_red_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.red_int_red_id_seq OWNER TO actumbes;

--
-- TOC entry 2152 (class 0 OID 0)
-- Dependencies: 183
-- Name: red_int_red_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: actumbes
--

ALTER SEQUENCE red_int_red_id_seq OWNED BY red.int_red_id;


--
-- TOC entry 200 (class 1259 OID 68620)
-- Name: tema_celula; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE tema_celula (
    id integer NOT NULL,
    titutlo character varying(100) NOT NULL,
    autor character varying(70) NOT NULL,
    descripcion text NOT NULL,
    fecha date,
    tipo character varying(20)
);


ALTER TABLE public.tema_celula OWNER TO postgres;

--
-- TOC entry 199 (class 1259 OID 68618)
-- Name: tema_celula_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE tema_celula_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.tema_celula_id_seq OWNER TO postgres;

--
-- TOC entry 2153 (class 0 OID 0)
-- Dependencies: 199
-- Name: tema_celula_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE tema_celula_id_seq OWNED BY tema_celula.id;


--
-- TOC entry 202 (class 1259 OID 68631)
-- Name: tema_curso; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE tema_curso (
    id integer NOT NULL,
    activo boolean DEFAULT true NOT NULL,
    fecha_creacion date NOT NULL,
    descripcion text NOT NULL,
    tipo smallint NOT NULL,
    id_curso bigint NOT NULL
);


ALTER TABLE public.tema_curso OWNER TO postgres;

--
-- TOC entry 2154 (class 0 OID 0)
-- Dependencies: 202
-- Name: COLUMN tema_curso.tipo; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN tema_curso.tipo IS 'define si el tema es Sesion o es Extra.';


--
-- TOC entry 201 (class 1259 OID 68629)
-- Name: tema_curso_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE tema_curso_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.tema_curso_id_seq OWNER TO postgres;

--
-- TOC entry 2155 (class 0 OID 0)
-- Dependencies: 201
-- Name: tema_curso_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE tema_curso_id_seq OWNED BY tema_curso.id;


--
-- TOC entry 196 (class 1259 OID 68586)
-- Name: tema_leche; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE tema_leche (
    id integer NOT NULL,
    titulo character varying(100),
    id_leche_espiritual integer NOT NULL
);


ALTER TABLE public.tema_leche OWNER TO postgres;

--
-- TOC entry 2156 (class 0 OID 0)
-- Dependencies: 196
-- Name: COLUMN tema_leche.id_leche_espiritual; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN tema_leche.id_leche_espiritual IS 'Identificador de la clase leche';


--
-- TOC entry 195 (class 1259 OID 68584)
-- Name: tema_leche_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE tema_leche_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.tema_leche_id_seq OWNER TO postgres;

--
-- TOC entry 2157 (class 0 OID 0)
-- Dependencies: 195
-- Name: tema_leche_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE tema_leche_id_seq OWNED BY tema_leche.id;


--
-- TOC entry 188 (class 1259 OID 68443)
-- Name: ubicacion; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE ubicacion (
    id bigint NOT NULL,
    direccion character varying(150) NOT NULL,
    latitud double precision NOT NULL,
    longitud double precision NOT NULL,
    referencia text,
    ubigeo_id integer
);


ALTER TABLE public.ubicacion OWNER TO postgres;

--
-- TOC entry 2158 (class 0 OID 0)
-- Dependencies: 188
-- Name: TABLE ubicacion; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON TABLE ubicacion IS 'Tabla en la que se almacena la ubicación de lapersona, iglesia, red, celula u otra entidad';


--
-- TOC entry 2159 (class 0 OID 0)
-- Dependencies: 188
-- Name: COLUMN ubicacion.id; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN ubicacion.id IS 'Identificador de la Ubicación, en este caso es un entero autoincremental';


--
-- TOC entry 2160 (class 0 OID 0)
-- Dependencies: 188
-- Name: COLUMN ubicacion.direccion; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN ubicacion.direccion IS 'Direccion de la vivienda';


--
-- TOC entry 2161 (class 0 OID 0)
-- Dependencies: 188
-- Name: COLUMN ubicacion.latitud; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN ubicacion.latitud IS 'Latitud y Longitud.';


--
-- TOC entry 2162 (class 0 OID 0)
-- Dependencies: 188
-- Name: COLUMN ubicacion.referencia; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN ubicacion.referencia IS 'Una breve descripción del entorno cerda de la ubicación';


--
-- TOC entry 187 (class 1259 OID 68441)
-- Name: ubicacion_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE ubicacion_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.ubicacion_id_seq OWNER TO postgres;

--
-- TOC entry 2163 (class 0 OID 0)
-- Dependencies: 187
-- Name: ubicacion_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE ubicacion_id_seq OWNED BY ubicacion.id;


--
-- TOC entry 177 (class 1259 OID 68229)
-- Name: ubigeos; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE ubigeos (
    int_ubigeo_id integer NOT NULL,
    string_ubigeo_descripcion character varying(50),
    int_ubigeo_departamento integer,
    int_ubigeo_provincia integer,
    int_ubigeo_distrito integer,
    int_ubigeo_dependencia integer,
    float_ubigeo_latitud double precision,
    float_ubigeo_longitud double precision
);


ALTER TABLE public.ubigeos OWNER TO postgres;

--
-- TOC entry 176 (class 1259 OID 68227)
-- Name: ubigeos_int_ubigeo_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE ubigeos_int_ubigeo_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.ubigeos_int_ubigeo_id_seq OWNER TO postgres;

--
-- TOC entry 2164 (class 0 OID 0)
-- Dependencies: 176
-- Name: ubigeos_int_ubigeo_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE ubigeos_int_ubigeo_id_seq OWNED BY ubigeos.int_ubigeo_id;


--
-- TOC entry 1943 (class 2604 OID 68651)
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY archivo ALTER COLUMN id SET DEFAULT nextval('archivo_id_seq'::regclass);


--
-- TOC entry 1932 (class 2604 OID 68540)
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY celula ALTER COLUMN id SET DEFAULT nextval('celula_id_seq'::regclass);


--
-- TOC entry 1938 (class 2604 OID 68602)
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY curso ALTER COLUMN id SET DEFAULT nextval('curso_id_seq'::regclass);


--
-- TOC entry 1936 (class 2604 OID 68577)
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY leche_espiritual ALTER COLUMN id SET DEFAULT nextval('leche_espiritual_id_seq'::regclass);


--
-- TOC entry 1929 (class 2604 OID 68422)
-- Name: int_lugar_id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY lugar ALTER COLUMN int_lugar_id SET DEFAULT nextval('lugar_int_lugar_id_seq'::regclass);


--
-- TOC entry 1931 (class 2604 OID 68500)
-- Name: int_nivelcrecimiento_id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY nivel_crecimiento ALTER COLUMN int_nivelcrecimiento_id SET DEFAULT nextval('nivel_crecimiento_int_nivelcrecimiento_id_seq'::regclass);


--
-- TOC entry 1928 (class 2604 OID 68410)
-- Name: int_red_id; Type: DEFAULT; Schema: public; Owner: actumbes
--

ALTER TABLE ONLY red ALTER COLUMN int_red_id SET DEFAULT nextval('red_int_red_id_seq'::regclass);


--
-- TOC entry 1940 (class 2604 OID 68623)
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tema_celula ALTER COLUMN id SET DEFAULT nextval('tema_celula_id_seq'::regclass);


--
-- TOC entry 1941 (class 2604 OID 68634)
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tema_curso ALTER COLUMN id SET DEFAULT nextval('tema_curso_id_seq'::regclass);


--
-- TOC entry 1937 (class 2604 OID 68589)
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tema_leche ALTER COLUMN id SET DEFAULT nextval('tema_leche_id_seq'::regclass);


--
-- TOC entry 1930 (class 2604 OID 68446)
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY ubicacion ALTER COLUMN id SET DEFAULT nextval('ubicacion_id_seq'::regclass);


--
-- TOC entry 1945 (class 2606 OID 68216)
-- Name: ae_user_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY ae_user
    ADD CONSTRAINT ae_user_pkey PRIMARY KEY (id);


--
-- TOC entry 1951 (class 2606 OID 68249)
-- Name: id_iglesia; Type: CONSTRAINT; Schema: public; Owner: actumbes; Tablespace: 
--

ALTER TABLE ONLY iglesia
    ADD CONSTRAINT id_iglesia PRIMARY KEY (int_iglesia_id);


--
-- TOC entry 1960 (class 2606 OID 68424)
-- Name: lugar_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY lugar
    ADD CONSTRAINT lugar_pkey PRIMARY KEY (int_lugar_id);


--
-- TOC entry 1966 (class 2606 OID 68502)
-- Name: nivel_crecimientos_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY nivel_crecimiento
    ADD CONSTRAINT nivel_crecimientos_pkey PRIMARY KEY (int_nivelcrecimiento_id);


--
-- TOC entry 1985 (class 2606 OID 68656)
-- Name: pk_archivo; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY archivo
    ADD CONSTRAINT pk_archivo PRIMARY KEY (id);


--
-- TOC entry 1969 (class 2606 OID 68545)
-- Name: pk_celula; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY celula
    ADD CONSTRAINT pk_celula PRIMARY KEY (id);


--
-- TOC entry 1976 (class 2606 OID 68608)
-- Name: pk_curso; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY curso
    ADD CONSTRAINT pk_curso PRIMARY KEY (id);


--
-- TOC entry 1971 (class 2606 OID 68582)
-- Name: pk_leche_espiritual; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY leche_espiritual
    ADD CONSTRAINT pk_leche_espiritual PRIMARY KEY (id);


--
-- TOC entry 1955 (class 2606 OID 68334)
-- Name: pk_persona; Type: CONSTRAINT; Schema: public; Owner: actumbes; Tablespace: 
--

ALTER TABLE ONLY persona
    ADD CONSTRAINT pk_persona PRIMARY KEY (id);


--
-- TOC entry 1958 (class 2606 OID 68412)
-- Name: pk_red; Type: CONSTRAINT; Schema: public; Owner: actumbes; Tablespace: 
--

ALTER TABLE ONLY red
    ADD CONSTRAINT pk_red PRIMARY KEY (int_red_id);


--
-- TOC entry 1978 (class 2606 OID 68628)
-- Name: pk_tema_celula; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY tema_celula
    ADD CONSTRAINT pk_tema_celula PRIMARY KEY (id);


--
-- TOC entry 1980 (class 2606 OID 68640)
-- Name: pk_tema_curso; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY tema_curso
    ADD CONSTRAINT pk_tema_curso PRIMARY KEY (id);


--
-- TOC entry 1973 (class 2606 OID 68591)
-- Name: pk_tema_leche; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY tema_leche
    ADD CONSTRAINT pk_tema_leche PRIMARY KEY (id);


--
-- TOC entry 1963 (class 2606 OID 68451)
-- Name: pk_ubicación; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY ubicacion
    ADD CONSTRAINT "pk_ubicación" PRIMARY KEY (id);


--
-- TOC entry 1949 (class 2606 OID 68234)
-- Name: ubigeos_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY ubigeos
    ADD CONSTRAINT ubigeos_pkey PRIMARY KEY (int_ubigeo_id);


--
-- TOC entry 1967 (class 1259 OID 68571)
-- Name: fki_celula_red; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX fki_celula_red ON celula USING btree (id_red);


--
-- TOC entry 1956 (class 1259 OID 68482)
-- Name: fki_lider_red; Type: INDEX; Schema: public; Owner: actumbes; Tablespace: 
--

CREATE INDEX fki_lider_red ON red USING btree (lider);


--
-- TOC entry 1952 (class 1259 OID 68473)
-- Name: fki_ubicacion; Type: INDEX; Schema: public; Owner: actumbes; Tablespace: 
--

CREATE INDEX fki_ubicacion ON persona USING btree (id_ubicacion);


--
-- TOC entry 1953 (class 1259 OID 68350)
-- Name: idpersona; Type: INDEX; Schema: public; Owner: actumbes; Tablespace: 
--

CREATE INDEX idpersona ON persona USING btree (id);


--
-- TOC entry 1961 (class 1259 OID 68452)
-- Name: idubicacion; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX idubicacion ON ubicacion USING btree (id);


--
-- TOC entry 1974 (class 1259 OID 68609)
-- Name: indcurso; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX indcurso ON curso USING btree (id);


--
-- TOC entry 1964 (class 1259 OID 68660)
-- Name: index_nivel_crecimientos_on_persona_id; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX index_nivel_crecimientos_on_persona_id ON nivel_crecimiento USING btree (persona_id);


--
-- TOC entry 1981 (class 1259 OID 68657)
-- Name: indid; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX indid ON archivo USING btree (id);


--
-- TOC entry 1982 (class 1259 OID 68658)
-- Name: indireccion; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX indireccion ON archivo USING btree (direccion);


--
-- TOC entry 1983 (class 1259 OID 68659)
-- Name: indnombre; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX indnombre ON archivo USING btree (nombre);


--
-- TOC entry 1946 (class 1259 OID 68217)
-- Name: uniq_fe00578992fc23a8; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX uniq_fe00578992fc23a8 ON ae_user USING btree (username_canonical);


--
-- TOC entry 1947 (class 1259 OID 68218)
-- Name: uniq_fe005789a0d96fbf; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX uniq_fe005789a0d96fbf ON ae_user USING btree (email_canonical);


--
-- TOC entry 2000 (class 2606 OID 68641)
-- Name: curso_fk; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tema_curso
    ADD CONSTRAINT curso_fk FOREIGN KEY (id_curso) REFERENCES curso(id) MATCH FULL ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- TOC entry 1989 (class 2606 OID 68425)
-- Name: fk_51e5b69bb5a3803b; Type: FK CONSTRAINT; Schema: public; Owner: actumbes
--

ALTER TABLE ONLY persona
    ADD CONSTRAINT fk_51e5b69bb5a3803b FOREIGN KEY (lugar_id) REFERENCES lugar(int_lugar_id);


--
-- TOC entry 1988 (class 2606 OID 68390)
-- Name: fk_51e5b69bc0298a8e; Type: FK CONSTRAINT; Schema: public; Owner: actumbes
--

ALTER TABLE ONLY persona
    ADD CONSTRAINT fk_51e5b69bc0298a8e FOREIGN KEY (id_iglesia) REFERENCES iglesia(int_iglesia_id);


--
-- TOC entry 1998 (class 2606 OID 68566)
-- Name: fk_celula_red; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY celula
    ADD CONSTRAINT fk_celula_red FOREIGN KEY (id_red) REFERENCES red(int_red_id);


--
-- TOC entry 1992 (class 2606 OID 68477)
-- Name: fk_lider_red; Type: FK CONSTRAINT; Schema: public; Owner: actumbes
--

ALTER TABLE ONLY red
    ADD CONSTRAINT fk_lider_red FOREIGN KEY (lider) REFERENCES persona(id);


--
-- TOC entry 1996 (class 2606 OID 68561)
-- Name: fk_nivel_celula; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY nivel_crecimiento
    ADD CONSTRAINT fk_nivel_celula FOREIGN KEY (celula_id) REFERENCES celula(id);


--
-- TOC entry 1997 (class 2606 OID 68661)
-- Name: fk_nivel_persona; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY nivel_crecimiento
    ADD CONSTRAINT fk_nivel_persona FOREIGN KEY (persona_id) REFERENCES persona(id);


--
-- TOC entry 1995 (class 2606 OID 68556)
-- Name: fk_nivel_red; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY nivel_crecimiento
    ADD CONSTRAINT fk_nivel_red FOREIGN KEY (red_id) REFERENCES red(int_red_id);


--
-- TOC entry 1986 (class 2606 OID 68359)
-- Name: fk_persona; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY ae_user
    ADD CONSTRAINT fk_persona FOREIGN KEY (id_persona) REFERENCES persona(id);


--
-- TOC entry 1990 (class 2606 OID 68463)
-- Name: fk_red; Type: FK CONSTRAINT; Schema: public; Owner: actumbes
--

ALTER TABLE ONLY persona
    ADD CONSTRAINT fk_red FOREIGN KEY (red_id) REFERENCES red(int_red_id);


--
-- TOC entry 1991 (class 2606 OID 68468)
-- Name: fk_ubicacion; Type: FK CONSTRAINT; Schema: public; Owner: actumbes
--

ALTER TABLE ONLY persona
    ADD CONSTRAINT fk_ubicacion FOREIGN KEY (id_ubicacion) REFERENCES ubicacion(id);


--
-- TOC entry 1993 (class 2606 OID 68519)
-- Name: fk_ubicacion_red; Type: FK CONSTRAINT; Schema: public; Owner: actumbes
--

ALTER TABLE ONLY red
    ADD CONSTRAINT fk_ubicacion_red FOREIGN KEY (id_ubicacion) REFERENCES ubicacion(id);


--
-- TOC entry 1987 (class 2606 OID 68365)
-- Name: fk_ubigeo; Type: FK CONSTRAINT; Schema: public; Owner: actumbes
--

ALTER TABLE ONLY iglesia
    ADD CONSTRAINT fk_ubigeo FOREIGN KEY (ubigeo_id) REFERENCES ubigeos(int_ubigeo_id);


--
-- TOC entry 1994 (class 2606 OID 68453)
-- Name: fk_ubigeo; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY ubicacion
    ADD CONSTRAINT fk_ubigeo FOREIGN KEY (ubigeo_id) REFERENCES ubigeos(int_ubigeo_id);


--
-- TOC entry 1999 (class 2606 OID 68592)
-- Name: leche_espiritual_fk; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tema_leche
    ADD CONSTRAINT leche_espiritual_fk FOREIGN KEY (id_leche_espiritual) REFERENCES leche_espiritual(id) MATCH FULL ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- TOC entry 2114 (class 0 OID 0)
-- Dependencies: 5
-- Name: public; Type: ACL; Schema: -; Owner: postgres
--

REVOKE ALL ON SCHEMA public FROM PUBLIC;
REVOKE ALL ON SCHEMA public FROM postgres;
GRANT ALL ON SCHEMA public TO postgres;
GRANT ALL ON SCHEMA public TO PUBLIC;


-- Completed on 2013-12-10 09:59:05

--
-- PostgreSQL database dump complete
--

