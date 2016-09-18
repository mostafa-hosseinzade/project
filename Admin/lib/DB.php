<?php

namespace lib;

use lib\DBTable;

/**
 * This Class Can Connect To DataBase
 *
 * @author Mr.Mostafa Hosseinzade
 */
class DataBase {

    private $DB_HOST = 'localhost';
    private $DB_USERNAME = 'root';
    private $DB_PASSWORD = 'root';
    private $DB_TYPE = 'mysql';
    private $DB_NAME = 'project';
    private $DB_PORT = '3306';
    protected $pdo;

    /**
     * Connect To DataBase
     */
    public function __construct() {
        try {
            $this->pdo = new \PDO(
                    $this->DB_TYPE .
                    ":host=" . $this->DB_HOST .
                    ";port=" . $this->DB_PORT .
                    ";charset=utf8" .
                    ";dbname=" . $this->DB_NAME, $this->DB_USERNAME, $this->DB_PASSWORD, array(
                \PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
            ));
            $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        } catch (\PDOException $e) {
            return 'Can,t Connect to database' . $e->getMessage();
        }
    }

    /**
     * Close Connection  To DataBase
     */
    public function CloseLink() {
        $this->pdo = NULL;
    }

    /**
     * @param string $table
     * @return \lib\DBTable
     */
    public function getTable($table) {
        return new DBTable($table);
    }
    
     /**
     * This Function for Speciale Query
     * @param string $sql
     * @return array
     */
    public function query($sql) {
        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            $data = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            
            return $data;
        } catch (\PDOException $exc) {
            echo $exc->getMessage();
            echo '<br><pre>';
            echo $exc->getTraceAsString();
        }
    }

}
