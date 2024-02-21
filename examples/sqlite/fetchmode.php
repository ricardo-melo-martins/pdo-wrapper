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
use RMM\PDOConnection;
use RMM\handlers\exception\DatabaseException;

require('./examples/config/config.php');

try {

    $db = new Database($config['sqlite']);

    // https://www.php.net/manual/en/pdostatement.fetch.php
    // FETCH_LAZY, FETCH_ASSOC, FETCH_NUM, FETCH_BOTH(default), FETCH_NAMED, FETCH_OBJ
    $db->getDriver()->setDefaultFetchMode(PDOConnection::FETCH_ASSOC);
    
    $db->connect();

} catch (DatabaseException $e) {
    print $e->getMessage();
    exit;
}

if($db->isConnected()){

    $connection = $db->getConnection();

    echo 'Fetch mode: ' . $connection->getAttribute(constant('PDO::ATTR_DEFAULT_FETCH_MODE')).PHP_EOL;

    $stmt = $connection->query("SELECT * FROM Employee");

    foreach ($stmt as $row) {
        echo($row['EmployeeId'].' | '.$row['FirstName'].' | '.$row['LastName'].' | '.$row['Title'] . PHP_EOL );
    }
}

unset($db);