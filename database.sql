--
-- PostgreSQL database dump
--

-- Dumped from database version 11.14
-- Dumped by pg_dump version 11.14

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

SET default_tablespace = '';

SET default_with_oids = false;

--
-- Name: doctrine_migration_versions; Type: TABLE; Schema: public; Owner: webmaster
--

CREATE TABLE public.doctrine_migration_versions (
    version character varying(191) NOT NULL,
    executed_at timestamp(0) without time zone DEFAULT NULL::timestamp without time zone,
    execution_time integer
);


ALTER TABLE public.doctrine_migration_versions OWNER TO webmaster;

--
-- Name: ingredient; Type: TABLE; Schema: public; Owner: webmaster
--

CREATE TABLE public.ingredient (
    id integer NOT NULL,
    name character varying(255) NOT NULL
);


ALTER TABLE public.ingredient OWNER TO webmaster;

--
-- Name: ingredient_id_seq; Type: SEQUENCE; Schema: public; Owner: webmaster
--

CREATE SEQUENCE public.ingredient_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.ingredient_id_seq OWNER TO webmaster;

--
-- Data for Name: doctrine_migration_versions; Type: TABLE DATA; Schema: public; Owner: webmaster
--

COPY public.doctrine_migration_versions (version, executed_at, execution_time) FROM stdin;
DoctrineMigrations\\Version20211220091129	2021-12-20 09:11:54	127
\.


--
-- Data for Name: ingredient; Type: TABLE DATA; Schema: public; Owner: webmaster
--

COPY public.ingredient (id, name) FROM stdin;
1	салями
2	грибы
3	бекон
4	ветчина
5	ананнас
6	индейка
7	курица
8	сыр чеддер
9	сыр моцарелла
10	сыр пармезан
\.


--
-- Name: ingredient_id_seq; Type: SEQUENCE SET; Schema: public; Owner: webmaster
--

SELECT pg_catalog.setval('public.ingredient_id_seq', 1, false);


--
-- Name: doctrine_migration_versions doctrine_migration_versions_pkey; Type: CONSTRAINT; Schema: public; Owner: webmaster
--

ALTER TABLE ONLY public.doctrine_migration_versions
    ADD CONSTRAINT doctrine_migration_versions_pkey PRIMARY KEY (version);


--
-- Name: ingredient ingredient_pkey; Type: CONSTRAINT; Schema: public; Owner: webmaster
--

ALTER TABLE ONLY public.ingredient
    ADD CONSTRAINT ingredient_pkey PRIMARY KEY (id);


--
-- PostgreSQL database dump complete
--

