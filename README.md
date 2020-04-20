# TubesPBP

After clone the project, you have to do these :  <br>
for frontend folder run  
-npm install  
-npm run serve <br>
  
for backend folder run  
-composer install  
-copy the content of env.example, to .env. If you don't have .env, you have to create it  
-php artisan key:generate  
-php artisan serve

to fill database run
-php artisan migrate:fresh --seed
if class seeder not exist run
-composer dumpautoload then run php artisan migrate:fresh --seed again
