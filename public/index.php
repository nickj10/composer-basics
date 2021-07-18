<?php

declare(strict_types=1);


require_once __DIR__ . '/../vendor/autoload.php';

require 'src/Model/User.php';
// use Faker\Factory;

// $faker = Factory::create();

$user = new User(1, "Nicole Marie Jimenez");

echo $user->name();
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