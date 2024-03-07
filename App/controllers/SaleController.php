<?php
namespace App\controllers;
require_once __DIR__ . '/../models/ClientModel.php';

class SaleController {
    public $saleModel;
    
    public function __construct() {
        header('Content-Type: application/json');
        $this->saleModel = new \App\models\SaleModel();
    }

    public function index() {
        try {
            $result = $this->saleModel->getAll();
            echo json_encode(['data' => $result]);
        } catch (\Exception $e) {
            echo json_encode(['error' => $e->getMessage()]);
        }
    }

    public function show($id = null) {
        try {
            if($id <= 0 || null) {
                throw new \Exception('Necessário que informe um id válido');
            }
            $result = $this->saleModel->getBy($id);
            echo json_encode(['data' => $result]);
        } catch (\Exception $e) {
            echo json_encode(['error' => $e->getMessage()]);
        }
    }

    public function insert() {
        try {
            $payload = file_get_contents('php://input');
            $data = json_decode($payload, true);

            if (!isset($data['id_cliente']) || !isset($data['id_forma_pagamento']) || !isset($data['produto'])) {
                error_log('Dados recebidos: ' . json_encode($data));
                throw new \Exception('Verifique as propriedades enviadas!');
            }

            $saleData = [
                'id_cliente' => $data['id_cliente'],
                'id_forma_pagamento' => $data['id_forma_pagamento'],
                'produto' => $data['produto'],
            ]; 

            $result = $this->saleModel->create($saleData);
            http_response_code(201);

        } catch (\Exception $e) {
            echo json_encode(['error' => $e->getMessage()]);
        }
    }
    

    public function edit() {
        try {
            $payload = file_get_contents('php://input');
            $data = json_decode($payload, true);

            if (!isset($data['id'])) {
                throw new \Exception('É necessário informar o ID para atualização das informações!');
            }

            $saleData = [
                'id' => $data['id'],
                'id_cliente' => $data['id_cliente'],
                'id_forma_pagamento' => $data['id_forma_pagamento'],
                'produto' => json_encode($data['produto']),
            ]; 

            $result = $this->saleModel->update($saleData);

        } catch (\Exception $e) {
            echo json_encode(['error' => $e->getMessage()]);
        };
        
    }

    public function delete($id) {
        $result = $this->saleModel->delete($id);
        return $result;
    }
}

?>
