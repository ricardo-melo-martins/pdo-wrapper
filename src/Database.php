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

require('PDOConnection.php');
require('drivers/DriverFactory.php');

require('handlers/exception/interfaces/ExceptionInterface.php');
require('handlers/exception/interfaces/DatabaseExceptionInterface.php');
require('handlers/exception/DatabaseException.php');
require('handlers/exception/DatabaseDriverNotFoundException.php');
require('handlers/exception/ConnectionNotFoundException.php');

final class Database
{
    private $_driver_name;

    protected $driver; 

    private static $connection;

    public function setConnection(PDOConnection $connection): void
    {
        if(!$connection instanceof PDO)
        {
            throw new ConnectionNotFoundException();
        }   

        self::$connection = $connection;     
    }
    
    public function getConnection(): PDOConnection
    {
        return self::$connection;
    }
    
    public function setDriverName(string $driver_name): void
    {
        $_driver = strtolower($driver_name);

        if(!in_array($_driver, PDOConnection::getAvailableDrivers()))
        {
            throw new DatabaseDriverNotFoundException(null, 0, null, $_driver);
        }

        $this->_driver_name = $_driver;
    }

    public function getDriverName() : string {
        return $this->_driver_name;
    }

    public function __construct(array $options = []) 
    {

        if(!isset($options['driver']) || empty($options['driver'])){
            throw new DatabaseDriverNotFoundException(null, 0, null, $options['driver']);
        }
        
        $this->setDriverName($options['driver']);

        $this->driver = (new DriverFactory($options))->create($this->getDriverName());
 
    }

    public function connect(): void
    {
        try {

            $connect = $this->evaluateConnector();

            $this->setConnection($connect());

        } catch(\PDOException $exception){
            
            throw $exception;
        
        }
    }

    public function disconnect(): void
    {
        self::$connection = null;
    }
    
    public function __destruct()
    {
        $this->disconnect();
    }

    private function evaluateConnector(): object
    {

        $dsn = $this->driver->getConnectionString();

        $connect = fn () => new \PDOConnection(
            $dsn,
            $this->driver->getUsername(),
            $this->driver->getPassword(),
            $this->driver->getFlagsAttributes(),
        );

        return $connect;
    }
    
}
