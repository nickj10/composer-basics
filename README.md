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

* If you are using Windows PowerShell, use curly brackets for the `pwd` command: `docker run --rm --interactive --tty -v ${pwd}:/app composer init`.

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
└── fzaninotto
```

As you can see, the package "fzaninotto" was added. This is the vendor name of the package. If we open the directory, we can see:

```
vendor
├── autoload.php
├── composer
└── fzaninotto
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

#

