# Курс Symfony #

#### Запуск проекта ####

`docker-compose up -d`

`docker-compose exec database psql -U webmaster symfony < database.sql`

`docker-compose exec app composer install -n`

#### Доступ в EasyAdmin ####

login: `admin`
password: `admin`

API внеднрено минимально, многие запросы сыпят ошибками 500, не осилил.