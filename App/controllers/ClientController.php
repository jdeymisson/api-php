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
            $result = $this->clienteModel->getAll();
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
                $result = $this->clienteModel->getBy($id);
                echo json_encode(['data' => $result]);
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
                throw new \Exception('E-mail já está em uso!');
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

            if (!isset($data['id'])) {
                throw new \Exception('É necessário informar o ID para atualização das informações!');
            }
    
            $result = $this->clienteModel->getBy(null, $data['cpf']);
            
            if(count($result) > 0 && $result[0]['id'] !== $data['id']) {               
                throw new \Exception('CPF já está em uso!');
            };

            $result = $this->clienteModel->getBy(null, null, $data['email']);

            if(count($result) > 0 && $result[0]['id'] !== $data['id']) {
                throw new \Exception('E-mail já está em uso!');
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
        $result = $this->clienteModel->delete($id);
        return $result;
    }
}

?>
