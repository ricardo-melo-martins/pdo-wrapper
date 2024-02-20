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

class DatabaseException extends \RuntimeException implements DatabaseExceptionInterface
{
    private ?string $driver;

    public function __construct(string $message, int $code = 0, \Throwable $previous = null, string $driver = null)
    {
        $this->driver = $driver;

        parent::__construct($message, $code, $previous);
    }

    public function getDriver(): ?string
    {
        return $this->driver;
    }
}
