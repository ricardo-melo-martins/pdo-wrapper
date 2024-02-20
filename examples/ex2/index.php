<?php
/*
 * Database PDO Simple Wrapper
 * 
 * (c) RMM <github.com/ricardo-melo-martins>
 *
 */ 
 
declare(strict_types=1);

require('src/Database.php');
require('./examples/config/config.php');

try {

    $db = new Database($config['mysql']);

    $db->connect();

} catch (\Throwable $th) {
    print_r($th->getMessage());
    exit;
}

// simple example
$connection = $db->getConnection();

$query = 'SELECT * from sakila.actor';

$stmt = $connection->query($query);

foreach ($stmt as $row) {
    echo($row[0].' | '.$row[1] .PHP_EOL );
}

unset($db);