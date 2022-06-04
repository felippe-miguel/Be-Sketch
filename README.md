# BeSketch

## How to install

After clone repository, use the follow command to install the composer dependencies
~~~bash
docker run --rm --interactive --tty --volume $PWD:/app --user $(id -u):$(id -g) composer install
~~~
Create the .env file and update the DB info
Run the docker-compose command
~~~bash
docker-compose up -d
~~~
Access the php container and run the migrations
~~~bash
docker exec -it php bash
php artisan migrate
~~~

## Endpoints
#### POST - api/register
- request
~~~json
{
    "name": "Jhon Doe",
    "email": "example@email.com",
    "password": "password"
}
~~~
- response
~~~json
{
    "data": {
        "name": "Jhon Doe",
        "email": "example@email.com",
        "updated_at": "2022-06-04T02:34:44.000000Z",
        "created_at": "2022-06-04T02:34:44.000000Z",
        "id": 1
    },
    "access_token": "tokenstring",
    "token_type": "Bearer"
}
~~~

#### POST - api/login
- request
~~~json
{
    "email": "example@email.com",
    "password": "password"
}
~~~
- response
~~~json
{
    "access_token": "tokenstring",
    "token_type": "Bearer"
}
~~~

#### GET - api/profile
- header
~~~json
{
    "Authorization": "tokenstring"
}
~~~
- response
~~~json
{
    "id": 1,
    "name": "Jhon Doe",
    "email": "example@email.com",
    "email_verified_at": null,
    "created_at": "2022-06-01T03:48:23.000000Z",
    "updated_at": "2022-06-01T03:48:23.000000Z",
    "deleted_at": null
}
~~~

#### GET - api/logout
- header
~~~json
{
    "Authorization": "tokenstring"
}
~~~
- response
~~~json
{
    "message": "You have successfully logged out"
}
~~~

#### POST - api/board
- header
~~~json
{
    "Authorization": "tokenstring"
}
~~~
- request
~~~json
{
    "title": "board title"
}
~~~
- response
~~~json
{
    "message": "Board successfully created",
    "id": 1
}
~~~

#### GET - api/board
- header
~~~json
{
    "Authorization": "tokenstring"
}
~~~
- response
~~~json
{
    "boards": [
        {
            "id": 1,
            "user_id": 1,
            "title": "board title",
            "created_at": "2022-06-01T03:50:00.000000Z",
            "updated_at": "2022-06-01T03:50:00.000000Z",
            "deleted_at": null
        },
        {
            "id": 2,
            "user_id": 1,
            "title": "board 2 title",
            "created_at": "2022-06-04T02:48:05.000000Z",
            "updated_at": "2022-06-04T02:48:05.000000Z",
            "deleted_at": null
        }
    ]
}
~~~

#### GET - api/board/{id}
- header
~~~json
{
    "Authorization": "tokenstring"
}
~~~
- response
~~~json
{
    "id": 1,
    "user_id": 1,
    "title": "board title",
    "created_at": "2022-06-01T03:50:00.000000Z",
    "updated_at": "2022-06-01T03:50:00.000000Z",
    "deleted_at": null
}
~~~

#### PUT - api/board/{id}
- header
~~~json
{
    "Authorization": "tokenstring"
}
~~~
- request
~~~json
{
    "title": "flevers"
}
~~~
- response
~~~json
{
    "message": "Board successfully updated"
}
~~~

#### DELETE - api/board/{id}
- header
~~~json
{
    "Authorization": "tokenstring"
}
~~~
- response
~~~json
{
    "message": "Board successfully deleted"
}
~~~