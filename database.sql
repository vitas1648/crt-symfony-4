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
-- Name: admin; Type: TABLE; Schema: public; Owner: webmaster
--

CREATE TABLE public.admin (
    id integer NOT NULL,
    username character varying(180) NOT NULL,
    roles json NOT NULL,
    password character varying(255) NOT NULL
);


ALTER TABLE public.admin OWNER TO webmaster;

--
-- Name: admin_id_seq; Type: SEQUENCE; Schema: public; Owner: webmaster
--

CREATE SEQUENCE public.admin_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.admin_id_seq OWNER TO webmaster;

--
-- Name: basket; Type: TABLE; Schema: public; Owner: webmaster
--

CREATE TABLE public.basket (
    id integer NOT NULL,
    pizza_id integer NOT NULL,
    booking_id integer,
    quantity integer NOT NULL
);


ALTER TABLE public.basket OWNER TO webmaster;

--
-- Name: basket_id_seq; Type: SEQUENCE; Schema: public; Owner: webmaster
--

CREATE SEQUENCE public.basket_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.basket_id_seq OWNER TO webmaster;

--
-- Name: booking; Type: TABLE; Schema: public; Owner: webmaster
--

CREATE TABLE public.booking (
    id integer NOT NULL,
    customer_id integer,
    created_at timestamp(0) without time zone NOT NULL,
    amount integer NOT NULL
);


ALTER TABLE public.booking OWNER TO webmaster;

--
-- Name: COLUMN booking.created_at; Type: COMMENT; Schema: public; Owner: webmaster
--

COMMENT ON COLUMN public.booking.created_at IS '(DC2Type:datetime_immutable)';


--
-- Name: booking_id_seq; Type: SEQUENCE; Schema: public; Owner: webmaster
--

CREATE SEQUENCE public.booking_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.booking_id_seq OWNER TO webmaster;

--
-- Name: customer; Type: TABLE; Schema: public; Owner: webmaster
--

CREATE TABLE public.customer (
    id integer NOT NULL,
    session_id character varying(255) NOT NULL,
    phone character varying(255) NOT NULL,
    name character varying(255) DEFAULT NULL::character varying,
    address character varying(255) DEFAULT NULL::character varying
);


ALTER TABLE public.customer OWNER TO webmaster;

--
-- Name: customer_id_seq; Type: SEQUENCE; Schema: public; Owner: webmaster
--

CREATE SEQUENCE public.customer_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.customer_id_seq OWNER TO webmaster;

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
-- Data for Name: admin; Type: TABLE DATA; Schema: public; Owner: webmaster
--

COPY public.admin (id, username, roles, password) FROM stdin;
1	admin	["ROLE_ADMIN"]	$2y$13$/bWloz7b6xQxnoa2AhFst.S276ODMDo1SFBoAn0hU09GEGh8leEk.
\.


--
-- Data for Name: basket; Type: TABLE DATA; Schema: public; Owner: webmaster
--

COPY public.basket (id, pizza_id, booking_id, quantity) FROM stdin;
31	12	9	1
\.


--
-- Data for Name: booking; Type: TABLE DATA; Schema: public; Owner: webmaster
--

COPY public.booking (id, customer_id, created_at, amount) FROM stdin;
8	10	2022-01-09 18:19:34	1485
9	11	2022-01-09 18:21:52	0
\.


--
-- Data for Name: customer; Type: TABLE DATA; Schema: public; Owner: webmaster
--

COPY public.customer (id, session_id, phone, name, address) FROM stdin;
9	1b538a1de46de722ea644477a2db15da	tmp61db26c6a7cf3	\N	\N
10	bc0c6b8f6e1f47440fe97d28435f2963	tmp61db2736c6ab1	\N	\N
11	76155a015c5be60323f46c74c94d8cde	tmp61db27c0b8383	\N	\N
\.


--
-- Data for Name: doctrine_migration_versions; Type: TABLE DATA; Schema: public; Owner: webmaster
--

COPY public.doctrine_migration_versions (version, executed_at, execution_time) FROM stdin;
DoctrineMigrations\\Version20220109132954	2022-01-09 13:30:13	580
\.


--
-- Data for Name: ingredient; Type: TABLE DATA; Schema: public; Owner: webmaster
--

COPY public.ingredient (id, name) FROM stdin;
1	салями
2	шампиньоны
3	бекон
4	ветчина
5	ананнас
6	индейка
7	курица
8	сыр чеддер
9	сыр моцарелла
10	сыр пармезан
11	вяленные томаты
12	сладкий перец
13	перец чили
15	анчоус
16	всякое
\.


--
-- Data for Name: pizza; Type: TABLE DATA; Schema: public; Owner: webmaster
--

COPY public.pizza (id, image, updated_at, name, price, description) FROM stdin;
1	pepperony.jpeg	2021-12-22 14:01:17	Пепперони	495	На тонком тесте, с соусом по специальному итальянскому рецепту.
3	_gavayskaya.png	2021-12-22 14:07:03	Гавайская	495	На тонком тесте, с соусом по специальному итальянскому рецепту.
4	salvadora_30.jpg	2021-12-22 14:08:09	Грибная	495	На тонком тесте, с соусом по специальному итальянскому рецепту.
5	chelentano_new_30.jpg	2021-12-22 16:57:35	Ветчина и грыбы	495	На тонком тесте, с соусом по специальному итальянскому рецепту.
7	_chiken_pizza.png	2021-12-22 16:59:39	Индейка и грыбы	495	На тонком тесте, с соусом по специальному итальянскому рецепту.
6	_chiken_pizza.png	2021-12-22 16:59:49	Куриная	495	На тонком тесте, с соусом по специальному итальянскому рецепту.
8	_chiken_pizza.png	2021-12-22 17:00:01	Сырная курица	495	На тонком тесте, с соусом по специальному итальянскому рецепту.
9	pepperony.jpeg	2021-12-22 17:00:23	Пепперони острая	495	На тонком тесте, с соусом по специальному итальянскому рецепту.
10	pipperoni.jpg	2021-12-22 17:00:46	Пепперони new	495	На тонком тесте, с соусом по специальному итальянскому рецепту.
2	margarita_30.jpg	2021-12-23 04:14:13	Маргарита	495	На тонком тесте, с соусом по специальному итальянскому рецепту.
12	torro.jpg	2021-12-23 17:20:08	Анчоус	555	На тонком тесте, с соусом по специальному итальянскому рецепту.
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
8	12	5
9	12	15
10	12	9
11	12	11
12	12	12
\.


--
-- Name: admin_id_seq; Type: SEQUENCE SET; Schema: public; Owner: webmaster
--

SELECT pg_catalog.setval('public.admin_id_seq', 1, false);


--
-- Name: basket_id_seq; Type: SEQUENCE SET; Schema: public; Owner: webmaster
--

SELECT pg_catalog.setval('public.basket_id_seq', 31, true);


--
-- Name: booking_id_seq; Type: SEQUENCE SET; Schema: public; Owner: webmaster
--

SELECT pg_catalog.setval('public.booking_id_seq', 9, true);


--
-- Name: customer_id_seq; Type: SEQUENCE SET; Schema: public; Owner: webmaster
--

SELECT pg_catalog.setval('public.customer_id_seq', 11, true);


--
-- Name: ingredient_id_seq; Type: SEQUENCE SET; Schema: public; Owner: webmaster
--

SELECT pg_catalog.setval('public.ingredient_id_seq', 14, true);


--
-- Name: pizza_id_seq; Type: SEQUENCE SET; Schema: public; Owner: webmaster
--

SELECT pg_catalog.setval('public.pizza_id_seq', 12, true);


--
-- Name: pizza_ingredients_id_seq; Type: SEQUENCE SET; Schema: public; Owner: webmaster
--

SELECT pg_catalog.setval('public.pizza_ingredients_id_seq', 7, true);


--
-- Name: admin admin_pkey; Type: CONSTRAINT; Schema: public; Owner: webmaster
--

ALTER TABLE ONLY public.admin
    ADD CONSTRAINT admin_pkey PRIMARY KEY (id);


--
-- Name: basket basket_pkey; Type: CONSTRAINT; Schema: public; Owner: webmaster
--

ALTER TABLE ONLY public.basket
    ADD CONSTRAINT basket_pkey PRIMARY KEY (id);


--
-- Name: booking booking_pkey; Type: CONSTRAINT; Schema: public; Owner: webmaster
--

ALTER TABLE ONLY public.booking
    ADD CONSTRAINT booking_pkey PRIMARY KEY (id);


--
-- Name: customer customer_pkey; Type: CONSTRAINT; Schema: public; Owner: webmaster
--

ALTER TABLE ONLY public.customer
    ADD CONSTRAINT customer_pkey PRIMARY KEY (id);


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
-- Name: idx_2246507b3301c60; Type: INDEX; Schema: public; Owner: webmaster
--

CREATE INDEX idx_2246507b3301c60 ON public.basket USING btree (booking_id);


--
-- Name: idx_2246507bd41d1d42; Type: INDEX; Schema: public; Owner: webmaster
--

CREATE INDEX idx_2246507bd41d1d42 ON public.basket USING btree (pizza_id);


--
-- Name: idx_ad0714f6933fe08c; Type: INDEX; Schema: public; Owner: webmaster
--

CREATE INDEX idx_ad0714f6933fe08c ON public.pizza_ingredients USING btree (ingredient_id);


--
-- Name: idx_ad0714f6d41d1d42; Type: INDEX; Schema: public; Owner: webmaster
--

CREATE INDEX idx_ad0714f6d41d1d42 ON public.pizza_ingredients USING btree (pizza_id);


--
-- Name: idx_e00cedde9395c3f3; Type: INDEX; Schema: public; Owner: webmaster
--

CREATE INDEX idx_e00cedde9395c3f3 ON public.booking USING btree (customer_id);


--
-- Name: uniq_880e0d76f85e0677; Type: INDEX; Schema: public; Owner: webmaster
--

CREATE UNIQUE INDEX uniq_880e0d76f85e0677 ON public.admin USING btree (username);


--
-- Name: basket fk_2246507b3301c60; Type: FK CONSTRAINT; Schema: public; Owner: webmaster
--

ALTER TABLE ONLY public.basket
    ADD CONSTRAINT fk_2246507b3301c60 FOREIGN KEY (booking_id) REFERENCES public.booking(id);


--
-- Name: basket fk_2246507bd41d1d42; Type: FK CONSTRAINT; Schema: public; Owner: webmaster
--

ALTER TABLE ONLY public.basket
    ADD CONSTRAINT fk_2246507bd41d1d42 FOREIGN KEY (pizza_id) REFERENCES public.pizza(id);


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
-- Name: booking fk_e00cedde9395c3f3; Type: FK CONSTRAINT; Schema: public; Owner: webmaster
--

ALTER TABLE ONLY public.booking
    ADD CONSTRAINT fk_e00cedde9395c3f3 FOREIGN KEY (customer_id) REFERENCES public.customer(id);


--
-- PostgreSQL database dump complete
--

