composer install
I will export and compress the db. Just need to import it to mysql. OR Can do migration using "php artisan mirate".
Seed the database using "php artisan db:seed -–class=UserTableSeeder"
Inside seeder file, user name and password are provided (database\seeders\UserTableSeeder.php)
Finally run the project using "php artisan serve"