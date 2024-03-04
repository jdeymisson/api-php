<?php
namespace App\models;

use PDO;

class PaymentModel extends BaseModel {
    
    public function getAll() {
        $query = "SELECT * FROM forma_pagamento ORDER BY nome";
        $sql = $this->pdo->prepare($query);
        $sql->execute();

        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function getBy($id = null, $nome = null, $parcelas = null) {
        $query = "SELECT * FROM forma_pagamento WHERE ";
        $params = [];

        if (!is_null($id)) {
            $query .= "id = :id";
            $params[':id'] = $id;
        } elseif (!is_null($nome)) {
            $query .= "nome = :nome";
            $params[':nome'] = $nome;
        }

        $sql = $this->pdo->prepare($query);
        
        foreach ($params as $param => $value) {
            $sql->bindParam($param, $value);
        }
        $sql->execute();
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create($data) {
       $query = "INSERT INTO forma_pagamento (nome, parcelas ) VALUES (:nome, :parcelas)";
       $sql = $this->pdo->prepare($query);
       $sql->bindParam(':nome', $data['nome']);
       $sql->bindParam(':parcelas', $data['parcelas']);
       $sql->execute();
    }

    public function update($data) {
        $query = "UPDATE forma_pagamento SET nome = :nome, parcelas = :parcelas WHERE id = :id";
        $sql = $this->pdo->prepare($query);
        
        $sql->bindParam(':id', $data['id'], PDO::PARAM_INT);
        $sql->bindParam(':nome', $data['nome']);
        $sql->bindParam(':parcelas', $data['parcelas']);
        $sql->execute();
    
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function delete($id) {
        $query = "DELETE FROM forma_pagamento WHERE id = :id";
        $sql = $this->pdo->prepare($query);
        $sql->bindParam(':id', $id, PDO::PARAM_INT);
        $sql->execute();
    
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
