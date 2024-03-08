## ABC-STORE-BACKEND

```
Back-end da Loja ABC que disponibiliza APIs Rest. A estrutura do projeto usa containers gerenciados pelo Docker. Solução desenvolvida em Laravel 10 e Mysql, com a documentação via Postaman e Swagger.
```

## Documentação

- Caminho dos arquivos de Requests do Postman

```
/ABC-STORE-BACKEND/documentation/requests/
```

- Endereço da Documentação interativa via Swagger

```
http://localhost:8088/api/documentation/
```

## Configuração

- Clone o projeto

```
git clone git@github.com:juniorns/abc-store-backend.git
```

- Na raiz do Projeto execute o comando para criar os containers

```
docker-compose up
```

- Conecte no container do php e instale as dependências do Laravel

```
composer install
```

- Crie o arquivo .env

```
cp .env.example .env
```

- Gere a nova chave para o Laravel

```
php artisan key:generate
```

- Url da instalação Laravel

```
http://localhost:8090
```

- Crie os objetos no banco de dados

```
php artisan migrate:fresh
```

- Popule as tabelas do banco de dados

```
php artisan db:seed
```

- Url base da API

```
http://localhost:8090/api
```

- Para acessar o MySql via PhpMyAdmin

```
Url: http://localhost:8183/
Server: mysql
Usuário: root
Senha: root
Database: abc_store
```
