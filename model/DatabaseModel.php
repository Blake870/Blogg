<?php
namespace Andrew\Blog\Models;

/**
 * Base for all database-models
 * @package Andrew\Blog\Models
 */
class DatabaseModel extends Model {
    const DB_HOST = "localhost";
    const DB_USER = "root";
    const DB_PASSWORD = "";
    const DB_NAME = "blog";

    /** @var \PDO */
    protected $connection;

    /**
     * @throws \PDOException if can't connect to the database
     */
    public function __construct() {
        $config = new Config();
        
        $dbHost = $config->dbHost;
        $dbUser = $config->dbUser;
        $dbPassword = $config->dbPassword;
        $dbName = $config->dbName;
        $this->connection = new \PDO(
            "mysql:host=$dbHost;dbname=$dbName", $dbUser, $dbPassword
        );
        $this->connection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    }

    /**
     * Make prepared statement from the query
     *
     * @param $query string
     * @return \PDOStatement ...
     */
    protected function prepare($query) {
        return $this->connection->prepare($query);
    }
}