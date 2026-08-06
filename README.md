# Sistema Web - Bloco de Notas Seguro

## Descrição do Sistema

Sistema web desenvolvido utilizando o framework Laravel para gerenciamento de notas pessoais de usuários autenticados.

A aplicação permite que usuários possam criar, visualizar, editar e excluir suas próprias notas, garantindo privacidade e segurança das informações armazenadas.

O projeto foi desenvolvido para a disciplina de Programação Web I do curso de Tecnologia em Análise e Desenvolvimento de Sistemas do Instituto Federal do Ceará - Campus Boa Viagem.

---

## Funcionalidades

* Cadastro de usuários;
* Login e autenticação;
* Dashboard protegido;
* Criação de notas;
* Listagem das notas do usuário autenticado;
* Visualização individual de notas;
* Edição de notas;
* Exclusão lógica utilizando Soft Delete;
* Criptografia do conteúdo das notas;
* Controle de autoria através do relacionamento entre usuários e notas.

---

## Tecnologias Utilizadas

* PHP 8.x
* Laravel
* Laravel Breeze
* MySQL
* Blade Templates
* Tailwind CSS
* XAMPP
* Git e GitHub

---

# Segurança

## Autenticação

O sistema utiliza o sistema de autenticação padrão do Laravel através do Laravel Breeze.

As páginas da aplicação são protegidas utilizando o middleware `auth`, permitindo acesso somente para usuários autenticados.

As senhas dos usuários são armazenadas utilizando o sistema de hash seguro padrão do Laravel (bcrypt).

---

## Criptografia das Notas

O campo `conteudo` da tabela `notes` é armazenado utilizando criptografia disponibilizada pelo Laravel.

Antes de salvar uma nota no banco de dados, o conteúdo é criptografado utilizando:

```php
Crypt::encryptString()
```

Ao visualizar uma nota, o sistema realiza a descriptografia utilizando:

```php
Crypt::decryptString()
```

Dessa forma, o banco de dados não armazena o texto original das notas, protegendo informações sensíveis.

Exemplo:

Conteúdo original:

```
Minha senha do sistema é teste123
```

Conteúdo armazenado no banco:

```
eyJpdiI6IkcvQTZUeUJWU0RlRkFXK0loSE1OSUE9PS...
```

---

# Banco de Dados

## Tabela users

Armazena os dados dos usuários:

* id
* name
* email
* password
* created_at
* updated_at

## Tabela notes

Armazena os dados das notas:

* id
* user_id
* titulo
* conteudo (criptografado)
* created_at
* updated_at
* deleted_at

Relacionamento:

* Um usuário possui várias notas;
* Uma nota pertence a um usuário.

---

# Soft Delete e Auditoria

O sistema utiliza o recurso Soft Delete do Laravel.

Quando uma nota é excluída, ela não é removida definitivamente do banco de dados. A exclusão é registrada através do campo:

```
deleted_at
```

O sistema mantém registro das operações através dos campos:

* created_at - data de criação;
* updated_at - data de atualização;
* deleted_at - data de exclusão.

---

# Como executar o projeto

## 1. Clonar o repositório

```bash
git clone https://github.com/Ronald-br/unidade-3-blocodenotas.git
```

## 2. Acessar a pasta do projeto

```bash
cd unidade-3-blocodenotas
```

## 3. Instalar dependências

Instalar dependências PHP:

```bash
composer install
```

Instalar dependências do Node:

```bash
npm install
```

---

## 4. Configurar o arquivo .env

Criar uma cópia do arquivo de configuração:

```bash
cp .env.example .env
```

Configurar o banco de dados:

```
DB_DATABASE=bloco_notas
DB_USERNAME=root
DB_PASSWORD=
```

---

## 5. Gerar chave da aplicação

```bash
php artisan key:generate
```

---

## 6. Executar migrations

```bash
php artisan migrate
```

---

## 7. Executar o projeto

Iniciar o servidor Laravel:

```bash
php artisan serve
```

Acessar no navegador:

```
http://127.0.0.1:8000
```

---

# Telas do Sistema

Adicionar prints das principais telas:

* Tela de login;
* Cadastro de usuário;
* Dashboard;
* Lista de notas;
* Cadastro de nota;
* Visualização de nota;
* Banco de dados mostrando o conteúdo criptografado.

---

# Feito por : 

Ronald Vieira

Curso:
Tecnologia em Análise e Desenvolvimento de Sistemas

Instituição:
Instituto Federal do Ceará - Campus Boa Viagem

Disciplina:
Programação Web I

Repositório:
https://github.com/Ronald-br/unidade-3-blocodenotas.git
