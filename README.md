[![SymfonyInsight](https://insight.symfony.com/projects/23de7c69-fbc9-4e20-bc6f-30af77c3f13b/small.svg)](https://insight.symfony.com/projects/23de7c69-fbc9-4e20-bc6f-30af77c3f13b)

# Blog-php

OpenClassrooms poeject, a blog php from scratch, using composer, OOP and MVC model.

## Requirements

| Dependency | Version |
| ---------- | ------- |
| PHP        | =8.1    |
| Composer   |         |

## Run locally

Clone th project

```shell
    git clone https://github.com/Davidouu/Blog-php.git
```

Go to the project dir

```shell
    cd blog-php
```

Install all dependencies

```shell
    composer install
```

## DataBase Configuration

In the project directory execute

On Windows :

```shell
    copy .env .env.local
```

On Mac :

```shell
    cp .env .env.local
```

Then fill the vars into the created file

```env
    DB_HOST=""
    DB_USERNAME=""
    DB_PASSWORD=""
    DB_NAME=""
    DB_PORT=""
    DB_CHARSET=""
```

## DataBase Setup

To setup the database, run this command :

```shell
    php .src/Config/SetupDataBase.php
```

This Php file will connect to the database previously created and will create all the necessary tables and add test data

## Tests Datas

### Utilisateurs de Test

Pour faciliter le processus de test, nous avons créé quelques comptes d'utilisateur avec des rôles différents. Utilisez ces informations pour vous connecter à l'application :

#### Utilisateur Administrateur

- **Email utilisateur:** admin@test.com
- **Mot de passe:** @~Wld?O#<{7-.YN]s=d}M+ru=4y>o[,AG:^)N{bDdLaR2At4Dd

#### Utilisateur Editeur

- **Email utilisateur:** editeur@test.com
- **Mot de passe:** MS-:Tq%;cx)d?GV_n0xCd.-4cdiSgVM]#<fkA-V,gw:^brwBx?

#### Utilisateur Standard N°1

- **Email utilisateur:** user1@test.com
- **Mot de passe:** S,r+pJaw08j~Lq%5gL^TcLikA?hG$3GefhS2[:4G,/ae0_6!-5

#### Utilisateur Standard N°2

- **Email utilisateur:** user2@test.com
- **Mot de passe:** 96}Y}ysq8,=/\*vZ~^!c;<xN{uBjJl<f^c4yuz;(l8jMJenq;DK
