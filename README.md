# FoodAmigos app

## Install

```
git clone <project>

cd <project>/src
cp .env.example .env

// set this env variables (optional)

// server port
APP_PORT=8080 // default 80

// database local port
FORWARD_DB_PORT=5455  // default 5432


// run 
./vendor/bin/sail up

// after that
./vendor/bin/sail php artisan migrate
./vendor/bin/sail php artisan db:seed

// open http://localhost:8080 in browser


```
