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
use RMM\handlers\exception\DatabaseException;

require('./examples/config/config.php');

try {

    $db = new Database($config['pgsql']);

    $db->connect();

} catch (DatabaseException $e) {
    print $e->getMessage();
    exit;
}

if($db->isConnected()){

    $connection = $db->getConnection();

    $query = 'SELECT * from actor LIMIT 10';

    $stmt = $connection->query($query);

    foreach ($stmt as $row) {
        echo($row[0].' | '.$row[1] .PHP_EOL );
    }
}

unset($db);