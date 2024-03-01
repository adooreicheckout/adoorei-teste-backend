
<p align="center">
<a href="hhttps://www.adoorei.com.br/" target="_blank">
<img src="https://adoorei.s3.us-east-2.amazonaws.com/images/loje_teste_logoadoorei_1662476663.png" width="160"></a>
</p>
<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://media.licdn.com/dms/image/D4D0BAQF4UjxjXJj6Qg/company-logo_200_200/0/1703105703892/hubii_co_logo?e=2147483647&v=beta&t=bV-icn8A01x2tTyb6vmy2nD1I4slyiAO8kokZbP4eS0" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Sobre o microserviço

Este microserviço tem o objetivo de demonstrar minha habilidades na linguagem definida, os testes unitários inclusos tem fins apenas de demonstração das habilidade, não refletindo as reais necessidades, possibilidades de testes e tipos de validações:

## Sobre o framework usado (Laravel)

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).


## Iniciando o microserviço

clonar o repositório

- [ms-adoorei](https://github.com/lnascimento01/adoorei-teste-backend)

O microserviço é executado via docker.

- **[Via docker](https://www.docker.com)**

# Via docker

Executar o comando a partir da pasta principal do projeto usando do terminal de preferência

```
docker-compose -f .\docker-compose.yml up -d --build
```

Executar o seguinte comando para criar as tabelas e alimentar as mesmas

```
docker exec -it ms-adoorei php artisan migrate --seed 
```

## Testes unitários

Executar o seguinte comando para a base de teste e as tabelas

```
docker exec -it ms-adoorei php artisan migrate --env=testing  
```

# Documentação

[Postman](https://www.postman.com/first-avengers/workspace/adoorei)

# License

The project is software licensed under the [OGTSL license](https://opensource.org/license/opengroup-php/).
