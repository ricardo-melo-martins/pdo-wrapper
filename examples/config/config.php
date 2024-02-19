<?php
/*
 * Database PDO Simple Wrapper
 * 
 * (c) RMM <github.com/ricardo-melo-martins>
 *
 */ 

$config = [];

$config['sqlite'] = [
    'driver' => 'sqlite',
    'database' => './examples/ex1/data/Chinook.db',
];

$config['mysql'] = [
    'driver'=>'mysql',
    'hostname'=>'localhost',
    'database'=>'sakila',
    'username'=>'sakila',
    'password'=>'sakila',
];

