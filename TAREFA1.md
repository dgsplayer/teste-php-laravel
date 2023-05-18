
# Tarefa 1 Migrations/Seed

## Problema 1
O erro abaixo foi encontrado:
 1 table "categories" already exists 
(Connection: sqlite, SQL: create table "categories" 
("id" integer primary key autoincrement not null, "created_at" datetime, "updated_at" datetime, "name" varchar not null))
### Solução
Eu tomei a liberdade de retirar os arquivos de database/migrations e colocar em um backup.
Rodei um refresh com php artisan migrate:refresh e funcionou.


## Problema 2
Percebi o arquivo seeders/CategorySeeder.php mas não rodou pois não tinha chamada no DatabaseSeeder.
### Solução
Inseri o código $this->call(CategorySeeder::class); aí funcionou.


## Problema 3
O campo created_at não esta sendo populado automatimamente ao inserir um registro
### Solução
php artisan make:migration add_created_at_to_categories_table --table=categories
e adicionei o código abaixo para isso
public function up(): void
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->dateTime('created_at')->default(now());
        });
    }
depois php artisan migrate novamente