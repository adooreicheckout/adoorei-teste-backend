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
