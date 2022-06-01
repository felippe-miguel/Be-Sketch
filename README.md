# BeSketch

## How to install

- After clone repository, use the follow command to install the composer dependencies
```
docker run --rm --interactive --tty --volume $PWD:/app --user $(id -u):$(id -g) composer install
```

- Create the .env file and update the DB info

- Run the docker-compose command
```
docker-compose up -d
```
- Access the php container and run the migrations
```
docker exec -it php bash
php artisan migrate
```

