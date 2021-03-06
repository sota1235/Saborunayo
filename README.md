Saborunayo
====

[![Build Status](https://travis-ci.org/sota1235/Saborunayo.svg)](https://travis-ci.org/sota1235/Saborunayo) [![Coverage Status](https://coveralls.io/repos/sota1235/Saborunayo/badge.svg?branch=master&service=github)](https://coveralls.io/github/sota1235/Saborunayo?branch=master) [![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/sota1235/Saborunayo/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/sota1235/Saborunayo/?branch=master)

Don't be lazy.

This application is for TechCrunch Tokyo Hackathon.

### Description

Sabounayo watch your GitHub activity and warning you to develp through Telephone.

### Demo

[DEMO Page](http://saborunayo.sota1235.net/)

![](https://i.gyazo.com/92b1ba16528b6b26d1e7ab582f4a39cd.png)

![](https://i.gyazo.com/8317518b3d5680b4d8b277be9be72dad.png)

### Requirement

- Laravel 5.1
- PHP 5.6
- sqlite3
- babel.js 5.8

### Usage

Enter your GitHub name and Yo name.

SaborunaYo yo to your Yo account when you do not contribute to GitHub.

### Install

Install packages.

```shell
$ composer install

$ npm i
```

Build javascript and css.

```shell
$ gulp
```

Migrate database. You need sqite3.

```shell
$ sqlite3 database/database.sqlite .database

$ php artisan migrate
```

Copy `.env.example` and edit it for your enviroment.

```shell
$ cp .env.example .env
```

You need some API keys.

- [GitHub API](https://developer.github.com/)
- [twilio API](https://jp.twilio.com/docs/api)

### Tests

Before test, you need to make database of sqlite3.

Testing required PHPUnit.

```shell
$ sqlite3 database/database_test.sqlite .database

$ ./vendor/bin/phpunit
```

### Contribution

Bug reports and pull requests are welcome on GitHub at https://github.com/sota1235/saborunayo. This project is intended to be a safe, welcoming space for collaboration, and contributors are expected to adhere to the [Contributor Covenant](contributor-covenant.org) code of conduct.

### Licence

This software is released under the MIT License, see LICENSE.txt.

## Author

[@sota1235](https://github.com/sota1235)
