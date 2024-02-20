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

namespace RMM\handlers\exception;

use RMM\handlers\exception\DatabaseException;

class ConnectionNotFoundException extends DatabaseException
{
    public function __construct(string $message = null, int $code = 0, \Throwable $previous = null, string $driver = null)
    {
        if (null === $message) {
            $message = 'Conexão não pode ser feita, verifique o arquivo de configuração.';
        }

        parent::__construct($message, $code, $previous, $driver);
    }
}
