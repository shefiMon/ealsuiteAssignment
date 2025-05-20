# Ealsuite


## Prerequisites
- PHP >= 8.1
- Composer
- Node.js & NPM
- MySQL/MariaDB
- Laravel 10.x

## Installation
1. Clone the repository:
```bash
git clone https://github.com/shefiMon/ealsuiteAssignment.git
cd ealsuite
```

2. Install dependencies:
```bash
composer install
npm install
```

3. Configure environment:
```bash
cp .env.example .env
php artisan key:generate
```

4. Setup database:
- Create database in MySQL
- Update .env file with database credentials
- Run migrations and seeders:
```bash
php artisan migrate
php artisan db:seed
php artisan db:seed --class=UserSeeder
```

Default login credentials:
```
Email: admin@example.com
Password: 123456
```

5. Build assets:
```bash
npm run dev
```

## Running the Application
```bash
php artisan serve
```
Visit `http://localhost:8000` in your browser.

