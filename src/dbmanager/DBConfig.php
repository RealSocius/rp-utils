<?php

namespace utils\dbmanager;

use PDO;
use PDOException;

class DBConfig{

    /**
     * @var DBConfig $default - Default DBConfig
     */
    public static DBConfig $default;

    /**
     * @var PDO|null - PDO connection
     */
    private ?PDO $connection = null;

    /**
     * db_config constructor.
     * @param string $db_name
     * @param string $db_host
     * @param string $db_username
     * @param string $db_password
     * @param string|null $model_namespace
     */
    public function __construct(private string $db_name, private string $db_host, private string $db_username, private string $db_password, private ?string $model_namespace = null){

    }

    /**
     * @return string
     */
    public function getDbName(): string{
        return $this->db_name;
    }

    /**
     * @return string
     */
    public function getDbHost(): string{
        return $this->db_host;
    }

    /**
     * @return string
     */
    public function getDbUsername(): string{
        return $this->db_username;
    }

    /**
     * @return string
     */
    public function getDbPassword(): string{
        return $this->db_password;
    }

    /**
     * @return string|null
     */
    public function getModelNamespace(): ?string{
        return $this->model_namespace;
    }

    /**
     * @return PDO
     * @throws PDOException
     */
    public function getConnection(): PDO {
        if($this->connection == null){
            $dsn = 'mysql:host=' . $this->getDbHost() . ';dbname=' . $this->getDbName() . ';charset=utf8mb4';
            $this->connection = new PDO($dsn, $this->getDbUsername(), $this->getDbPassword());
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        return $this->connection;
    }

}