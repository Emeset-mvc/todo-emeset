# Todo-Emeset

## Gestor de tasques desenvolupat utilitzant el Framework Emeset

Exemple de com utilitzar el framework Emeset per desenvolupar una aplicació senzilla.

## Instruccions d'ús

Per inicialitzar l'aplicació primer cal crear la base de dades.

```sh
$ composer install
$ npm install
$ php cli/init.php
```
o
```sh
$ composer install
$ npm install
$ php cli/initPDO.php
```


Primer hem d'instal·lar les dependències del projecte amb composer.

Després instal·lem les eines per gestionar els estils i JavaScript amb Vite.

Finalment, l'script `cli/init.php` inicialitza la base de dades SQLite amb les dades de l'aplicació.

# Com executar l'aplicació

Per iniciar l'aplicació amb Vite en mode desenvolupament i el servidor PHP:

```sh
$ npm install
$ npm run start
```

També podem iniciar directament el servidor PHP integrat:

```sh
$ php -S localhost:8080 -t public public/router.php
```

Per generar els assets optimitzats de producció:

```sh
$ npm run build
```

