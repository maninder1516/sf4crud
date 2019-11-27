
Symfony CRUD Demo Application
========================

The "Symfony Demo Application" is a reference application created to show how
to develop applications.

Requirements
------------

  * PHP 7.1.3 or higher;
  * PDO-MySql PHP extension enabled;
  * Symfony application requirements.

Installation
------------

Install the [Symfony client][4] binary and run this command:

```bash
$ symfony new --demo my_project
```

Alternatively, you can use Composer:

```bash
$ composer create-project symfony/symfony-demo my_project
```

Usage
-----

There's no need to configure anything to run the application. If you have
installed the [Symfony client][4] binary, run this command to run the built-in
web server and access the application in your browser at <http://localhost:8000>:

```bash
$ cd my_project/
$ symfony serve
```

If you don't have the Symfony client installed, run `php bin/console server:run`.
Alternatively, you can [configure a web server][3] like Nginx or Apache to run
the application.