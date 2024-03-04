<?php
namespace App\models;

use PDO;

class ProductModel extends BaseModel {
    
    public function getAll() {
        $query = "SELECT * FROM produto ORDER BY nome";
        $sql = $this->pdo->prepare($query);
        $sql->execute();

        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function getBy($id = null, $nome = null, $quantidade = null, $preco = null) {
        $query = "SELECT * FROM produto WHERE ";
        $params = [];

        if (!is_null($id)) {
            $query .= "id = :id";
            $params[':id'] = $id;
        } elseif (!is_null($nome)) {
            $query .= "nome = :nome";
            $params[':nome'] = $nome;
        } elseif (!is_null($quantidade)) {
            $query .= "quantidade = :quantidade";
            $params[':quantidade'] = $quantidade;
        }

        $sql = $this->pdo->prepare($query);
        
        foreach ($params as $param => $value) {
            $sql->bindParam($param, $value);
        }
        $sql->execute();
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create($data) {
       $query = "INSERT INTO produto (nome, quantidade, preco ) VALUES (:nome, :quantidade, :preco)";
       $sql = $this->pdo->prepare($query);
       $sql->bindParam(':nome', $data['nome']);
       $sql->bindParam(':quantidade', $data['quantidade']);
       $sql->bindParam(':preco', $data['preco']);
       $sql->execute();
    }

    public function update($data) {
        $query = "UPDATE produto SET nome = :nome, quantidade = :quantidade, preco = :preco WHERE id = :id";
        $sql = $this->pdo->prepare($query);
        
        $sql->bindParam(':id', $data['id'], PDO::PARAM_INT);
        $sql->bindParam(':nome', $data['nome']);
        $sql->bindParam(':quantidade', $data['quantidade']);
        $sql->bindParam(':preco', $data['preco']);
        $sql->execute();
    
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function delete($id) {
        $query = "DELETE FROM produto WHERE id = :id";
        $sql = $this->pdo->prepare($query);
        $sql->bindParam(':id', $id, PDO::PARAM_INT);
        $sql->execute();
    
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
