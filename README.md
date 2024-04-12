# Kanye API

This project is created using https://github.com/philbates35/laravel-starter.

## System requirements

You should ensure that you have the following installed on your host machine:

* Git
* Docker
* Docker-compose
* pnpm v8

That's it!

### Why isn't Node a system requirement?

We use pnpm's `use-node-version` in `.npmrc` to manage the node version to use in the project, which means that you don't need a locally installed Node. This way we can ensure that all developers are using the same version of Node.

## Getting started

1. Clone this repo:
   ```shell
   git clone git@github.com:philbates35/kanye-api.git
   cd kanye-api
   ```

2. Create the `.env` file:
   ```shell
   cp .env.example .env
   ```

3. Install composer dependencies, then start Octane (FrankenPHP):
    ```shell
    docker-compose up -d
    ```

4. Wait around 30 seconds, then set application key, create the database and run migrations:
   ```shell
   docker-compose exec php composer run post-create-project-cmd
    ```

5. Run the database seeder to create a user that has an API token (`test-user-api-token`) that you can authenticate with:
   ```shell
   docker-compose exec php php artisan db:seed
    ```

6. You can now test the application, using Postman, curl, or your HTTP client of choice you can view 5 random Kanye quotes by authenticating with the `test-user-api-token` API token:

   ```shell
   curl -k -H "Accept: application/json" -H "Authorization: Bearer test-user-api-token" https://localhost/api/quotes
   ["I'm going to personally see to it that Taylor Swift gets her masters back. Scooter is a close family friend","Who made up the term major label in the first place???","I'm the best","We as a people will heal. We will insure the well being of each other","You basically can say anything to someone on an email or text as long as you put LOL at the end."]
   # Repeated requests give the same set of quotes
   curl -k -H "Accept: application/json" -H "Authorization: Bearer test-user-api-token" https://localhost/api/quotes
   ["I'm going to personally see to it that Taylor Swift gets her masters back. Scooter is a close family friend","Who made up the term major label in the first place???","I'm the best","We as a people will heal. We will insure the well being of each other","You basically can say anything to someone on an email or text as long as you put LOL at the end."]
   curl -k -H "Accept: application/json" -H "Authorization: Bearer test-user-api-token" https://localhost/api/quotes
   ["I'm going to personally see to it that Taylor Swift gets her masters back. Scooter is a close family friend","Who made up the term major label in the first place???","I'm the best","We as a people will heal. We will insure the well being of each other","You basically can say anything to someone on an email or text as long as you put LOL at the end."]

   # Make the following POST request to refresh the quotes
   curl -k -H "Accept: application/json" -H "Authorization: Bearer test-user-api-token" -X POST https://localhost/api/refresh

   # Now the quotes are different
   curl -k -H "Accept: application/json" -H "Authorization: Bearer test-user-api-token" https://localhost/api/quotes
   ["The world is our family","I feel like I'm too busy writing history to read it.","I'm nice at ping pong","The media tries to kill our heroes one at a time","All you have to be is yourself"]
   curl -k -H "Accept: application/json" -H "Authorization: Bearer test-user-api-token" https://localhost/api/quotes
   ["The world is our family","I feel like I'm too busy writing history to read it.","I'm nice at ping pong","The media tries to kill our heroes one at a time","All you have to be is yourself"]
   curl -k -H "Accept: application/json" -H "Authorization: Bearer test-user-api-token" https://localhost/api/quotes
   ["The world is our family","I feel like I'm too busy writing history to read it.","I'm nice at ping pong","The media tries to kill our heroes one at a time","All you have to be is yourself"]

   # If you don't provide a valid API token, unauthorized response is give
   curl -k -H "Accept: application/json" https://localhost/api/quotes
   {"message":"Unauthenticated."}

## Cheat sheet

Back end:

```shell
# Use composer
docker-compose exec php composer install
docker-compose exec php composer update
docker-compose exec php composer require --dev foo/bar

# Run tests
docker-compose exec php composer run test

# Run phpstan
docker-compose exec php composer run phpstan

# Run php-cs-fixer
docker-compose exec php composer run php-cs-fixer

# Run phpcs
docker-compose exec php composer run phpcs
```
