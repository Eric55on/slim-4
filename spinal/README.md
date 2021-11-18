# Spinal

## Requirements
- PHP 7.4.x
- MySQL 5.7.x

### Recomended
- Apache with mod_rewrite

## Features
This project is based on best practices and industry standards:

- HTTP message interfaces
- HTTP Server Request Handlers, Middleware
- HTTP router and dispatcher (Slim)
- Dependency injection container
- Autoloading
- Logging
- Single action controllers
- Input validation
- Eloquent ORM
- Database migrations
- dotenv for environments
- Carbon the PHP DateTime class


## Installation

Install via composer.

```bash
$ composer install
```

Then create a .env based on .env.example and configure database with your credentials.

```bash
$ cp .env.example .env
```

Create folder log
```bash
$ mkdir log
```

Then set permissions to log folder:

```bash
$ sudo chmod -R 777 log
```


Run migrations:

```bash
$ composer phoenix migrate
```


## Usage
Open Postman and make a Request.




### Request

`GET http://slim.local/users/getAll`


### Response

    {"users":[{"id_usu":"1","nombres":"Prueba 1"},{"id_usu":"2","nombres":"Prueba 2"}]}




### Request

`POST http://slim.local/users/getById`


### params:
    id=1

### Response
    {"id_usu":1,"nombres":"Prueba 1"}




### Request

`POST http://slim.local/users/create`


### params:
    nombres=foo

### Response
    {"user_id":3}






### Request

`POST http://slim.local/users/update`


### params:
    id_usu=3
    nombres=foobar

### Response
    null





### Request

`POST http://slim.local/users/delete`


### params:
    id_usu=3

### Response
    null


