<?php
/*
 * Database PDO Simple Wrapper
 * 
 * (c) RMM <github.com/ricardo-melo-martins>
 *
 */ 
 
declare(strict_types=1);

require('PDOConnection.php');

final class Database
{
    private static $connection;

    protected $_options = [];
    
    public function setConnection(PDOConnection $connection): void
    {
        self::$connection = $connection;     
    }
    
    public function getConnection(): PDOConnection
    {
        return self::$connection;
    }

    public function __construct(array $options = []) {
        
        $this->_options = $options;
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

    private function evaluateConnector(): object
    {
        $type = strtolower($this->_options['driver']);

        $database = $this->_options['database'];
        
        $dsn = "sqlite:$database";

        $connect = fn () => new \PDOConnection(
            $dsn
        );

        return $connect;
    }

    public function __destruct()
    {
        $this->disconnect();
    }
    
}
