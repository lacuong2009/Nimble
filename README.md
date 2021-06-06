# Nimble Challenge - Technical Test

## Web application
http://54.254.158.175/

## Requirements
   - Docker version 20.10.5
   - docker-compose version 1.28.5
   - NPM version 6
   - Angular CLI

## Setup environment Local
   1. Back-end (Lumen framework)
      - Open terminal back-end directory
      - Run composer install
      - Instalment docker composer
      - Run `docker-composer up -d`
      - Create database and update environment (.env file)
      - Open docker container `docker exec -it php-fpm bash`
      - Open work dir at `/app`
      - Run `php artisan migrate`
      - Run `php artisan passport:install` to insert Oauth client_id, client_secret
   2. Front-end (Angular framework)
      - Open terminal front-end directory
      - Run `npm run start`

## Document APIs
   1. Swagger url
      - http://localhost/api/documentation
   2. APIs 
      - Login 
        + Url: api/oauth/token
        + Method: POST
        + Body:
          ```json
            {"token_type": "string","client_id": "string","client_secret": "string","username": "string","password": "string"}
          ```
        + Response:
          ```json
            {"token_type":"Bearer","expires_in":31536000,"access_token":"string","refresh_token":"string"}
          ```
      - Register
        + Url: api/oauth/register
        + Method: POST
        + Body:
          ```json
            {"name":true,"email":"string","password":"string"}
          ```
        + Response:
          ```json
            {"success":true,"code":201,"data": {}}
          ```
      - Get User
        + Url: api/users/me
        + Method: GET
        + Headers:
            + Authorization : Bearer token
        + Response:
          ```json
            {"success":true,"code":200,"data": {}}
          ```
      - Get list keywords
        + Url: /api/keywords
        + Method: GET
        + Params:
          + limit
          + page
          + keyword
        + Headers:
          + Authorization : Bearer token
        + Response:
             ```json
               {"success":true,"code":200,"data": {}}
             ```
      - Upload file .csv
        + Url: /api/keywords
        + Method: POST
        + Body:
          + File: choose file
        + Headers:
          + Authorization : Bearer token
        + Response:
           ```json
           {"success":true}
           ```
      - Get keyword details
         + Url: /api/keywords/{id}
         + Method: GET
         + Headers:
           + Authorization : Bearer token
         + Response:
              ```json
                {"success":true,"code":200,"data": {}}
              ```
           
# Author
    Cuong Ly
    anhcuongone@gmail.com
    