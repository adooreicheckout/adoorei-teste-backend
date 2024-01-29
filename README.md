# Requirements
- php: "^8.1"
- composer: "^2.4"
- node: "^20.1"
- npm: "^10.2"
- mysql running local

# Start app

- Instale as depencias composer
```sh
composer install
```
- Instale as depencias node
```sh
npm install
```
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

- Rode os testes
```sh
php artisan test
```
# Documentação
Basta acessar a página inicial do app no browser
- Usado insomnia-documenter
- Para atualizar arquivo base de documentação com base num novo arquivo json
    - exportar do insomnia para /docs/insomnia.json
```sh
npm run build-docs
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

# GET /api/products ......................... Api\Product\ProductController@index
Devolve uma lista de produtos
- Query params
    - opicional
    - parametros de filtros

# GET /sales ......................... Api\SaleController@index
Devolve uma lista de vendas
- Query params
    - opicional
    - parametros de filtros
# POST /api/sales ......................... Api\SaleController@store
Cria um novo produto
- Body Params
```json
{
	"products": [
		{
			"product_id": 2,
			"amount": 2
		}
	]
}
```
# GET /api/sales/{id} ......................... Api\SaleController@show
Devolve uma venda especifica
- Route Params
    - id da venda buscada
# PUT /api/sales/{id}/add/products ......................... Api\SaleController@addProducts
Adiciona produtos e uma venda (caso já exista, apenas atualiza a quantidade)
- Route Params
    - id da venda buscada
- Body Params
```json
{
	"products": [
		{
			"product_id": 2,
			"amount": 1
		},
        {
            "product_id": 1,
            "amount": 2
        }
	]
}
```
# PUT /api/sales/{id}/cancel ......................... Api\SaleController@cancel
Cancela uma venda
- Route Params
    - id da venda buscada
# DELETE /api/sales/{id} ......................... Api\SaleController@destroy
Deleta uma venda
- Route Params
    - id da venda buscada
