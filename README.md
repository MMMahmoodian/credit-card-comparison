# Credit card comparison
## Introduction
This is a simple mock project that fetch credit cards data from a 3rd party API and compare them based on their features. 
The project is written in PHP and uses the Laravel framework to create a simple web server that serves the comparison results. 

## How to use
### Build and run
This project is dockerized, so you can run it using docker-compose. To simulate real-world scenario, we need different 
docker-compose files. For now the only option is `docker-compose.local` which is used for local development.

To run the project, you need to have docker and docker-compose installed on your machine. Then you can run the following command:
```shell
cp .env.example .env
docker compose -f docker-compose.local.yml up -d
docker exec
```
This will build and pull the necessary images and run the project. This project requires port `8000` and `3306` by default.
If you have any services running on these ports, you need to adjust the `.env` file to use different ports.
### Commands
To set up the database schema, you need to run the database migrations with following command:
```shell
docker compose -f docker-compose.local.yml exec app php artisan migrate
```
This will create the necessary tables in the database.

To fetch the credit cards data from the 3rd party API, you need to run the following command:
```shell
docker compose -f docker-compose.local.yml exec app php artisan credit-card:update
```
