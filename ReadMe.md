# Курс Symfony #

#### Запуск проекта ####

`docker-compose up -d`

`docker-compose exec database psql -U webmaster symfony < database.sql`

`docker-compose exec app composer install -n`

#### Доступ в EasyAdmin ####

login: `admin`
password: `admin`

## Задание #4 ##

### Создание сайта для онлайн-заказа пиццы ###

В качестве скелета приложения используем
https://symfony.com/doc/current/setup.html#symfony-lts-versions

Под задачу требуется создать новый репозиторий - **crt-symfony-4**

Необходимо разработать сайт (онлайн-витрину) для заказа пиццы. Внешний
вид страницы вы определяете самостоятельно, особых изысков не требуется - главное использовать Twig

**Использование контейнеров и docker-compose - обязательно**

**Дамп БД с готовой информацией разместить в репозитории**

### Структура Сайта ###

Страницы на сайте:

- главная (она же каталог пиццы)
- детальная страница пиццы с описанием и ингредиентами
- ~~**_Дополнительно: страница “собери пиццу”*_**~~
- корзина
- ~~оформление заказа~~
- админка - EasyAdmin

### Роли на сайте ###

- Администраторы – полный доступ к админке
- Незарегистрированный пользователь – может покупать пиццу (без авторизации)

### Состав страниц ###

Шапка сайта состоит из:

- Название сайта
- Меню для навигации по сайту
- ~~**_Дополнительно: ссылка на корзину с указанием количества позиций и общей стоимости (использовать события)_**~~

### Главная страница (каталог пиццы) ###

- Список наименований пицц с картинкой, названием и описанием
- Постраничная навигация, например, по 5 элементов на странице
- Выводится кнопка добавления в корзину у каждой пиццы с указанием количества

### Страница с описанием пиццы ###

- Выводится название, картинка, описание и ингредиенты пиццы
- Выводится кнопка добавления в корзину с указанием количества

### Страница корзины ###

- Выводится состав корзины (или сообщение, что корзина пуста)
- ~~Можно менять количество элементов в корзине и перейти к оформлению заказа~~

### Страница оформления заказа ###

- Выводится состав заказа (позиция, количество, цена 1 позиции и сумма по позиции) и итоговая сумма всей корзины
- Страница доступна только если в корзине есть товары
- Оформление заказа возможно без регистрации, поля - имя и телефон клиента, адрес доставки. Оплаты и прочего нет
- ~~**_Дополнительно: при оформлении заказа незаметно для клиента создавать учетную запись, заказы привязывать к этой учетной записи (использовать события)*_**~~

### Реализовать админку (EasyAdmin) ###

- интерфейс интерфейс создания пиццы (название, картинка, описание)
    - указание ингредиентов, из которых состоит пицца (должны быть отдельными сущностями)
- страницу со списком оставленных заказов
- ~~**_Дополнительно: список клиентов (имя, телефон)*_**~~

Доступ возможен только администратору сайта по логину и паролю.

### Реализовать сервисы ###

- ~~Сервис расчета стоимости заказа (использовать в корзине)~~
- ~~Сервис отправки уведомления о заказе. Сервис должен отправлять сообщение в очередь (например, RabbitMQ, которую необходимо добавить его в docker. Далее сервис забирает сообщения из очереди и отправляет информации о заказе на почту администратору и клиенту (использовать при оформлении заказа).~~
- ~~**_Дополнительно: сервис “собери пиццу” - форма для “сборки” новой пиццы из списка ингредиентов (ту, которая не представлена в меню, макс 5 ингредиентов) и заказать её (использовать на странице “собери пиццу”)*_**~~

### Покрыть код тестами: ###

- ~~Тест сервиса расчета стоимости заказа~~
- ~~Тест страниц (открываются, статус ОК, присутствуют элементы)~~
- ~~**_Дополнительно: тест сервиса “собери пиццу” (пицца собирается корректно и содержит все требуемые ингредиенты, не содержит лишних, нельзя оформить заказ с пиццей БЕЗ ингредиентов)*_**~~
- ~~Для тестов использовать тестовое окружение + тестовую БД + фикстуры данных~~

**_Задания, помеченные как “дополнительно” и выделенные звездочкой - не обязательные и делаются по вашему желанию (+ баллы)_**

