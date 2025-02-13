User role management
Languages Used
Frontend: HTML, CSS, JavaScript
Backend: PHP
Database: MySQL
Requirements
Ensure you have the following installed:
PHP >= 8
MySQL (or any other supported database)

Installation Steps
1. Clone the repository
Clone the project from GitHub:
git clone https://github.com/kyawlinntun-gif/user_managmement_sample.git

2. Create a database
Create a new database in MySQL (or your preferred database server).
Update the config/config.php file in the project root to include your database connection settings:
define('DB_HOST', 'localhost');
define('DB_NAME', 'user_management_sample');
define('DB_USER', 'root');
define('DB_PASS', '');

3. Migrate the database
Run the following command to set up and unset up the required database tables:
php migrate_table.php
php refresh_migrations.php
php run_seeder.php

4. Serve the application
Start the development server:
php -S localhost:90 -t public
The application will be accessible at http://localhost:90.

5. Role for users
  5.1 Kyaw Kyaw is Admin.
  5.2 Aung Aung is Operator.
  5.3 Mg Mg is managing.
  5.4 Aye Aye don't have role.

  First, login with kyaw kyaw and go to dashboard after than you can set the all roles and permissions and features.  