<?php
namespace App\controllers;
require_once __DIR__ . '/../models/ClientModel.php';

class ProductController {
    public $productModel;
    
    public function __construct() {
        header('Content-Type: application/json');
        $this->productModel = new \App\models\ProductModel();
    }

    public function index() {
        try {
            $result = $this->productModel->getAll();
            echo json_encode(['data' => $result]);
        } catch (\Exception $e) {
            echo json_encode(['error' => $e->getMessage()]);
        }
    }

    public function show($id = null) {
        try {
            $result = $this->productModel->getBy($id);
            echo json_encode(['data' => $result]);
        } catch (\Exception $e) {
            echo json_encode(['error' => $e->getMessage()]);
        }
    }

    public function insert() {
        try {
            $payload = file_get_contents('php://input');
            $data = json_decode($payload, true);
            
            if (!isset($data['nome'], $data['quantidade'], $data['preco'])) {
                throw new \Exception('Dados incompletos. nome e quantidade e preço são obrigatórios.');
            }

            $result = $this->productModel->getBy(null, $data['nome']);

            if(count($result) > 0) {
                throw new \Exception('Nome do produto já está em uso!');
            }

            $productDate = [
                'nome' => $data['nome'],
                'quantidade' => $data['quantidade'],
                'preco' => $data['preco'],
            ]; 

            $result = $this->productModel->create($productDate);
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
            
            $result = $this->productModel->getBy(null, $data['nome']);
            
            if(count($result) > 0 && $result[0]['id'] !== $data['id']) {               
                throw new \Exception('Nome do produto já está em uso!');
            };

            $productDate = [
                'id' => $data['id'],
                'nome' => $data['nome'],
                'quantidade' => $data['quantidade'],
                'preco' => $data['preco'],
            ]; 

            $result = $this->productModel->update($productDate);

        } catch (\Exception $e) {
            echo json_encode(['error' => $e->getMessage()]);
        };
        
    }

    public function delete($id) {
        $result = $this->productModel->delete($id);
        return $result;
    }
}

?>
