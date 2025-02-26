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
After running this command, you can access the landing page on `http://localhost:8000`.

## FAQ
**Q: Why did you choose Docker?**<br>
A: Docker is a great tool for building and running applications in a consistent environment. 
Also, I didnt want to force anyone to install PHP, Composer, etc. on their machine only to test this project out.

**Q: Why did you use volumes in docker**<br>
A: I used volumes to share the code between the host and the container. This way I can edit the code on my machine and 
see the changes in the container immediately. But this is a bad practice in production. In production, we should build the
application and copy the codes to the container.

**Q: Why did you choose MySQL?**<br>
A: Honestly I could have done this with SQLite, but because of the requirements of the project, I had to use MySQL.

**Q: Why did you choose PHP 8.2?**<br>
A: PHP 8.2 is _not_ the latest version of PHP and it's _not_ even current stable version. But usually these
new versions have some bugs and issues and migrating or using them for production is not a good idea. 
Thus I used 8.2 because it's stable and meanwhile has a lot of features.

**Q: Why did you choose Laravel?**<br>
A: Laravel is a very powerful and easy to use framework that has a lot of features out of the box.
Also, I have a lot of experience with Laravel and I can build things faster with it.

**Q: Why did you choose Laravel 11.x?**<br>
A: Same as PHP, I used Laravel 11.x because it's stable and has a lot of features. Most recent version of Laravel is 12 
and it was released a few days ago. I didn't want to use it because it might have some bugs and issues.

**Q: Why did you choose ETL standard?**<br>
A: ETL is a very common standard for data processing specially where we need to fetch data from multiple 3rd party API and process it.
In a real-world scenario, we need to extract data from various sources, transform it and load it into a database.
ETL is a very good standard for this kind of task where pipelines are clear and easy to understand.

**Q: How dependency injection works in Laravel?**<br>
A: As you can see I used Abstract classes and interfaces to define the contract between classes. 
Then I used Laravel's service container to bind the implementation to the interface. This makes a clean and testable code.
Also with reducing the coupling between classes, we can easily replace the implementation with another one at any time.

**Q: Why did you change FinanceAds output type to CSV?**<br>
A: Well, I had a rough time processing some of the keys in XML format. Specifically, the `gebuehrenmitaktion` and `kostenmitaktion`.
So I decided to check the api and found out that it supports CSV format. So I decided to use CSV format instead of XML.

**Q: Why there are no tests?**<br>
A: I know that tests are very important in a project, but because of the time constraints, I decided to skip them. 
I tried to implement a clean and testable code so that it would be easy to add tests later on.

**Q: Wow! Your front-end skills are perfect. How did you do it?**<br>
A: I know that the front-end is not perfect and it's not even close to perfect. 
I'm a back-end developer and I'm not good at front-end. Even these 2 simple pages are created with help of ChatGPT :D
