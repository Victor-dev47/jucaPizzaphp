<?php
class Pizza {
    private $conn;
    private $tabela = "pizzas";

    public $idPizza;
    public $nome;
    public $ingredientes;
    public $valor;

    public function __construct($conexao) {
        $this->conn = $conexao;
    }

    public function getall() {
        if (!($this->conn instanceof PDO)) {
            return array();
        }

        $query = "SELECT idPizza, nome, ingredientes, valor FROM " . $this->tabela;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function read() {
        if (!($this->conn instanceof PDO)) {
            return false;
        }

        $query = "SELECT idPizza, nome, ingredientes, valor FROM " . $this->tabela;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function find($id) {
        $query = "SELECT idPizza, nome, ingredientes, valor FROM " . $this->tabela . " WHERE idPizza = :id LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create() {
        $query = "INSERT INTO " . $this->tabela . " (nome, ingredientes, valor) VALUES (:nome, :ingredientes, :valor)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':nome', $this->nome);
        $stmt->bindParam(':ingredientes', $this->ingredientes);
        $stmt->bindParam(':valor', $this->valor);
        return $stmt->execute();
    }

    public function update() {
        $query = "UPDATE " . $this->tabela . " SET nome = :nome, ingredientes = :ingredientes, valor = :valor WHERE idPizza = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':nome', $this->nome);
        $stmt->bindParam(':ingredientes', $this->ingredientes);
        $stmt->bindParam(':valor', $this->valor);
        $stmt->bindParam(':id', $this->idPizza, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function delete($id) {
        $query = "DELETE FROM " . $this->tabela . " WHERE idPizza = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
?>