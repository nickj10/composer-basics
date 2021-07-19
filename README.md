# Getting started with composer

In this exercise we are going to explore some of the basic commands and functionalities of composer, the PHP's package manager.

## Prerequisites

In this exercise we will install composer inside a docker container so we need to have docker installed.

## Introduction

We will use composer to install **Faker**, a PHP library that generates fake data for you. To achieve this, we will use **composer** to install the dependencies and to _autoload_ our own classes in this exercise.

## Hands on

You can start by cloning the repository using the following command:

```
git clone <composer-basics>
```

Now, we are going to initialize the project by running the `docker run --rm --interactive --tty -v $(pwd):/app composer init` command. This command is going to ask you a few questions about the project that you need to answer. After finishing all the questions, it should create a file called **composer.json** with all the provided information.

- If you are using Windows PowerShell, use curly brackets for the `pwd` command: `docker run --rm --interactive --tty -v ${pwd}:/app composer init`.

If you open it with your favourite editor, it should look something like this:

```json
{
  "name": "nicolemariejimenez/composer-basics",
  "description": "An introduction to composer",
  "type": "project",
  "authors": [
    {
      "name": "Nicole Marie Jimenez",
      "email": "nicolemarie.jimenez@students.salle.url"
    }
  ],
  "require": {}
}
```

Now we are going to install the **Faker** library from [Packagist](https://packagist.org/). Open your terminal and type the following command:

```
docker run --rm --interactive --tty -v $(pwd):/app composer require fzaninotto/faker
```

At this point, if you open the _composer.json_ file, you will notice that a new key _require_ has been added containing the **Faker** dependency. Moreover, you should also notice that a new folder called **vendor** has been created in the root folder of the project. If you open it, it should look like this:

```
vendor
├── autoload.php
├── composer
└── fakerphp
```

As you can see, the package "fzaninotto" was added. This is the vendor name of the package. If we open the directory, we can see:

```
vendor
├── autoload.php
├── composer
└── fakerphp
    └── faker
```

Let's first take a look at the **Faker** package. Inside the folder with the vendor name, we can see the name of the package or dependency: **faker**. If we open this folder, we will be able to see the source code of the dependency. This is because **composer** installed this package with the latest published source code.

**Note:** Don't modify anything inside vendor/ folder. With the composer.json, we should be able to install the dependencies.

Now, we want to add another dependency to our project. We want to be able to add logs to our application and save them to a file. We can use the **monolog** package.

Using the same command to install the Faker package, let's install the **monolog** package.

```
docker run --rm --interactive --tty -v $(pwd):/app composer require monolog/monolog
```

Open the vendor folder again. As you can see, aside from the **monolog** package, the **psr** package was also installed. That's because **composer** has also installed all the dependencies of **monolog** for us.

Finally, take a look at the `composer.lock` file. This is the file where Composer specifies the specific version that has been installed. This file should be always committed to Git.

### Namespaces

We can tell composer the Namespaces that we want to use to _autoload_ our code from the **src** folder. To do so, copy the following snippet at the end of the **composer.json** file:

```json
"autoload": {
    "psr-4": {
        "SallePW\\": "src/"
    }
}
```

**Note:** Remember to add a comma before adding this new property.

After indicating the Namespaces, need to run the command `docker run --rm --interactive --tty -v $(pwd):/app composer dump-autoload` to force composer to update the autoloader located at `./vendor/autoload.php`.

With this, we are defining a mapping from namespaces to directories. The `src/` directory would be in your project root.

Now, let's try to build our code and see all of these working.

# Creating the model class

We will be creating an simple application that shows a list of random user names.

First, create the `index.php` where the main code will be. This file is inside the `public` folder.

```
<?php
declare(strict_types=1);

?>
```

You can observe that the first line is `declare(strict_types=1);`. By setting `strict_types=1`, you tell the engine that `int $x` means `$x must only be an int property, no type coercion allowed.` You have the great assurance you're getting exactly and only what was given, without any conversion or potential loss.

Now, create `src/Model` folder in the base directory of the project. Inside the `Model` folder, create a class called `User`.

```
<?php

declare(strict_types=1);

namespace SallePW\Model; // this class is in the SallePW\Model namespace

final class User
{

    public function __construct(private int $id, private string $name)
    {
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName(string $name)
    {
        $this->name = $name;
        return $this;
    }
}

```

You can see that we are saying that this class is in `SallePW\Model` namespace. After creating the User class, we are ready to use it in our application.

In the `index.php` file, add the following code:

```
$user = new User(1, "Nicole Marie Jimenez");

echo $user->getName();
```

Open http://localhost:8030/ in your favorite browser. What error do you see? You may see this error on the page:

```
Fatal error: Uncaught Error: Class "User" not found in /app/public/index.php:8
```

Why did this happen? The error says that the "User" class is not found. You are trying to use instantiate the User class, but it is not imported. To fix this, add this line just below the `require_once` line:

```
require '../src/Model/User.php'; // remember that the index.php is inside the public folder
```

If you open http://localhost:8030/ again, what error is shown? Since the `User` class now is namespaced, you need to use the fully qualified name that includes the namespace like this:

```
<?php

declare(strict_types=1);

require '../src/Model/User.php';

$user = new SallePW\Model\User(1, "Nicole Marie Jimenez");

echo $user->getName();
?>
```

This will work. However, to take advantage of PHP namespaces, you can import a class from a namespace instead of importing the namespace. Add the the following line just below `require '../src/Model/User.php';`:

```
use SallePW\Model\User;
```

The `use` operator lets you import the `User` class from the `SallePW\Model` namespace. Therefore, we don’t have to prefix the class name with the namespace.

```
$user = new User(1, "Nicole Marie Jimenez"); // you can directly use the User class
```

What if there are more classes inside the same namespace? Add another class called `Book` inside the `Model` folder.

```
<?php

declare(strict_types=1);

namespace SallePW\Model;

final class Book {
  public function __construct(
    private string $name,
    private string $genre,
    private string $author,
    private int $year)
    {
    }

    public function getName() {
      return $this->name;
    }

    public function getGenre() {
      return $this->genre;
    }

    public function getAuthor() {
      return $this->author;
    }

    public function getYear() {
      return $this->year;
    }
}
```

To be able to use both classes, you can import them individually:

```
require '../src/Model/User.php';
require '../src/Model/Book.php';

use SallePW\Model\User;
use SallePW\Model\Book;

$user = new User(1, "Nicole Marie Jimenez");
$book = new Book("Design Systems", "Design", "Alla Kholmatova", 2017);

echo $user->getName();
echo $book->getName();
```

But, there is a way to simplify this. Both of these classes are in the same namespace. You have previously defined in the `composer.json` the namespaces. Instead of having to use `require` for each file individually, you can take advantage of the namespaces. First, remove the following lines:

```
require '../src/Model/User.php';
require '../src/Model/Book.php';
```

Check the browser again. What error do you see? Why do you think PHP raised that error?

Now, just below the `declare(strict_types=1);` line, add the `autoload.php` file which is inside the `vendor/` folder. This will load the namespaces defined in `composer.json`.

```
<?php

declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';

use SallePW\Model\User;
use SallePW\Model\Book;
```

With this, you will be able to use the `User` class and `Book` class to instantiate new objects. These two classes are the classes that you have created yourself. Now, it's time to use the classes that come from the packages or dependencies that you installed using **composer**.

# Using packages

Thanks to Composer's `vendor/autoload.php`, which is used for autoloading libraries for PHP projects, third party packages are visible to the application. Autoloading allows us to use PHP files without the need to `require()` or `include()` them and is considered a hallmark of modern-day programming. Including files individually as we have seen before will become even more difficult if the project depends on a lot of external libraries or packages. That's why this is an easy way of loading files.

First, we want to generate fake data with the [**Faker**](https://github.com/FakerPHP/Faker/blob/main/README.md) package. According to the documentation, you can start using the package by creating the Faker:

```
use Faker\Factory; // using the Factory class included in the Faker package

$faker = Factory::create();
```

Use this faker to create random user names.

```
<?php

declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';

use SallePW\Model\User;
use SallePW\Model\Book;
use Faker\Factory;

$faker = Factory::create();

$user = new User(1, $faker->name());
$book = new Book("Design Systems", "Design", "Alla Kholmatova", 2017);

// echo $user->getName();
// echo $book->getName();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Composer Basics</title>
    <style>
        th,
        td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
    </style>
</head>

<body>
    <h1>Library system</h1>
    <table>
        <tr>
            <th>User</th>
            <th>Book</th>
            <th>Author</th>
        </tr>
        <tr>
            <td><?php echo $user->getName(); ?></td>
            <td><?php echo $book->getName(); ?></td>
            <td><?php echo $book->getAuthor(); ?></td>
        </tr>

    </table>
</body>

</html>
```

Try refreshing your page. Every time you refresh it, you will see a different name. You can experiment more on installing packages using **Composer** and using them in your application.
