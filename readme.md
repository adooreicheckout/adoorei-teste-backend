
<p align="center">
<a href="hhttps://www.adoorei.com.br/" target="_blank">
<img src="https://adoorei.s3.us-east-2.amazonaws.com/images/loje_teste_logoadoorei_1662476663.png" width="160"></a>
</p>

# Desafio desenvolvedor back-end

Seja muito bem-vindo(a), futuro desenvolvedor da Adoorei.

Nós, recrutadores juntamente com a nossa equipe de ENGENHARIA, desenvolvemos um teste prático para conhecer um pouco mais sobre suas habilidade 



## Objetivo
Utilizando o  <a href=“https://laravel.com/docs/10.x“>Laravel</a> cria uma API rest, que resolva o seguinte cenário:


A Loja ABC LTDA, vende produtos de diferentes nichos. No momento precisamos registrar a venda de celulares.

Não vamos nos preocupar com o cadastro de produtos, porém precisamos ter uma tabela em nosso banco contendo os aparelhos celulares que vão ser vendidos, por exemplo:

```json
[
    {
        "name": "Celular 1",
        "price": 1.800,
        "description": "Lorenzo Ipsulum"
    },
    {
        "name": "Celular 2",
        "price": 3.200,
        "description": "Lorem ipsum dolor"
    },
    {
        "name": "Celular 3",
        "price": 9.800,
        "description": "Lorem ipsum dolor sit amet"
    }
]
```

Uma vez que temos os produtos em nosso banco, vamos seguir com o registro de venda desses aparelhos.

Não vamos nós preucupar com informações do comprador, dados de pagamento, entrega, possibilidade de descontos.

Temos que registrar somente a venda. 

Então nossa consulta vai retornar algo como:
```json
{
  "sales_id": "202301011",
  "amount": 8200,
  "products": [
    {
      "product_id": 1,
      "nome": "Celular 1",
      "price": 1.800,
      "amount": 1
    },
    {
      "product_id": 2,
      "nome": "Celular 2",
      "price": 3.200,
      "amount": 2
    },
  ]
}
```

Nossa API vai ter endpoints que possibilitam

* Listar produtos disponíveis
* Cadastrar nova venda
* Consultar vendas realizadas
* Consultar uma venda específica
* Cancelar uma venda
* Cadastrar novas produtos a uma venda




## Nossa análise

Todo o seu desenvolvimento será levado em consideração. Busque alcançar o seu melhor, utilizando os recursos com os quais você se sente mais confortável.

### É essencial no seu código:
* Utilizar comandos de Migrate/Seed para a criação e atualização do seu banco de dados.
* Este projeto é destinado a uma API Rest; portanto, respeite o formato de comunicação de entrada e saída de dados.
* Faça commits regulares no seu código.

### Pontos que irão destacar você neste desafio:
* Utilizar Docker para a execução do seu projeto.
* Implementar testes unitários.
* Criar documentação para seus endpoints (utilizando ferramentas como Postman ou Insomnia).
* Aplicar conceitos de Clean Architecture, S.O.L.I.D., Test-Driven Development (TDD), Domain-driven design (DDD), Command Query Responsibility Segregation (CQRS), Objects Calisthenics, You Ain’t Gonna Need It (YAGNI), Conventional Commits, e KISS.

## Nossa análise

Todo o seu desenvolvimento será levado em consideração. Busque alcançar o seu melhor, utilizando os recursos com os quais você se sente mais confortável.

### É essencial no seu código:
* Utilizar comandos de Migrate/Seed para a criação e atualização do seu banco de dados.
* Este projeto é destinado a uma API Rest; portanto, respeite o formato de comunicação de entrada e saída de dados.
* Faça commits regulares no seu código.

### Pontos que irão destacar você neste desafio:
* Utilizar Docker para a execução do seu projeto.
* Implementar testes unitários.
* Criar documentação para seus endpoints (utilizando ferramentas como Postman ou Insomnia).
* Aplicar conceitos de Clean Architecture, S.O.L.I.D., Test-Driven Development (TDD), Domain-driven design (DDD), Command Query Responsibility Segregation (CQRS), Objects Calisthenics, You Ain’t Gonna Need It (YAGNI), Conventional Commits, e KISS.


## Boa sorte!

É isso!. Ficamos muito felizes com a sua aplicação para esse Teste. Estamos à sua disposição para tirar qualquer dúvida. Boa sorte! 😉
