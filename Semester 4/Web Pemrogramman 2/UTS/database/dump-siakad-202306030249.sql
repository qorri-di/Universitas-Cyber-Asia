--
-- PostgreSQL database dump
--

-- Dumped from database version 14.1
-- Dumped by pg_dump version 14.1

-- Started on 2023-06-03 02:49:30

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

--
-- TOC entry 3 (class 2615 OID 2200)
-- Name: public; Type: SCHEMA; Schema: -; Owner: postgres
--

CREATE SCHEMA public;


ALTER SCHEMA public OWNER TO postgres;

--
-- TOC entry 3337 (class 0 OID 0)
-- Dependencies: 3
-- Name: SCHEMA public; Type: COMMENT; Schema: -; Owner: postgres
--

COMMENT ON SCHEMA public IS 'standard public schema';


SET default_tablespace = '';

SET default_table_access_method = heap;

--
-- TOC entry 214 (class 1259 OID 78351)
-- Name: dosen; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.dosen (
    id integer NOT NULL,
    nama character varying(255) NOT NULL,
    nidn character(8) NOT NULL,
    jenjang_pendidikan character varying(2) NOT NULL,
    CONSTRAINT dosen_jenjang_pendidikan_check CHECK (((jenjang_pendidikan)::text = ANY ((ARRAY['s2'::character varying, 's3'::character varying])::text[])))
);


ALTER TABLE public.dosen OWNER TO postgres;

--
-- TOC entry 213 (class 1259 OID 78350)
-- Name: dosen_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.dosen_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.dosen_id_seq OWNER TO postgres;

--
-- TOC entry 3338 (class 0 OID 0)
-- Dependencies: 213
-- Name: dosen_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.dosen_id_seq OWNED BY public.dosen.id;


--
-- TOC entry 210 (class 1259 OID 78333)
-- Name: mahasiswa; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.mahasiswa (
    id integer NOT NULL,
    nama character varying(255) NOT NULL,
    nim character(12) NOT NULL,
    program_studi character varying(255) NOT NULL
);


ALTER TABLE public.mahasiswa OWNER TO postgres;

--
-- TOC entry 209 (class 1259 OID 78332)
-- Name: mahasiswa_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.mahasiswa_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.mahasiswa_id_seq OWNER TO postgres;

--
-- TOC entry 3339 (class 0 OID 0)
-- Dependencies: 209
-- Name: mahasiswa_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.mahasiswa_id_seq OWNED BY public.mahasiswa.id;


--
-- TOC entry 212 (class 1259 OID 78342)
-- Name: matakuliah; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.matakuliah (
    id integer NOT NULL,
    nama character varying(255) NOT NULL,
    kode_matakuliah character(5) NOT NULL,
    deskripsi text
);


ALTER TABLE public.matakuliah OWNER TO postgres;

--
-- TOC entry 211 (class 1259 OID 78341)
-- Name: matakuliah_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.matakuliah_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.matakuliah_id_seq OWNER TO postgres;

--
-- TOC entry 3340 (class 0 OID 0)
-- Dependencies: 211
-- Name: matakuliah_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.matakuliah_id_seq OWNED BY public.matakuliah.id;


--
-- TOC entry 3176 (class 2604 OID 78354)
-- Name: dosen id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.dosen ALTER COLUMN id SET DEFAULT nextval('public.dosen_id_seq'::regclass);


--
-- TOC entry 3174 (class 2604 OID 78336)
-- Name: mahasiswa id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.mahasiswa ALTER COLUMN id SET DEFAULT nextval('public.mahasiswa_id_seq'::regclass);


--
-- TOC entry 3175 (class 2604 OID 78345)
-- Name: matakuliah id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.matakuliah ALTER COLUMN id SET DEFAULT nextval('public.matakuliah_id_seq'::regclass);


--
-- TOC entry 3331 (class 0 OID 78351)
-- Dependencies: 214
-- Data for Name: dosen; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.dosen (id, nama, nidn, jenjang_pendidikan) FROM stdin;
\.


--
-- TOC entry 3327 (class 0 OID 78333)
-- Dependencies: 210
-- Data for Name: mahasiswa; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.mahasiswa (id, nama, nim, program_studi) FROM stdin;
\.


--
-- TOC entry 3329 (class 0 OID 78342)
-- Dependencies: 212
-- Data for Name: matakuliah; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.matakuliah (id, nama, kode_matakuliah, deskripsi) FROM stdin;
3	pencuri	12345	asjkdbajksfbjbasj
\.


--
-- TOC entry 3341 (class 0 OID 0)
-- Dependencies: 213
-- Name: dosen_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.dosen_id_seq', 2, true);


--
-- TOC entry 3342 (class 0 OID 0)
-- Dependencies: 209
-- Name: mahasiswa_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.mahasiswa_id_seq', 3, true);


--
-- TOC entry 3343 (class 0 OID 0)
-- Dependencies: 211
-- Name: matakuliah_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.matakuliah_id_seq', 3, true);


--
-- TOC entry 3186 (class 2606 OID 78357)
-- Name: dosen dosen_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.dosen
    ADD CONSTRAINT dosen_pkey PRIMARY KEY (id);


--
-- TOC entry 3180 (class 2606 OID 78340)
-- Name: mahasiswa mahasiswa_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.mahasiswa
    ADD CONSTRAINT mahasiswa_pkey PRIMARY KEY (id);


--
-- TOC entry 3183 (class 2606 OID 78349)
-- Name: matakuliah matakuliah_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.matakuliah
    ADD CONSTRAINT matakuliah_pkey PRIMARY KEY (id);


--
-- TOC entry 3184 (class 1259 OID 78358)
-- Name: dosen_nidn_idx; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX dosen_nidn_idx ON public.dosen USING btree (nidn, nama, id);


--
-- TOC entry 3178 (class 1259 OID 78361)
-- Name: mahasiswa_nim_idx; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX mahasiswa_nim_idx ON public.mahasiswa USING btree (nim, nama, id);


--
-- TOC entry 3181 (class 1259 OID 78360)
-- Name: matakuliah_id_idx; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX matakuliah_id_idx ON public.matakuliah USING btree (id, nama, kode_matakuliah);


-- Completed on 2023-06-03 02:49:30

--
-- PostgreSQL database dump complete
--

