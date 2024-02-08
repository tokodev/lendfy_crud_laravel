# Laravel 10 CRUD User Application

## Overview

This is a Laravel 10 CRUD User Application built with PHP 8.2 and MariaDB, utilizing Docker for easy setup and deployment.

## Technologies

Make sure you have the following installed:

-   [Docker](https://www.docker.com/)

Installed via docker

-   [Laravel 10](https://laravel.com/docs/10.x/requests)
-   [PHP 8.2](https://www.php.net/)
-   [MariaDB](https://mariadb.org/)
-   [Nginx](https://www.nginx.com/)
-   [PhpMyAdmin](https://www.phpmyadmin.net/)

support the blades:

-   [TailwindCss](https://tailwindcss.com/)

## Setup

1.  **Clone the Repository:**

    ```bash
    git clone https://github.com/tokodev/lendfy_crud_laravel.git
    cd lendfy_crud_laravel
    ```

2.  **Docker Setup:**

    Build and run the Docker containers:

    ```bash
    docker-compose up --build -d
    ```

    Access the Laravel application container:

    ```bash
    docker-compose exec laravel sh
    ```

3.  **Acesso ao PHPMyAdmin**
    3.1. PHPMyAdmin is available at <http://localhost:16006>.
    3.2. Log in with the following credentials:

        ```bash
        user: root
        pass:
        ```

        3.3. Create a user in the User Accounts tab and then Add User Account:

        ```bash
        Username: laravel
        Hostname: %
        Password: 123456
        Repeat Password: 123456
        ```

        Mark the fields below:
        [x] Create database with the same name and grant all privileges.
        [x] Grant all privileges on wildcard name (user_name_%).
        [x] Global privileges

        Then execute button

4.  **Database Configuration:**

    Copy a `.env.example` to `.env` file in the project root and set the database configuration:

    ```bash
    cp .env.example .env
    ```

    Use the editor vi

    ```bash
    vi .env
    ```

    ```dotenv
    DB_CONNECTION=mysql
    DB_HOST=db
    DB_PORT=3306
    DB_DATABASE=laravel
    DB_USERNAME=laravel
    DB_PASSWORD=123456
    ```

5.  **Install Dependencies:**

    Inside the app container, install PHP dependencies:

    ```bash
    composer install
    ```

    Generate the application key:

    ```bash
    php artisan key:generate
    ```

    ```bash
    php artisan migrate
    ```

    Run migrations and seeders:

6.  **Access the Application:**

    6.1 . **Postman:** - Utilize the provided Postman collection for API requests:
    import the file Lendfy.postman_collection.json

    - Execute:
        - Create User
        - Get User
        - Update User
        - Get All Users
        - Delete User

    Everything worked perfectly, right?

    6.2 . **Access in browser**
    Open your browser and navigate to [http://localhost:16005/users](http://localhost:16005/users)

    - Test use:
        - Create User
        - Show User
        - Edit User
        - Delete User

7.  **User Seeds**

Create fake users to test pagination with Laravel Seeds

```bash
    php artisan db:seed --class=UsersTableSeeder
```

8. **Test User**

This test aims to ensure the correct functioning of user-related functionalities in our application.

```bash
php artisan test
```

OR just test the user

```bash
php artisan test --filter UserTest
```

9. **Final considerations**

-   Configure the dark mode theme
-   Adjust responsive
-   Add internalization

Among other things, I believe that the evaluation here plus the knowledge of Laravel in its CRUD
