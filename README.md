# **Guest service app**

* Framework: Laravel
* Database: PostgreSQL 15
* Используемые библиотеки: arthurydalgo/laravel-iso-countries, propaganistas/laravel-phone

Микросервис реализует API для CRUD операций над гостем. То есть принимает данные для создания, изменения, получения, удаления записей гостей хранящихся в выбранной базе данных.

API методы:

* ['GET'] /api/guest - список гостей
* ['POST'] /api/guest - создать гостя
* ['PATCH'] /api/guest/id - изменить гостя
* ['DELETE'] /api/guest/id - удалить гостя

Так же методы возвращают заголоки
* X-Debug-Time - время выполнения запроса
* X-Debug-Memory - сколько памяти использовано


## Запуск проекта

1. Инициализация проекта `make init`
2. Запуск проекта `make up`
3. Остановка проекта `make down`

Инициализация проекта автоматически все запустит и скопирует нужные файлы. 

## Работа с API

Работать с api можно через Postman, либо другие удобные инструменты.

После запуска проекта, он запустится на :8000 порте. Полный URL для отправки запросов 
* http://localhost:8000/api

Все запросы возвращают ответ в одном формфеу `data: {}`

**['GET'] /api/guest - вернет список гостей**

```json
{
  "data": [
    {
      "id": 1,
      "first_name": "anton",
      "last_name": "slav",
      "phone": "+79009009090",
      "email": "laravel@gmail.com",
      "country": "Россия",
      "created_at": "2024-09-28T08:19:20.000000Z",
      "updated_at": "2024-09-28T08:19:20.000000Z"
    }
  ]
}
```


**['POST'] /api/guest - принимает body (application/json)**

```json
{
  "first_name": "anton",
  "last_name": "slav",
  "phone": "+79009009090",
  "email": "laravel@gmail.com",
  "country": "Russia"
}
```
Обязательными аттрибутами являются
* first_name
* last_name
* phone

В случае успешного выполнения запроса придет ответ с созданной сущностью

```json
{
  "data": {
    "id": 1,
    "first_name": "anton",
    "last_name": "slav",
    "phone": "+79009009090",
    "email": "laravel@gmail.com",
    "country": "Россия",
    "created_at": "2024-09-28T08:19:20.000000Z",
    "updated_at": "2024-09-28T08:19:20.000000Z"
  }
}
```

**['PATCH'] /api/guest/{id} - принимает body (application/json) и id записи для изменения в url**

```json
{
  "first_name": "anton",
  "last_name": "slav",
  "phone": "+79009009090",
  "email": "laravel@gmail.com",
  "country": "Russia"
}
```

В случае успешного выполнения запроса придет ответ с созданной сущностью

```json
{
  "data": {
    "id": 1,
    "first_name": "anton",
    "last_name": "slav",
    "phone": "+79009009090",
    "email": "laravel@gmail.com",
    "country": "Россия",
    "created_at": "2024-09-28T08:19:20.000000Z",
    "updated_at": "2024-09-28T08:19:20.000000Z"
  }
}
```

**['DELETE'] /api/guest/{id} - принимает id записи для удаления в url**

В случае успешного выполнения запроса придет ответ с статусом операции

```json
{
  "data": true
}
```

### Ошибки

Все методы обрабатывают ошибки. 

##### Ошибки валидации
```json
{
  "message": "The first name field is required. (and 2 more errors)",
  "errors": {
    "first_name": [
      "The first name field is required."
    ],
    "last_name": [
      "The last name field is required."
    ],
    "phone": [
      "The phone field is required."
    ]
  }
}
```

##### Ошибки сервера
```json
{
    "error": {
        "message": "SQLSTATE[23505]: Unique violation: 7 ERROR:  duplicate key value violates unique constraint \"guests_email_unique\"\nDETAIL:  Key (email)=(laravel@gmail.com) already exists. (Connection: pgsql, SQL: insert into \"guests\" (\"first_name\", \"last_name\", \"phone\", \"email\", \"country\", \"updated_at\", \"created_at\") values (anton, slav, +79006774878, laravel@gmail.com, Russia, 2024-09-28 09:01:43, 2024-09-28 09:01:43) returning \"id\")"
    }
}
```

#### Можно запустить автотесты API `make test`