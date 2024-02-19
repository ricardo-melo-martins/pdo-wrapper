<?php
/*
 * Database PDO Simple Wrapper
 * 
 * (c) RMM <github.com/ricardo-melo-martins>
 *
 */ 

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
