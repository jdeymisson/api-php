<?php
namespace App\models;

use PDO;

class ClientModel extends BaseModel {
    
    public function getAll() {
        $query = "SELECT * FROM cliente";
        $sql = $this->pdo->prepare($query);
        $sql->execute();

        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function getBy($id = null, $cpf = null, $email = null) {
        $query = "SELECT * FROM cliente WHERE ";
        $params = [];

        if (!is_null($id)) {
            $query .= "id = :id";
            $params[':id'] = $id;
        } elseif (!is_null($cpf)) {
            $query .= "cpf = :cpf";
            $params[':cpf'] = $cpf;
        } elseif (!is_null($email)) {
            $query .= "email = :email";
            $params[':email'] = $email;
        }

        $sql = $this->pdo->prepare($query);
        
        foreach ($params as $param => $value) {
            $sql->bindParam($param, $value);
        }
        $sql->execute();
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create($data) {
       $query = "INSERT INTO cliente (nome, cpf, endereco, email ) VALUES (:nome, :cpf, :endereco, :email)";
       $sql = $this->pdo->prepare($query);
       $sql->bindParam(':nome', $data['nome']);
       $sql->bindParam(':cpf', $data['cpf']);
       $sql->bindParam(':endereco', $data['endereco']);
       $sql->bindParam(':email', $data['email']);
       $sql->execute();
    }

    public function update($data) {
        if (!isset($data['id'])) {
            throw new \Exception('É necessário informar o ID para atualização das informações!');
        }
    
        $query = "UPDATE cliente SET nome = :nome, cpf = :cpf, endereco = :endereco, email = :email WHERE id = :id";
        $sql = $this->pdo->prepare($query);
        
        $sql->bindParam(':id', $data['id'], PDO::PARAM_INT);
        $sql->bindParam(':nome', $data['nome']);
        $sql->bindParam(':cpf', $data['cpf']);
        $sql->bindParam(':endereco', $data['endereco']);
        $sql->bindParam(':email', $data['email']);
        $sql->execute();
    
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function delete($id) {
        $query = "DELETE FROM cliente WHERE id = :id";
        $sql = $this->pdo->prepare($query);
        $sql->bindParam(':id', $id, PDO::PARAM_INT);
        $sql->execute();
    
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
