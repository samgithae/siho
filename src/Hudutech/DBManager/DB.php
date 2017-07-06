<?php


/**
 * Created by PhpStorm.
 * User: hudutech
 * Date: 4/1/17
 * Time: 11:46 PM
 */
namespace Hudutech\DBManager;
class DB
{
    /**
     * @var string
     */
    private $databaseName = 'clinic_db';
    /**
     * @var string
     */
    private $password = '';
    /**
     * @var string
     */
    private $databaseHost = 'localhost';
    /**
     * @var string
     */
    private $databaseUser = 'root';
    /**
     * @var
     */
    private $conn;

    /**
     * @return null|\PDO
     */
    public function connect(){
        try{

            $this->conn = new \PDO(
                "mysql:host={$this->databaseHost};
                 dbname={$this->databaseName}",
                $this->databaseUser,
                $this->password
            );

            return $this->conn;

        } catch (\PDOException $e){
            echo $e->getMessage();
            return null;
        }
    }

    /**
     * @return bool
     */
    public function closeConnection(){
        $this->conn = null;
        return true;
    }
}

