<?php
/*
 * Database PDO Simple Wrapper
 * 
 * (c) RMM <github.com/ricardo-melo-martins>
 *
 */ 
interface DatabaseExceptionInterface extends ExceptionInterface
{
    public function getDriver(): ?string;
}
