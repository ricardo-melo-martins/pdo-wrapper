<?php
/*
 * Database PDO Simple Wrapper
 * 
 * (c) RMM <github.com/ricardo-melo-martins>
 *
 */ 

class ConnectorConfiguration
{

    protected array $_options = [];

    protected $_config_default_values = [
        'mysql' => [
            'driver'=>'mysql',
            'hostname'=>'localhost',
            'database'=>'master',
            'username'=>'root',
            'password'=>'P@ssw0rd',
            'port'=>3306,
            'charset'=>'utf8mb4',
            'encoding'=>'utf8mb4',
            'persistent' => false,
            'timezone' => 'UTC',
            'cache' => false,
        ]
    ];

    public function getType() : string {
        return $this->_options['driver'];
    }

    public function getHostname() : string {
        return $this->_options['hostname'];
    }

    public function getUsername() : string {
        return isset($this->_options['username']) ? $this->_options['username'] : '';
    }

    public function getPassword() : string {
        return isset($this->_options['password']) ? $this->_options['password'] : '';
    }

    public function getDatabase() : string {
        return $this->_options['database'];
    }

    public function getPort() : string|int {
        return $this->_options['port'];
    }

    public function getCharset() : string {
        return $this->_options['charset'];
    }

    public function __construct(array $options = [], string $driver) 
    {
        $this->evaluateOptions($options);
    }

    public function evaluateOptions(array $options): void
    {
        $this->setOptions($options);
    }

    public function setOptions(array $options): void
    {
        $driver = $options['driver'];

        if(isset($this->_config_default_values[$driver]))
        {
            $this->_options = array_merge($this->_config_default_values[$driver], $options);
        } else {
            $this->_options = $options;
        }
    }
    
    public function getFlagsAttributes() : array {
        return [];
    }

    public function getConnectionString() : string {
        
        $opts = '';

        switch ($this->getType()) {
            case 'mysql':
                $dsn = "mysql:host={$this->getHostname()};port={$this->getPort()};dbname={$this->getDatabase()};charset={$this->getCharset()}{$opts}";

                break;
            case 'pgsql':
                $dsn = "pgsql:host={$this->getHostname()};port={$this->getPort()};dbname={$this->getDatabase()};user={$this->getUsername()};password={$this->getPassword()}{$opts}";

                break;
            case 'sqlite':
                $dsn = "sqlite:{$this->getDatabase()}";
                
                break;
            default:

                break;
        }

        return $dsn;
    }
}