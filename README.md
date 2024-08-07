
## Goqii backend

PHP Version 8

Laravel Version 11

## Steps to setup laravel

1. Clone the Repository
   ```
   git clone https://github.com/shubhzatakia/goqii-backend.git
   
   cd goqii-backend
   ```

2. Install PHP dependencies using Composer
   ```
   composer install
    ```
3. Create a .env file from the .env.example
   ```
   cp .env.example .env
    ```
4. Update the .env file with your database credentials and other necessary configurations.

5. Create a database on your local and enter the databasename in your .env file

    ```
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=goqii_database
    DB_USERNAME=username
    DB_PASSWORD=password
    ```


6. Run Database Migrations
  ```
  php artisan migrate
  ```   

7. Run the Development Server
   ```
   php artisan serve
   ```
