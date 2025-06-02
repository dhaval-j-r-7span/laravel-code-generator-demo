# laravel-code-generator-demo
A demonstration project for generating REST API files in Laravel. This project helps automate the scaffolding of controllers, models, migrations, and other API components, streamlining the development of Laravel-based APIs.

Features
Generate RESTful controllers, models, and migrations
Supports automatic route registration
Customizable templates for code generation
Compatible with Laravel best practices
Blade templates included for quick API documentation or views
Requirements
PHP >= 8.0
Laravel >= 9.x
Composer
Installation
Clone the repository:

bash
git clone https://github.com/dhaval-j-r-7span/laravel-code-generator-demo.git
cd laravel-code-generator-demo
Install dependencies:

bash
composer install
Copy the example environment file and configure your settings:

bash
cp .env.example .env
php artisan key:generate
Run database migrations (if applicable):

bash
php artisan migrate
Usage
To generate API files, use the artisan command:

bash
php artisan make:api-resource {ResourceName}
Replace {ResourceName} with the name of your model/resource, e.g.:

bash
php artisan make:api-resource Post
This will create:

Model (app/Models/Post.php)
Migration (database/migrations/xxxx_xx_xx_create_posts_table.php)
Controller (app/Http/Controllers/PostController.php)
Route registration (routes/api.php)
Customization
Edit the stubs/templates in the resources/stubs directory to modify the generated code.
Update the generator logic in app/Console/Commands/MakeApiResource.php as needed.
Contributing
Fork this repository
Create a feature branch (git checkout -b feature/your-feature)
Commit your changes (git commit -am 'Add new feature')
Push to the branch (git push origin feature/your-feature)
Create a new Pull Request
License
This project is open-sourced under the MIT license.
