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

abstract class DriverAbstract
{
    protected array $_options = [];

    public function getType() : string {
        return $this->_options['driver'];
    }

    public function getHostname() : string {
        return $this->_options['hostname'];
    }

    public function getUsername() : string {
        return isset($this->_options['username']) ? $this->_options['username'] : '';
    }

    public function getPassword() : string {
        return isset($this->_options['password']) ? $this->_options['password'] : '';
    }

    public function getDatabase() : string {
        return $this->_options['database'];
    }

    public function getPort() : string|int {
        return $this->_options['port'];
    }

    public function getCharset() : string {
        return $this->_options['charset'];
    }

    public function __construct(array $options = []) 
    {
        $this->evaluateOptions($options);
    }

    public function evaluateOptions(array $options): void
    {
        $this->setOptions($options);
    }

    public function setOptions(array $options): void
    {
        $driver = $options['driver'];

        if(isset($this->_config_default_values[$driver]))
        {
            $this->_options = array_merge($this->_config_default_values[$driver], $options);
        } else {
            $this->_options = $options;
        }
    }    

}