<?php
/*
 * Database PDO Simple Wrapper
 * 
 * (c) RMM <github.com/ricardo-melo-martins>
 *
 */ 
 
declare(strict_types=1);

require('Database.php');
require('./examples/config/config.php');

try {

    $db = new Database($config['sqlite']);

    $db->connect();

} catch (\Throwable $th) {
    print_r($th->getMessage());
    exit;
}

// simple example
$connection = $db->getConnection();

$stmt = $connection->query("SELECT * FROM Employee");

foreach ($stmt as $row) {
    echo($row['EmployeeId'].' | '.$row['FirstName'].' | '.$row['LastName'].' | '.$row['Title'] . PHP_EOL );
}

unset($db);