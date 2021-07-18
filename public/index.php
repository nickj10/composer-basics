<?php

declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';

use SallePW\Model\User;
use SallePW\Model\Book;
// use Faker\Factory;

// $faker = Factory::create();

$user = new User(1, "Nicole Marie Jimenez");
$book = new Book("Design Systems", "Design", "Alla Kholmatova", 2017);

echo $user->getName();
echo $book->getName();
?>
<!-- 
<!DOCTYPE html> 
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Composer Basics</title>
</head>

<body>
    <h1>User list</h1>
    <p><?php echo $user->name() ?></p>
</body>

</html> -->