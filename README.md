<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

### Sail
Para rodar a dockerização use o Laravel Sail.
<p>Instalando a dependência:</br>
<code>composer require laravel/sail --dev</code></p>
<code>php artisan sail:install</code>

<p>Suba os containeres com:</br>
<code>./vendor/bin/sail up -d</code></p>

### Database Migration
<p>Para criar as tabelas e popular a base de celulares:</br>
<code>./vendor/bin/sail php artisan migrate --seed</code>
</p>
<p>Serão criadas 100 registros na tabela cellphones.</p>

### Postman Collection
<p>Na raiz da aplicação está o arquivo "Cellphones.postman_collection.json" para ser usado para testar esta API</p>

### Testes
<p>Os testes rodam em memoria para evitar apagar a base de dados
, para rodar os testes use:</p>
<code>./vendor/bin/sail test</code>
