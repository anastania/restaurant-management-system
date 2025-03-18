# Restaurant Management System

A comprehensive restaurant management system built with Laravel, featuring product management, category management, ingredient management, order management, and promo code functionality.

## Features

- User Authentication & Authorization
- Dashboard with Statistics
- Category Management
- Ingredient Management
- Product Management
- Order Management
- Promo Code Management
- Responsive Design with Bootstrap

## Requirements

- PHP >= 8.2
- MySQL >= 5.7
- Composer
- Node.js & NPM

## Installation

1. Clone the repository:
```bash
git clone <repository-url>
cd restaurant-management
```

2. Install PHP dependencies:
```bash
composer install
```

3. Copy environment file and set your configurations:
```bash
cp .env.example .env
```

4. Generate application key:
```bash
php artisan key:generate
```

5. Run migrations and seeders:
```bash
php artisan migrate --seed
```

6. Start the development server:
```bash
php artisan serve
```

## Default Admin Account

- Email: admin@admin.com
- Password: password

## License

This project is licensed under the MIT License.
