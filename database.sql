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
-- Name: pizza; Type: TABLE; Schema: public; Owner: webmaster
--

CREATE TABLE public.pizza (
    id integer NOT NULL,
    image character varying(255) NOT NULL,
    updated_at timestamp(0) without time zone NOT NULL,
    name character varying(255) NOT NULL,
    price integer NOT NULL,
    description text
);


ALTER TABLE public.pizza OWNER TO webmaster;

--
-- Name: pizza_id_seq; Type: SEQUENCE; Schema: public; Owner: webmaster
--

CREATE SEQUENCE public.pizza_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.pizza_id_seq OWNER TO webmaster;

--
-- Name: pizza_ingredients; Type: TABLE; Schema: public; Owner: webmaster
--

CREATE TABLE public.pizza_ingredients (
    id integer NOT NULL,
    pizza_id integer NOT NULL,
    ingredient_id integer NOT NULL
);


ALTER TABLE public.pizza_ingredients OWNER TO webmaster;

--
-- Name: pizza_ingredients_id_seq; Type: SEQUENCE; Schema: public; Owner: webmaster
--

CREATE SEQUENCE public.pizza_ingredients_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.pizza_ingredients_id_seq OWNER TO webmaster;

--
-- Data for Name: doctrine_migration_versions; Type: TABLE DATA; Schema: public; Owner: webmaster
--

COPY public.doctrine_migration_versions (version, executed_at, execution_time) FROM stdin;
DoctrineMigrations\\Version20211220091129	2021-12-20 09:11:54	127
DoctrineMigrations\\Version20211220101415	2021-12-20 10:15:23	155
\.


--
-- Data for Name: ingredient; Type: TABLE DATA; Schema: public; Owner: webmaster
--

COPY public.ingredient (id, name) FROM stdin;
1	sfsfgsgs
2	tutukk
3	ncbnfghjd
4	sfgsfgn
5	uityhbv
\.


--
-- Data for Name: pizza; Type: TABLE DATA; Schema: public; Owner: webmaster
--

COPY public.pizza (id, image, updated_at, name, price, description) FROM stdin;
1	carbonara_30.jpg	2021-12-21 21:34:14	qweqeq	213242	\N
2	_indiana.png	2021-12-21 21:34:26	dasfadf	6765	\N
\.


--
-- Data for Name: pizza_ingredients; Type: TABLE DATA; Schema: public; Owner: webmaster
--

COPY public.pizza_ingredients (id, pizza_id, ingredient_id) FROM stdin;
1	1	1
2	1	3
3	1	5
4	2	1
5	2	2
6	2	4
7	2	5
\.


--
-- Name: ingredient_id_seq; Type: SEQUENCE SET; Schema: public; Owner: webmaster
--

SELECT pg_catalog.setval('public.ingredient_id_seq', 5, true);


--
-- Name: pizza_id_seq; Type: SEQUENCE SET; Schema: public; Owner: webmaster
--

SELECT pg_catalog.setval('public.pizza_id_seq', 2, true);


--
-- Name: pizza_ingredients_id_seq; Type: SEQUENCE SET; Schema: public; Owner: webmaster
--

SELECT pg_catalog.setval('public.pizza_ingredients_id_seq', 7, true);


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
-- Name: pizza_ingredients pizza_ingredients_pkey; Type: CONSTRAINT; Schema: public; Owner: webmaster
--

ALTER TABLE ONLY public.pizza_ingredients
    ADD CONSTRAINT pizza_ingredients_pkey PRIMARY KEY (id);


--
-- Name: pizza pizza_pkey; Type: CONSTRAINT; Schema: public; Owner: webmaster
--

ALTER TABLE ONLY public.pizza
    ADD CONSTRAINT pizza_pkey PRIMARY KEY (id);


--
-- Name: idx_ad0714f6933fe08c; Type: INDEX; Schema: public; Owner: webmaster
--

CREATE INDEX idx_ad0714f6933fe08c ON public.pizza_ingredients USING btree (ingredient_id);


--
-- Name: idx_ad0714f6d41d1d42; Type: INDEX; Schema: public; Owner: webmaster
--

CREATE INDEX idx_ad0714f6d41d1d42 ON public.pizza_ingredients USING btree (pizza_id);


--
-- Name: pizza_ingredients fk_ad0714f6933fe08c; Type: FK CONSTRAINT; Schema: public; Owner: webmaster
--

ALTER TABLE ONLY public.pizza_ingredients
    ADD CONSTRAINT fk_ad0714f6933fe08c FOREIGN KEY (ingredient_id) REFERENCES public.ingredient(id);


--
-- Name: pizza_ingredients fk_ad0714f6d41d1d42; Type: FK CONSTRAINT; Schema: public; Owner: webmaster
--

ALTER TABLE ONLY public.pizza_ingredients
    ADD CONSTRAINT fk_ad0714f6d41d1d42 FOREIGN KEY (pizza_id) REFERENCES public.pizza(id);


--
-- PostgreSQL database dump complete
--

