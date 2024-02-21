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

$config = [];

$config['sqlite'] = [
    'driver' => 'sqlite',
    'database' => './examples/sqlite/data/Chinook.db',
];

$config['mysql'] = [
    'driver'=>'mysql',
    'hostname'=>'localhost',
    'database'=>'sakila',
    'username'=>'sakila',
    'password'=>'sakila',
];

$config['pgsql'] = [
    'driver'=>'pgsql',
    'hostname'=>'localhost',
    'database'=>'sakila',
    'username'=>'postgres',
    'password'=>'sakila',
    'port'=>5432,
    'charset'=>'utf8'
];
