# Sales API

## Stack

- Laravel 10+
- PHP 8.1
- docker & docker-compose
-  Prometheus
- Granfana

### O que foi implementado:
-   Listar produtos disponíveis
-   Cadastrar nova venda
-   Consultar vendas realizadas


### Como rodar o proejeto


Subir os serviços

    docker-compose up -d
Rodar as migrations


    docker-compose exec app php artisan migrate

Executar as seeds

    docker-compose exec app php artisan db:seed

Executar os testes

    docker-compose exec app php artisan test

Comandos adicionais:

Na raiz do projeto existe um makefiel com algumas ferramentas úteis: phpcbf, phpstan, phpcs  
exemplo: `make test`

### Métricas
As métricas estão sendo expostas na rota `localhost:8080/metrics` , o prometheus vai subir coletando as métricas.
Não consegui colocar o grafrana para subir com um dashboard, mas caso desejem testar  sigam os passos:

Configurar um novo datasource  com o prometheus  na rota

    http://localhost:3000/connections/datasources/new
    - prometheus server url: http://prometheus:9090
    - HTTP method: get

Importar um novo dashbord

    http://localhost:3000/dashboard/import
    - Utilizar o arquivo json na pasta do projeto `.docker-configs/grafana/dashboards/dashboard.json`

### Collections

    Na raiz do projeto tem uma pasta /collection que contém as collections para teste no insominia 
