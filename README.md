Docker Yii 2.0 Application
==========================

:octocat: [`dmstr/docker-yii2-app`](https://github.com/dmstr/docker-yii2-app)
:factory: [`dmstr/docker-yii2-app`](https://git.hrzg.de/dmstr/docker-yii2-app/pipelines)
:whale: [`dmstr/yii2-app`](https://hub.docker.com/r/dmstr/yii2-app/)
:cd: [`dmstr/php-yii2`](https://hub.docker.com/r/dmstr/php-yii2/)

[![Build Status](https://travis-ci.org/dmstr/docker-yii2-app.svg?branch=master)](https://travis-ci.org/dmstr/docker-yii2-app)

## Introduction

This is a minimal dockerized application template for Yii 2.0 Framework in about 100 lines of code.


## Requirements

- [Docker Toolbox](https://www.docker.com/products/docker-toolbox)
  - Docker `>=1.10`
  - docker-compose `>=1.7.0`


## Setup

Prepare `docker-compose` environment

    cp .env-dist .env

and application    
    
    cp src/app.env-dist src/app.env
    mkdir web/assets

Start stack

    docker-compose up -d

Show containers

    docker-compose ps

Run composer installation

    docker-compose run --rm php composer install


## Develop

Create bash    
    
    docker-compose exec php bash

Run package update in container    
    
    $ composer update -v

...

    $ yii help

      
## Test

    cd tests
    cp .env-dist .env

Run tests in codeception (`forrest`) container
      
    docker-compose run forrest run
          
> :info: This is equivalent to `codecept run` inside the tester container          
  

### CLI
    
    docker run dmstr/yii2-app yii


## Resources
    
- [Yii 2.0 Framework guide](http://www.yiiframework.com/doc-2.0/guide-index.html)
- [Docker documentation](https://docs.docker.com)

    
---

#### ![dmstr logo](http://t.phundament.com/dmstr-16-cropped.png) Built by [dmstr](http://diemeisterei.de)
