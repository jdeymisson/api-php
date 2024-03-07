# API PHP

Essa API é uma aplicação simples projetada para realizar operações CRUD (Create, Read, Update, Delete) em dados relacionados a vendas.

## Requisitos de Ambiente
- XAMPP (https://www.apachefriends.org/index.html)
  - Apache (servidor web)
  - MySQL (sistema de gerenciamento de banco de dados)
  - PHP (linguagem de script)


## Configuração

1. Instale o XAMPP seguindo as instruções fornecidas no site oficial.

2. Inicie o Apache e MySQL no painel de controle do XAMPP.

3. Clone o repositório da API-PHP.

4. Crie o banco de dados.

5. Configure as informações de conexão com o banco de dados no arquivo de configuração (/config/config.php).

6. Copie o conteúdo do arquivo schemabd.sql e execute ele em algum  SGBD, exemplo DBeaver, mysqladmin.

## Rodando localmente

Clone o projeto dentro do repositório do XAMP, pasta htdocs
```
bash
 $ cd C:/xampp/htdocs
```

```
bash
  https://github.com/jdeymisson/api-php.git

```
🔥 Atenção: antes de qualquer request para api, confirma se foi feito todos os passos do tópico de configuração.

## Endpoint's

#### Client Endpoints

1. Listar todos os clientes.
Método: GET
```
 http://localhost/api/client
```
2. Lista um cliente
Método: GET
Parâmetros: {id} - ID do cliente
```
http://localhost/api/client/1
```
3. Inserir novo cliente
Método: POST

Envio: BODY
``` 
{
    "nome": "Joãzinho",
    "cpf": "00022233344",
    "endereco": "Rua colômbia",
    "email": "joaozinho@email.com"
}
```

4. Editar cliente
Método: PUT

Envio: BODY
``` 
{
    "id": 1,
    "nome": "Joãzinho",
    "cpf": "00022233344",
    "endereco": "Rua colômbia",
    "email": "joaozinho@email.com"
}
```

5. Excluir cliente
Método: DELETE

Parâmetros: {id} - ID do cliente
```
http://localhost/api/client/1
```

#### Product Endpoints

1. Listar todos os produtos.
Método: GET
```
 http://localhost/api/product
```
2. Lista um produto.
Método: GET
Parâmetros: {id} - ID do produto
```
http://localhost/api/product/1
```
3. Inserir novo produto
Método: POST
```
http://localhost/api/product
```
Envio: BODY
``` 
{    
    "nome": "RAPADURA",
    "quantidade": 0,
    "preco": "8.00"
}
```

4. Editar cliente
Método: PUT

Envio: BODY
``` 
{    
    "id": 1,
    "nome": "COCA-COLA",
    "quantidade": 10,
    "preco": "8.00"
}
```

5. Excluir produto
Método: DELETE

Parâmetros: {id} - ID do produto
```
http://localhost/api/product/1
```

#### Payment Endpoints

1. Listar todas as formas de pagamentos.
Método: GET
```
 http://localhost/api/payment
```
2. Lista uma forma de pagamento.
Método: GET
Parâmetros: {id} - ID da forma de pagamento
```
 http://localhost/api/payment/1
```
3. Inserir uma nova forma de pagamento
Método: POST
```
http://localhost/api/payment
```
Envio: BODY
``` 
{
    "nome": "VISA",
    "parcelas": 7
}
```

4. Editar uma forma de pagamento
Método: PUT

Envio: BODY
``` 
{
    "id": 1,
    "nome": "VISA",
    "parcelas": 7
}
```

5. Excluir forma de pagamento
Método: DELETE

Parâmetros: {id} - ID da forma de pagamento
```
http://localhost/api/payment/1
```

#### Sale Endpoints

1. Listar todas as vendas.
Método: GET
```
 http://localhost/api/sale
```
2. Lista uma venda.
Método: GET
Parâmetros: {id} - ID da venda
```
 http://localhost/api/sale/1
```
3. Inserir uma nova venda
Método: POST
```
 http://localhost/api/sale
```
Envio: BODY
``` 
{
   "id_cliente": 1,
   "id_forma_pagamento": 1,
   "produto": "[{\"id\":11,\"nome\":\"SUCO DE LARANJA\",\"preco\":11.24,            \"quantidade\":1}]"
}
```

4. Editar uma venda
Método: PUT
```
 http://localhost/api/sale/1
```
Envio: BODY
``` 
{
    "id": 100,  
   "id_cliente": 1,
   "id_forma_pagamento": 1,
   "produto": "[{\"id\":11,\"nome\":\"SUCO DE LARANJA\",\"preco\":11.24,\"quantidade\":1}]"
}
```

5. Excluir forma de pagamento
Método: DELETE

Parâmetros: {id} - ID da forma de pagamento
```
 http://localhost/api/sale/1
```
