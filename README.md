# FoodAmigos app

## Install

```
git clone <project>

cd <project>
cp .env.example .env

// set this env variables (optional)

// server port
APP_PORT=8080 // default 80

// database local port
FORWARD_DB_PORT=5455  // default 5432

// admin email address
APP_ADMIN_EMAIL=testemail@test.test

// run 
./vendor/bin/sail up


// after that run open new terminal and run
./vendor/bin/sail php artisan migrate
./vendor/bin/sail php artisan db:seed

// run queue work
sail php artisan queue:work

// open http://localhost:8080 in browser

// if you want to see emails open http://localhost:8025/


```
