<?php
/*
 * Database PDO Simple Wrapper
 * 
 * (c) RMM <github.com/ricardo-melo-martins>
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
