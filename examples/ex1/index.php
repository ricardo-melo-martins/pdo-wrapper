<?php
/**
 * RMM PDO Wrapper
 * 
 * Biblioteca para abstração de dados usando PDO para conectar em vários bancos de dados
 * 
 *
 * @link        https://github.com/ricardo-melo-martins/pdo-wrapper
 * @author      Ricardo Melo Martins
 * @license     https://opensource.org/licenses/mit-license.php  MIT License
 * 
 */ 
 
declare(strict_types=1);

if (! defined('RMM_VERSION')) {
    require_once dirname(dirname(__DIR__)) . '/autoload.php';
}

use RMM\Database;

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