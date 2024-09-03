<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About This Project

This project is a Laravel-based web application that provides a news platform. It includes features such as article management, user authentication, and more.

## Features

- Article Management
- User Authentication
- Pagination
- Sorting and Filtering

## Requirements

- PHP >= 7.3
- Composer
- Node.js & npm

## Installation

1. Clone the repository:
    ```sh
    git clone https://github.com/your-username/your-repo.git
    cd your-repo
    ```

2. Install dependencies:
    ```sh
    composer install
    npm install
    ```

3. Copy the `.env.example` file to `.env` and configure your environment variables:
    ```sh
    cp .env.example .env
    ```

4. Generate an application key:
    ```sh
    php artisan key:generate
    ```

5. Run migrations:
    ```sh
    php artisan migrate
    ```

6. Seed the database (optional):
    ```sh
    php artisan db:seed
    ```

7. Build the front-end assets:
    ```sh
    npm run dev
    ```

## Usage

1. Start the local development server:
    ```sh
    php artisan serve
    ```

2. Visit `http://localhost:8000` in your browser.

## Running Tests

### Unit Tests

To run the unit tests, use the following command:
```sh
php artisan test