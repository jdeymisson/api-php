<?php
namespace App\models;

use PDO;

class SaleModel extends BaseModel {
    
    public function getAll() {
        $query ="
            SELECT
                v.id as id_venda,
                c.nome as nome_cliente,
                c.cpf,
                v.data_venda,
                fp.nome as forma_pagamento,
                v.produto
	        FROM
                venda v
            INNER JOIN cliente c on
                v.id_cliente = c.id
            INNER JOIN forma_pagamento fp on
                v.id_forma_pagamento = fp.id
            GROUP BY
                v.id
            ORDER BY
                data_venda desc";
    
        $sql = $this->pdo->prepare($query);
        $sql->execute();
    
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function getBy($id = 0) {
        $query = "
            SELECT 
                v.id as id_venda, 
                c.nome as nome_cliente,
                c.cpf,
                fp.nome,
                fp.parcelas,
                v.produto
            FROM 
                venda v
            INNER JOIN cliente c
                ON v.id_cliente = c.id
            INNER JOIN forma_pagamento fp
                ON fp.id = v.id_forma_pagamento
            WHERE
                v.id = :id";

        $sql = $this->pdo->prepare($query);
        $sql->bindParam(':id', $id, PDO::PARAM_INT);
        $sql->execute();
        $result = $sql->fetch(PDO::FETCH_ASSOC);

        return $result;
    }

    public function create($data) {
       $query = "INSERT INTO venda (id_cliente, id_forma_pagamento, produto ) VALUES (:id_cliente, :id_forma_pagamento, :produto)";
       $sql = $this->pdo->prepare($query);
       $sql->bindParam(':id_cliente', $data['id_cliente']);
       $sql->bindParam(':id_forma_pagamento', $data['id_forma_pagamento']);
       $sql->bindParam(':produto', $data['produto']);
       $sql->execute();
    }

    public function update($data) {
        $query = "UPDATE venda SET id_cliente = :id_cliente, id_forma_pagamento = :id_forma_pagamento, produto = :produto WHERE id = :id";
        $sql = $this->pdo->prepare($query);

        $sql->bindParam(':id', $data['id'], PDO::PARAM_INT);
        $sql->bindParam(':id_cliente', $data['id_cliente']);
        $sql->bindParam(':id_forma_pagamento', $data['id_forma_pagamento']);
        $sql->bindParam(':produto', $data['produto']);
        $result = $sql->execute();
    
        return $result;
    }
    
    public function delete($id) {
        $query = "DELETE FROM venda WHERE id = :id";
        $sql = $this->pdo->prepare($query);
        $sql->bindParam(':id', $id, PDO::PARAM_INT);
        $sql->execute();
    
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
