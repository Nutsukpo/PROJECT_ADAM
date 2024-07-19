# DBC_FINAL_PROJECT_ADAM
Administrative Assistant Manager by Laravel and Boostrap Blade Template

Installation and Setup
Prerequisites
•	PHP >= 8.1
•	Composer
•	MySQL
•	Node.js & npm
•	Laravel 10
•	Bootstrap
Installation Steps
1.	Clone the repository:
sh
Copy code
git clone https://github.com/your-repo/administrative-assistant-manager.git
cd administrative-assistant-manager

2.	Install dependencies:
sh
Copy code
composer install
npm install

3.	Configure the environment:
o	Copy .env.example to .env
o	Set up your database credentials in the .env file

4.	Generate application key:
sh
Copy code
php artisan key:generate

5.	Run migrations and seed the database:
sh
Copy code
php artisan migrate --seed

6.	Start the development server:
sh
Copy code
php artisan serve
