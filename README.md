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

- gere a chave para  laravel
```sh
php artisan key:generate
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

- rode a aplicação
```sh
php artisan serve
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

# GET /api/products 
Devolve uma lista de produtos
- Api\Product\ProductController@index
- Query params
    - opicional
    - parametros de filtros

# GET /sales 
Devolve uma lista de vendas
- Api\SaleController@index
- Query params
    - opicional
    - parametros de filtros
# POST /api/sales 
Cria um novo produto
- Api\SaleController@store
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
# GET /api/sales/{id} 
Devolve uma venda especifica
- Api\SaleController@show
- Route Params
    - id da venda buscada
# PUT /api/sales/{id}/add/products 
Adiciona produtos e uma venda (caso já exista, apenas atualiza a quantidade)
- Api\SaleController@addProducts
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
# PUT /api/sales/{id}/cancel 
Cancela uma venda
- Api\SaleController@cancel
- Route Params
    - id da venda buscada
# DELETE /api/sales/{id} 
Deleta uma venda
- Api\SaleController@destroy
- Route Params
    - id da venda buscada

# Arquivos de documentação encontados em /docs
