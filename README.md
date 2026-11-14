# Todo-Emeset

Exemple de gestor de tasques amb el framework Emeset. Permet iniciar sessió, afegir tasques, marcar-les com a fetes i restaurar-les.

## Requisits

- PHP 8.4 o superior i Composer.
- Les extensions PHP `sqlite3` per a SQLite o `pdo_mysql` per a MySQL.
- Node.js 20.19 o superior dins de la branca 20, o 22.12 o superior, i npm.
- Un servidor MySQL si es fa servir aquesta base de dades.

## Instal·lació i configuració

Des de l'arrel del projecte, instal·la les dependències:

```sh
composer install
npm install
```

Configura la base de dades al fitxer `.env` de l'arrel. Si no existeix, es fan servir els valors per defecte d'`App/config.php`.

### SQLite

Per defecte, l'aplicació fa servir SQLite i desa `db.sqlite` a l'arrel del projecte. Per personalitzar la ubicació, afegeix, per exemple:

```dotenv
db_type=sqlite
sqlite_path=.
sqlite_name=db.sqlite
```

Inicialitza les taules i els usuaris de demostració:

```sh
php emeset.php db:init-sqlite
```

### MySQL

Crea primer la base de dades al servidor MySQL i configura les credencials a `.env`:

```dotenv
db_type=PDO
DB_HOST=127.0.0.1
DB_PORT=3306
DB_NAME=todo
DB_USER=usuari
DB_PASS=contrasenya
```

La comanda d'inicialització fa servir `DB_PORT`; la connexió de l'aplicació
actualment utilitza el port MySQL per defecte, `3306`.

A continuació, inicialitza les taules i els usuaris de demostració:

```sh
php emeset.php db:init-pdo
```

Les comandes creen els usuaris que falten, de `user0` a `user9`; la contrasenya inicial és igual al nom d'usuari. Si un usuari ja existeix, es conserva sense canvis. Pots consultar les comandes disponibles amb `php emeset.php --help`.

## Executar l'aplicació

Per iniciar el servidor PHP i reconstruir els assets amb Vite quan hi hagi canvis:

```sh
npm run start
```

Obre <http://localhost:8000>. Per generar els assets de producció, executa:

```sh
npm run build
```

Vite genera `public/main.css` i `public/js/bundle.js`. Les vistes carreguen Bootstrap des d'un CDN. Si vols iniciar només el servidor PHP després de generar els assets, pots fer servir `npm run serve` o bé:

```sh
cd public
php -S localhost:8080 
```

## Tests

Configura `.env.test` amb una base de dades MySQL dedicada als tests i executa:

```sh
composer test
```

Els tests de base de dades reinicien les taules a partir de `Db/Db.sql`; no facis servir una base de dades amb dades que vulguis conservar.
