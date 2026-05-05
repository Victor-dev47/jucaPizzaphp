<?php
class Database {
    private $host = 'localhost';
    private $db_name = 'jucapizzasdb';
    private $username = 'root';
    private $password = 'usbw';
    private $ports = array('3310');
 
    public $conn;
 
 
    public function getConnection(){
 
        $this->conn = null;
        $lastError = null;
 
        foreach ($this->ports as $port) {
            try {
                // DSN (Data Source Name) - String de conexão
                $dsn = 'mysql:host=' . $this->host . ';port=' . $port . ';dbname=' . $this->db_name . ';charset=utf8';
 
                // Instancia o objeto PDO
                $this->conn = new PDO($dsn, $this->username, $this->password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
                return $this->conn;
            } catch (PDOException $e) {
                $lastError = $e->getMessage();
                continue;
            } catch (Throwable $e) {
                $lastError = $e->getMessage();
                continue;
            }
        }
 
        if ($lastError) {
            echo 'Erro de Conexão: ' . $lastError;
        }
 
        return $this->conn;
    }
}