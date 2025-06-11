# Laravel Filament Project

This is a web application built with [Laravel](https://laravel.com/) and [Filament](https://filamentphp.com/), providing a modern admin panel and resource management out of the box.

## Features

- Powerful admin panel with Filament
- Resource management for News, Categories, Tags, and Users
- Authentication and authorization
- Modern UI and easy customization
- Built on top of Laravel's robust framework

## Getting Started

### Requirements
- PHP >= 8.1
- Composer
- Node.js & npm
- MySQL or compatible database

### Installation

1. Clone the repository:
   ```bash
   git clone <repo-url>
   cd laravel-filament
   ```
2. Install PHP dependencies:
   ```bash
   composer install
   ```
3. Install JS dependencies:
   ```bash
   npm install && npm run build
   ```
4. Copy the example environment file and set your configuration:
   ```bash
   cp .env.example .env
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

Access the Filament admin panel at `/admin` after running the server.

## About Filament

[Filament](https://filamentphp.com/) is a collection of tools for rapidly building beautiful TALL (Tailwind, Alpine, Laravel, Livewire) admin panels. It provides resource management, forms, tables, and more.

## Contributing

Contributions are welcome! Please open issues or pull requests for improvements.

## License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
