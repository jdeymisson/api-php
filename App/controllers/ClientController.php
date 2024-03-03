<?php
namespace App\controllers;
require_once __DIR__ . '/../models/ClientModel.php';

class ClientController {
    public $clientModel;
    
    public function __construct() {
        header('Content-Type: application/json');
        $this->clienteModel = new \App\models\ClientModel();
    }

    public function index() {
        try {
            $resultado = $this->clienteModel->getAll();
            echo json_encode(['data' => $resultado]);
        } catch (\Exception $e) {
            echo json_encode(['error' => $e->getMessage()]);
        }
    }

    public function show($id = null) {
            try {
                $resultado = $this->clienteModel->getBy($id);
                echo json_encode(['data' => $resultado]);
            } catch (\Exception $e) {
                echo json_encode(['error' => $e->getMessage()]);
            }
    }

    public function insert() {
        try {
            $payload = file_get_contents('php://input');
            $data = json_decode($payload, true);
            
            if (!isset($data['nome'], $data['cpf'])) {
                throw new \Exception('Dados incompletos. Nome e CPF são obrigatórios.');
            }

            $result = $this->clienteModel->getBy(null, $data['cpf']);

            if(count($result) > 0) {
               throw new \Exception('Cliente já cadastrado!');
            };

            $result = $this->clienteModel->getBy(null, null, $data['email']);

            if(count($result) > 0 && $result[0]['cpf'] !== $data['nome']) {
                throw new \Exception('E-mail já cadastrado!');
            };

            $clientDate = [
                'nome' => $data['nome'],
                'cpf' => $data['cpf'],
                'endereco' => $data['cpf'],
                'email' => $data['email'],
            ]; 

            $result = $this->clienteModel->create($clientDate);
            http_response_code(201);

        } catch (\Exception $e) {
            echo json_encode(['error' => $e->getMessage()]);
        }
    }

    public function edit() {
        try {
            $payload = file_get_contents('php://input');
            $data = json_decode($payload, true);
    
            $result = $this->clienteModel->getBy(null, $data['cpf']);
            
            if(count($result) > 0 && $result[0]['id'] !== $data['id']) {               
                throw new \Exception('CPF já estar em uso!');
            };

            $result = $this->clienteModel->getBy(null, null, $data['email']);

            if(count($result) > 0 && $result[0]['cpf'] !== $data['cpf']) {
                throw new \Exception('E-mail já cadastrado!');
            };

            $clientDate = [
                'id' => $data['id'],
                'nome' => $data['nome'],
                'cpf' => $data['cpf'],
                'endereco' => $data['cpf'],
                'email' => $data['email'],
            ]; 

            $result = $this->clienteModel->update($clientDate);

        } catch (\Exception $e) {
            echo json_encode(['error' => $e->getMessage()]);
        };
        
    }

    public function delete($id) {
        $resultado = $this->clienteModel->delete($id);
    }
}

?>
