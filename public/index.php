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