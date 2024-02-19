<?php 
/*
 * Database PDO Simple Wrapper
 * 
 * (c) RMM <github.com/ricardo-melo-martins>
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
