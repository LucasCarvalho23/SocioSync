# SocioSync API

## Descrição
Este projeto é uma API para gerenciamento de empresas e sócios, desenvolvida em Symfony e utilizando PostgreSQL como banco de dados.

## Tecnologias Utilizadas
- **PHP 8**
- **Symfony**
- **PostgreSQL**
- **Bootstrap 5**
- **GitLab** para versionamento

## Como Executar o Projeto

### 1. Clonar o Repositório
git clone git@gitlab.com:SEU_USUARIO/socio-sync.git
cd socio-sync

### 2. Instalar Dependências
composer install

### 3. Configurar o Banco de Dados
Crie um banco no PostgreSQL e atualize o arquivo .env com suas credenciais:
DATABASE_URL="postgresql://usuario:senha@127.0.0.1:5432/seu_banco?serverVersion=15&charset=utf8"

Rodar as migrations:
php bin/console doctrine:migrations:migrate

### 4. Rodar o Servidor
symfony server:start
O programa estará disponível em:
📌 http://127.0.0.1:8000

### 5. Api:
/api/empresas e /api/socios/
