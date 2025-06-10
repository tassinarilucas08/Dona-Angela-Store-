# Dona-Angela-Store-
Loja da dona Angela


# Dona Ângela Store - Documentação da API

Este documento descreve o funcionamento da API desenvolvida para o projeto Dona Ângela Store. A API é implementada em PHP e organizada em rotas RESTful.


---

## Autenticação

Não há um mecanismo de autenticação implementado nesta API no momento. Todas as rotas são acessíveis publicamente via requisição HTTP.

---

## Rotas Disponíveis

### 1. **Usuários**

#### `GET /api/users`

Retorna todos os usuários cadastrados.

**Resposta:**

```json
[
  {
    "id": 1,
    "name": "Joana Silva",
    "email": "joana@email.com"
  }
]
```

**Códigos HTTP:**

- 200 OK

#### `POST /api/users`

Cria um novo usuário.

**Parâmetros JSON:**

```json
{
  "name": "Joana Silva",
  "email": "joana@email.com",
  "password": "123456"
}
```

**Resposta:**

```json
{
  "success": true,
  "message": "Usuário criado com sucesso."
}
```

**Códigos HTTP:**

- 201 Created
- 400 Bad Request

### 2. **Endereços**

#### `GET /api/addresses/{user_id}`

Lista os endereços vinculados a um usuário.

**Resposta:**

```json
[
  {
    "id": 1,
    "rua": "Rua das Flores",
    "numero": "123",
    "bairro": "Centro",
    "cidade": "Porto Alegre",
    "estado": "RS"
  }
]
```

**Códigos HTTP:**

- 200 OK

#### `POST /api/addresses`

Adiciona um novo endereço a um usuário.

**Parâmetros JSON:**

```json
{
  "user_id": 1,
  "rua": "Rua das Flores",
  "numero": "123",
  "bairro": "Centro",
  "cidade": "Porto Alegre",
  "estado": "RS",
  "cep": "99999-000"
}
```

**Resposta:**

```json
{
  "success": true,
  "message": "Endereço cadastrado."
}
```

**Códigos HTTP:**

- 201 Created
- 400 Bad Request

### 3. **Gêneros de Produtos**

#### `GET /api/genders`

Lista todos os gêneros de produtos (masculino, feminino, unissex, etc).

**Resposta:**

```json
[
  {
    "id": 1,
    "genero": "Feminino"
  },
  {
    "id": 2,
    "genero": "Masculino"
  }
]
```

**Códigos HTTP:**

- 200 OK

### 4. **Dúvidas (Perguntas)**

#### `GET /api/questions`

Lista as perguntas recebidas.

**Resposta:**

```json
[
  {
    "id": 1,
    "nome": "Maria",
    "email": "maria@email.com",
    "mensagem": "Vocês vendem por atacado?"
  }
]
```

**Códigos HTTP:**

- 200 OK

#### `POST /api/questions`

Recebe uma nova pergunta de um cliente.

**Parâmetros JSON:**

```json
{
  "nome": "Maria",
  "email": "maria@email.com",
  "mensagem": "Vocês vendem por atacado?"
}
```

**Resposta:**

```json
{
  "success": true,
  "message": "Mensagem recebida com sucesso."
}
```

**Códigos HTTP:**

- 201 Created
- 400 Bad Request

---

## Observações

- Todas as requisições POST devem ter o `Content-Type: application/json`.
- As respostas seguem o padrão JSON.