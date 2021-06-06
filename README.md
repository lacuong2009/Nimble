# Nimble
Nimble Challenge - Technical Test

## Requirements
   - Docker version 20.10.5
   - docker-compose version 1.28.5
   - NPM version 6
   - Angular CLI

## Setup environment
   1. Back-end
      - Open terminal back-end directory
      - Run composer install
      - Instalment docker composer
      - Run `docker-composer up -d`
   2. Front-end
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
        + Method: GET
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
## Web application
   1. http://54.254.158.175/



