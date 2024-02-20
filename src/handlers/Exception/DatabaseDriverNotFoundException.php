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

class DatabaseDriverNotFoundException extends DatabaseException
{
    public function __construct(string $message = null, int $code = 0, \Throwable $previous = null, string $driver = null)
    {
        if (null === $message) {
            if (null === $driver || empty($driver)) {
                $message = 'Driver could not be found.';
            } else {
                $message = sprintf('Driver "%s" could not be found.', $driver);
            }
        }

        parent::__construct($message, $code, $previous, $driver);
    }
}
