# BeSketch

## How to install

After clone repository, use the follow command to install the composer dependencies

```
docker run --rm --interactive --tty --volume $PWD:/app --user $(id -u):$(id -g) composer install
```

Now, create the .env file and update the DB info

After that, run the migrations

