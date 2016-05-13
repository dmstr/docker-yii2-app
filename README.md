yii2-app
========

## Introduction

This is a minimal dockerized application template for Yii 2.0 Framework.

## Requirements

- [Docker Toolbox](https://www.docker.com/products/docker-toolbox)
  - Docker `>=1.10`
  - docker-compose `>=1.7.0`

## Setup

    cp .env-dist .env
    mkdir web/assets

Start stack

    docker-compose up -d

Show containers

    docker-compose ps

Create bash    
    
    docker-compose run --rm php bash

Run setup in container    
    
    $ composer install

## Develop

    $ yii help
      
## Test
      
    $ codecept run      
    
### CLI
    
    docker run dmstr/yii2-app yii

## Resources
    
- [Yii 2.0 Framework guide](http://www.yiiframework.com/doc-2.0/guide-index.html)
- [Docker documentation](https://docs.docker.com)
    
---

#### ![dmstr logo](http://t.phundament.com/dmstr-16-cropped.png) Built by [dmstr](http://diemeisterei.de)
    