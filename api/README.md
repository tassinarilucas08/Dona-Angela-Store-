# Dona-Angela-Store-
Loja da dona Angela


# Dona Ângela Store - Documentação da API

Este documento descreve o funcionamento da API desenvolvida para o projeto Dona Ângela Store. A API é implementada em PHP e organizada em rotas RESTful.


---

## Autenticação

Não há um mecanismo de autenticação implementado nesta API no momento. Todas as rotas são acessíveis publicamente via requisição HTTP.

---

## Rotas Disponíveis

---

### 1. **Usuários**

#### `GET /api/Users/`

Retorna todos os usuários cadastrados.

**Resposta:**
```json
{
  "success": true,
  "message": "Lista de usuários",
  "count": 10,
  "users": [...]
}
```

**Códigos HTTP:**

- 200 OK  
- 404 Not Found  
```json
{
  "success": false,
  "message": "Nenhum usuário encontrado"
}
```

#### `GET /api/Users/id/{id}`

Busca usuário por ID.

**Resposta:**
```json
{
  "success": true,
  "message": "Encontrado com sucesso",
  "name": "Fulano",
  "email": "fulano@email.com"
}
```

**Códigos HTTP:**

- 200 OK  
- 400 Bad Request  
```json
{
  "success": false,
  "message": "ID inválido"
}
```
- 400 Bad Request  
```json
{
  "success": false,
  "message": "Usuário não encontrado"
}
```

#### `POST /api/Users/add`

Cria um novo usuário.

**Resposta:**
```json
{
  "success": true,
  "message": "Usuário criado com sucesso",
  "id": 1,
  "name": "Fulano",
  "email": "fulano@email.com"
}
```

**Códigos HTTP:**

- 201 Created  
- 400 Bad Request  
```json
{
  "success": false,
  "message": "O campo 'email' é obrigatório"
}
```
- 400 Bad Request  
```json
{
  "success": false,
  "message": "E-mail inválido"
}
```
- 409 Conflict  
```json
{
  "success": false,
  "message": "E-mail já cadastrado"
}
```
- 409 Conflict  
```json
{
  "success": false,
  "message": "Telefone já cadastrado"
}
```
- 400 Bad Request  
```json
{
  "success": false,
  "message": "A senha deve ter no mínimo 6 caracteres"
}
```
- 500 Internal Server Error  
```json
{
  "success": false,
  "message": "Erro ao criar usuário"
}
```

---

### 2. **Gêneros**

#### `GET /api/Genders/`

Retorna todos os gêneros de produtos.

**Resposta:**
```json
{
  "success": true,
  "message": "Lista de gêneros encontrada com sucesso",
  "count": 5,
  "users": [...]
}
```

**Códigos HTTP:**

- 200 OK  
- 404 Not Found  
```json
{
  "success": false,
  "message": "Nenhum gênero encontrado"
}
```

---

### 3. **Perguntas Frequentes**

#### `GET /api/Questions/`

Retorna todas as perguntas.

**Resposta:**
```json
{
  "success": true,
  "message": "Lista de perguntas e respostas",
  "questions": [...]
}
```

#### `POST /api/Questions/add`

Adiciona uma nova pergunta.

**Resposta:**
```json
{
  "success": true,
  "message": "Pergunta criada com sucesso",
  "Pergunta": "Qual o horário de funcionamento?",
  "Resposta": "De segunda a sexta das 9h às 18h"
}
```

**Códigos HTTP:**

- 201 Created  
- 400 Bad Request  
```json
{
  "success": false,
  "message": "Dados inválidos"
}
```
- 500 Internal Server Error  
```json
{
  "success": false,
  "message": "Erro ao salvar pergunta"
}
```

---

### 4. **Endereços**

#### `GET /api/Addresses/`

Retorna todos os endereços cadastrados.

**Resposta:**
```json
{
  "success": true,
  "message": "Lista de endereços encontrada com sucesso",
  "count": 3,
  "endereços": [...]
}
```

**Códigos HTTP:**

- 200 OK  
- 404 Not Found  
```json
{
  "success": false,
  "message": "Nenhum endereço encontrado"
}
```

#### `POST /api/Addresses/add`

Cadastra um novo endereço.

**Resposta:**
```json
{
  "success": true,
  "message": "Endereço criado com sucesso",
  "id": 1,
  "zipCode": "12345-678",
  "street": "Rua Exemplo",
  "number": "123",
  "complement": "Apto 4",
  "state": "SP",
  "city": "São Paulo"
}
```

**Códigos HTTP:**

- 201 Created  
- 400 Bad Request  
```json
{
  "success": false,
  "message": "O campo 'zipCode' é obrigatório"
}
```
- 400 Bad Request  
```json
{
  "success": false,
  "message": "CEP inválido. Use o formato XXXXX-XXX"
}
```
- 500 Internal Server Error  
```json
{
  "success": false,
  "message": "Erro ao cadastrar endereço"
}
```

---

## Observações

- Todas as requisições POST devem ter o `Content-Type: application/json`.
- As respostas seguem o padrão JSON.