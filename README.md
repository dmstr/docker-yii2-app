## Installation
1) git clone https://github.com/pavelblossom/docker-yii2-app
2) cd docker-yii2-app/
3) git fetch && git checkout develop
4) cd yii2-docker/
5) cp .env-dist .env
6) cp config/app.env-dist config/app.env
7) mkdir web/assets
8) docker-compose up -d
9) docker-compose run --rm php composer install
10) docker-compose exec php bash
11) composer update -v 

## Requests

### Create user
#####method POST http://localhost:20080/users
Params:
* username (string)
* currency (ISO format)
* country (string)
* city (string)
### View user
##### method GET http://localhost:20080/users/$id
Params:
* from (Y-m-d)
* to (Y-m-d)
### Add rate
##### method POST http://localhost:20080/rates
Params;
* currency (ISO)
* rate (float)
* rate_date (Y-m-d)
### Refill account
##### method POST http://localhost:20080/refills
Params;
* accound_id
* currency
* sum
### Payment account
##### method POST http://localhost:20080/payments
Params;
* sender_account_id
* receiver_account_id
* sum
* currency


