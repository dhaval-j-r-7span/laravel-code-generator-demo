# laravel-code-generator-demo

A demonstration project for generating REST API files in Laravel. This project helps automate the scaffolding of controllers, models, migrations, and other API components, streamlining the development of Laravel-based APIs.

## Features

*   Generate RESTful controllers, models, and migrations
*   Supports automatic route registration
*   Customizable templates for code generation
*   Compatible with Laravel best practices
*   Blade templates included for quick API documentation or views

## Requirements

*   PHP >= 8.0
*   Laravel >= 9.x
*   Composer

## Installation

1.  **Clone the repository:**

    ```bash
    git clone https://github.com/DhavalRajput-j-r-7span/laravel-code-generator-demo.git
    cd laravel-code-generator-demo
    ```

2.  **Install dependencies:**

    ```bash
    composer install
    ```

3.  **Configure environment variables:**

    Copy the example environment file and configure your settings:

    ```bash
    cp .env.example .env
    php artisan key:generate
    ```

4.  **Run database migrations (if applicable):**

    ```bash
    php artisan migrate
    ```

Clearing Logs

You can clear generated logs either manually or automatically.

🔹 Manually (Artisan)

php artisan code-generator:clear-logs
Add env variable in .env file:

CODE_GENERATOR_LOG_RETENTION_DAYS=2
🔹 Automatically (Laravel 12+)

Add this in bootstrap/app.php:

scheduler()
    ->command('code-generator:clear-logs')
    ->daily(); // or weekly/monthly
🔹 Automatically (Laravel 10+)

For Laravel 10 and later, you can schedule the log clearing command in the schedule method of your app/Console/Kernel.php file:

protected function schedule(Schedule $schedule): void
{
    $schedule->command('code-generator:clear-logs')->daily(); // Runs daily
    // Or, weekly:
    // $schedule->command('code-generator:clear-logs')->weekly();
    // Or, for monthly:
    // $schedule->command('code-generator:clear-logs')->monthly();
}