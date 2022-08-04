[![SymfonyInsight](https://insight.symfony.com/projects/a71d865f-dbc8-45d6-bfe8-791a924875ed/big.svg)](https://insight.symfony.com/projects/a71d865f-dbc8-45d6-bfe8-791a924875ed)
[![PHP](https://img.shields.io/badge/PHP%20version-%3E%3D%208-blue)](https://www.php.net/releases/8.0/en.php)
[![Twig](https://img.shields.io/badge/Twig-3.4.2-green)](https://twig.symfony.com/)

# Description

SnowTricks is a snowboard-based community site, which allows all users to add, edit, delete and comment on a snowboard trick

## Installation

Download the project

```bash
git clone https://github.com/DylanGermann/SnowTricks.git
```
Create your database and choose the mailer you want use. [Here a documentation](https://symfony.com/doc/current/mailer.html)

Edit these two .env variables 
```bash
DATABASE_URL=
MAILER_DSN=
```
Install SnowTricks database schema
```php
php bin/console doctrine:migrations:migrate 
```
Install the fixtures (fake data)
```php
php bin/console doctrine:fixtures:load
```

## Start the project
Start the project with Symfony CLI
```php
symfony server:start
```
Start the mailer
```php
php bin/console messenger:consume
```

