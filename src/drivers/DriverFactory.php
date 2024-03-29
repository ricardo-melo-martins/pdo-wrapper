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

use RMM\drivers\MysqlDriver;
use RMM\drivers\SqliteDriver;
use RMM\drivers\PgsqlDriver;

class DriverFactory
{

    private array $_options;

    public function __construct(array $options = []) 
    {
        $this->_options = $options;
    }

    public function create(string $driver_name) 
    {
        return match ($driver_name) {
            'mysql' => new MysqlDriver($this->_options),
            'pgsql' => new PgsqlDriver($this->_options),
            'sqlite' => new SqliteDriver($this->_options),
            default => throw new DatabaseDriverNotFoundException(),
        };
    }
    
}