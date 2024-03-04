<?php
namespace App\controllers;
require_once __DIR__ . '/../models/ClientModel.php';

class PaymentController {
    public $paymentModel;
    
    public function __construct() {
        header('Content-Type: application/json');
        $this->paymentModel = new \App\models\PaymentModel();
    }

    public function index() {
        try {
            $result = $this->paymentModel->getAll();
            echo json_encode(['data' => $result]);
        } catch (\Exception $e) {
            echo json_encode(['error' => $e->getMessage()]);
        }
    }

    public function show($id = null) {
        try {
            $result = $this->paymentModel->getBy($id);
            echo json_encode(['data' => $result]);
        } catch (\Exception $e) {
            echo json_encode(['error' => $e->getMessage()]);
        }
    }

    public function insert() {
        try {
            $payload = file_get_contents('php://input');
            $data = json_decode($payload, true);
            
            if (!isset($data['nome'], $data['parcelas'])) {
                throw new \Exception('Dados incompletos. Nome e parcelas são obrigatórios.');
            }

            $result = $this->paymentModel->getBy(null, $data['nome']);

            if(count($result) > 0) {
                throw new \Exception('forma de pagamento já cadastrada!');
            }

            $productDate = [
                'nome' => $data['nome'],
                'parcelas' => $data['parcelas'],
            ]; 

            $result = $this->paymentModel->create($productDate);
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
            
            $result = $this->paymentModel->getBy(null, $data['nome']);
            
            if(count($result) > 0 && $result[0]['id'] !== $data['id']) {               
                throw new \Exception('Nome da forma de pagamento já está em uso!');
            };

            $productDate = [
                'id' => $data['id'],
                'nome' => $data['nome'],
                'parcelas' => $data['parcelas'],
            ]; 

            $result = $this->paymentModel->update($productDate);

        } catch (\Exception $e) {
            echo json_encode(['error' => $e->getMessage()]);
        };
        
    }

    public function delete($id) {
        $result = $this->paymentModel->delete($id);
        return $result;
    }
}

?>
