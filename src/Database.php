<?php
/*
 * Database PDO Simple Wrapper
 * 
 * (c) RMM <github.com/ricardo-melo-martins>
 *
 */ 
 
declare(strict_types=1);

require('PDOConnection.php');
require('ConnectorConfiguration.php');

require('handlers/exception/interface/ExceptionInterface.php');
require('handlers/exception/interface/DatabaseExceptionInterface.php');
require('handlers/exception/DatabaseException.php');
require('handlers/exception/DatabaseDriverNotFoundException.php');

final class Database
{
    private static $driver;

    private static $connection;

    protected static array $_installed_drivers;

    protected ConnectorConfiguration $connectorConfiguration; 

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
    
    public function setDriver(string $driver): void
    {
        $_driver = strtolower($driver);

        if(!in_array($_driver, self::$_installed_drivers))
        {
            throw new DatabaseDriverNotFoundException(null, 0, null, $_driver);
        }

        self::$driver = $_driver;
    }

    public function getDriver() : string {
        return self::$driver;
    }

    public function __construct(array $options = []) {

        self::$_installed_drivers = PDOConnection::getAvailableDrivers();

        if(!isset($options['driver']) || empty($options['driver'])){
            throw new DatabaseDriverNotFoundException(null, 0, null, $options['driver']);
        }
        
        $this->setDriver($options['driver']);

        $this->connectorConfiguration = new ConnectorConfiguration($options, $this->getDriver());
 
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

        $dsn = $this->connectorConfiguration->getConnectionString();

        $connect = fn () => new \PDOConnection(
            $dsn,
            $this->connectorConfiguration->getUsername(),
            $this->connectorConfiguration->getPassword(),
            $this->connectorConfiguration->getFlagsAttributes(),
        );

        return $connect;
    }
    
}
