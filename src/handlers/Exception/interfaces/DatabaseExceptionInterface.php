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

namespace RMM\handlers\exception\interfaces;

use RMM\handlers\exception\interfaces\ExceptionInterface;

interface DatabaseExceptionInterface extends ExceptionInterface
{
    public function getDriver(): ?string;
}
