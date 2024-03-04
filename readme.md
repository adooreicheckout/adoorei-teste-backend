# Adoorei Teste - Eduardo Fertig Bastos

## Instalação
Para rodar o teste, basta ter o docker instalado e rodar os seguintes comandos

Para construir os containeres da aplicação
```
    docker-compose up --build
```

Com o docker já rodando, rodar os seguintes comandos no terminal 

Para executar as migrations
```
    docker exec -it adoorei-backend-eduardo php artisan migrate
```

Para criar os produtos através de seeders. 
```
    docker exec -it adoorei-backend-eduardo php artisan db:seed
```

## .ENV
Para criação do arquivo .env, basta que copiar e colar o arquivo .env.example e renomea-lo.

Apenas 2 adendos.

Não use a variável `DB_HOST` como 'localhost', pois pode ocorrer conflito no docker. <br>

Não use a variável `DB_USERNAME` como 'root', se desejar 'root' não informe a variável.
Ao informar DB_USERNAME como root, o MySQL tenta criar um usuário 'root' pela segunda vez.
Como destacado na seguinte issue do github.
https://github.com/docker-library/mysql/issues/129 

## UNIT TESTS

Para executar os testes unitários, basta rodar o seguinte comando. 
```
    docker exec -it adoorei-backend-eduardo php artisan test
```

## DOCS

A documentação criada via POSTMAN se encontra no seguinte diretório
`docs/postman/Adoorei_test.postman_collection.json`


