# Service Provider Management API

A Symfony-based REST API for managing service providers and their services with Redis caching. This application provides endpoints for creating, reading, updating, and deleting providers and their associated services.

## Features

- RESTful API endpoints for Providers and Services
- Redis caching for improved performance
- Doctrine ORM for database management
- Symfony 6.x framework
- JSON responses
- Maintenance commands for cache management

## Requirements

- PHP 8.1 or higher
- Composer
- MySQL/MariaDB
- Symfony CLI (optional, for development)

## Installation

1. Clone the repository
```bash
git clone <your-repository-url>
cd <repository-name>
```

2. Install dependencies
```bash
composer install
```

3. Configure your environment variables by copying `.env` to `.env.local` and updating the values
```bash
cp .env .env.local
```

Update these values in `.env.local`:
```env
DATABASE_URL="mysql://your_username:your_password@127.0.0.1:3306/your_database_name"
```

4. Create the database and run migrations
```bash
php bin/console doctrine:database:create
php bin/console doctrine:schema:update --force
```


5. Start the Symfony development server
```bash
symfony server:start
# or
php -S localhost:8000 -t public/
```

## API Endpoints

### Providers

- **GET** `/providers` - List all providers
- **POST** `/providers` - Create a new provider
- **GET** `/providers/{id}` - Get a specific provider
- **PUT** `/providers/{id}` - Update a provider
- **DELETE** `/providers/{id}` - Delete a provider

### Services

- **GET** `/services` - List all services (cached)
- **POST** `/services` - Create a new service
- **GET** `/services/{id}` - Get a specific service
- **PUT** `/services/{id}` - Update a service
- **DELETE** `/services/{id}` - Delete a service

## Usage Examples

### Creating a Provider

```bash
curl -X POST http://localhost:8000/providers \
  -H "Content-Type: application/json" \
  -d '{
    "name": "John Doe",
    "email": "john@example.com",
    "phone": "1234567890"
  }'
```

### Creating a Service

```bash
curl -X POST http://localhost:8000/services \
  -H "Content-Type: application/json" \
  -d '{
    "name": "House Cleaning",
    "description": "Complete house cleaning service",
    "price": 99.99,
    "provider_id": 1
  }'
```

### Listing Services (Cached)

```bash
curl http://localhost:8000/services
```

## Maintenance

The application includes a maintenance command for cache management and statistics:

```bash
php bin/console app:maintenance
```

This command will:
- Clear the services and providers cache
- Generate and display current statistics

## Cache Management

The application uses Redis for caching the services list. Cache is automatically invalidated when:
- A new service is created
- A service is updated
- A service is deleted

Cache lifetime is set to 1 hour (3600 seconds) by default.

## Testing

Run tests using PHPUnit:
```bash
php bin/phpunit
```

## Troubleshooting


1. **Check Logs**
```bash
# View application logs
tail -f var/log/dev.log
```

