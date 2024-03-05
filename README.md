# <img src="https://www.adoorei.com.br/img/logo.dfb5eb16.svg"> Desafio Adoorei

## ✨ Passos para instalação do projeto

### Obs: Todos os comandos devem ser executados dentro da pasta src/

1. Crie o arquivo `.env` baseado em `.env.example`


2. Execute o script deploy.sh dentro da pasta src/

```bash
./deploy.sh
```

Após iniciar os serviços, acesse o projeto em: [http://localhost/api/products](http://localhost/api/products)


## Documentação da API

A documentação da API está disponível em: [Postman](https://documenter.getpostman.com/view/5481454/2sA2xb8GpY)



## Para execução dos testes

```bash
./vendor/bin/sail php artisan test
