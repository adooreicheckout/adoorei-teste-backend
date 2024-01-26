# Config envs
- Duplique arquivo .env.example
```sh
cp .env.example .env
```
- Crie uma database com nome adoorei

```sh
mysql -uroot -proot
```

```sh
create database adoorei character set utf8 collate utf8_unicode_ci;
```

- Rode as migrations
```sh
php artisan migrate
```

- Rode os seeds para inicialização dos dados
```sh
php artisan db:seed
```

# Rotas
## Filtros para listagem
- Filtros disponiveis
    - Exemplo:
        - /products?name[eq]=nome&value[gt]=5000
```php
'gt' => '>'
'gte' => '>='
'lt' => '<'
'lte' => '<='
'eq' => '='
'ne' => '!='
'in' => 'in'
'lk' => 'like'
```

# GET /products
Devolve uma lista de produtos
- Query params
    - opicional
    - parametros de filtros
