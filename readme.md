Comandos para rodar aplicação

Dentro da pasta raíz do projeto

(Se quiser ter um backup do banco, criar uma pasta "mysql" dentro da raíz do projeto)
* docker-compose up -d --build
* docker-compose run --rm composer update
* docker-compose run --rm artisan migrate
* docker-compose run --rm artisan db:seed
* docker-compose run --rm php ./vendor/bin/phpunit
* http://localhost/

* documentação API https://documenter.getpostman.com/view/3863148/2sA2xb7vjA
