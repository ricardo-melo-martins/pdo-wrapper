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

namespace RMM\drivers;

use RMM\drivers\interfaces\DriverInterface as IDriver;
use RMM\drivers\DriverAbstract;

class MysqlDriver extends DriverAbstract implements IDriver
{

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

    public function __construct(array $options = []) 
    {
        parent::__construct($options);
    }

    public function getFlagsAttributes() : array 
    {
        $options = [
            // PDO::ATTR_AUTOCOMMIT,
            // PDO::ATTR_CASE,
            // PDO::ATTR_CLIENT_VERSION,
            // PDO::ATTR_CONNECTION_STATUS,
            // PDO::ATTR_DRIVER_NAME,
            // PDO::ATTR_ORACLE_NULLS,
            // PDO::ATTR_PREFETCH,
            // PDO::ATTR_SERVER_INFO,
            // PDO::ATTR_SERVER_VERSION,
            \PDO::ATTR_PERSISTENT => true,
            \PDO::ATTR_ERRMODE            => \PDO::ERRMODE_EXCEPTION,
            \PDO::ATTR_DEFAULT_FETCH_MODE => $this->_fetch,
            \PDO::ATTR_EMULATE_PREPARES   => false,
            \PDO::ATTR_TIMEOUT => $this->_timeout,
        ];

        return $options;
    }

    public function getConnectionString() : string {
        
        $opts = '';
        
        $dsn = "mysql:host={$this->getHostname()};port={$this->getPort()};dbname={$this->getDatabase()};charset={$this->getCharset()}{$opts}";

        return $dsn;
    }

}