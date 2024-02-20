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

class PgsqlDriver extends DriverAbstract implements IDriver
{

    protected $_config_default_values = [
        'pgsql' => [
            'driver'=>'pgsql',
            'hostname'=>'localhost',
            'database'=>'master',
            'username'=>'root',
            'password'=>'P@ssw0rd',
            'port'=>5432,
            'charset'=>'utf8',
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
            \PDO::ATTR_PERSISTENT => true,
            \PDO::ATTR_ERRMODE            => \PDO::ERRMODE_EXCEPTION,
            \PDO::ATTR_EMULATE_PREPARES   => false,
            \PDO::ATTR_TIMEOUT => 5
        ];

        return $options;
    }

    public function getConnectionString() : string {
        
        $opts = '';
        
        $dsn = "pgsql:host={$this->getHostname()};port={$this->getPort()};dbname={$this->getDatabase()};user={$this->getUsername()};password={$this->getPassword()}{$opts}";

        return $dsn;
    }

}