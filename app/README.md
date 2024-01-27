Api com intuito de teste 

foi produzido em laravel utilizando um docker, como se trata de uma aplicação feke não foi implementado autenticação.

o script docker-cli envia os comandos para o conteriner docker.

conexão MYSQL no arquivo env

    DB_CONNECTION=mysql
    DB_HOST=db
    DB_PORT=3306
    DB_DATABASE=laravel
    DB_USERNAME=root
    DB_PASSWORD=root

necessario rodar as migrates após o clone

em um terminal apartir da raiz do conteiner rode 
    ./docker-cli php artisan migrate

Rode a seed para polupar a tabela de produtos
    ./docker-cli php artisan db:seed --class=ProductsSeeder

Documentação produzida com o postman
    https://documenter.getpostman.com/view/23627948/2s9YyqiMvx