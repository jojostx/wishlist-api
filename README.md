# Wishlist API

Repository:
```text
https://github.com/jojostx/wishlist-api
```

Laravel E-Commerce Feature - "Wishlist" Functionality

## Overview
A Back-End Laravel application that provides a "Wishlist" feature for an e-commerce environment. The application should allow users to sign up, log in, and then add, view, and remove products from their wishlists.

**Requirements**
- PHP 8.2+
- Composer
- Node.js and npm (only needed if you build assets)

**Setup**
1. Install dependencies.
```bash
composer install
```
2. Create the environment file and generate an app key.
```bash
copy .env.example .env
php artisan key:generate
```
3. Run migrations.
```bash
php artisan migrate
```
4. (Optional) Seed sample data.
```bash
php artisan db:seed --class=ProductSeeder
```

**Running**
```bash
php artisan serve
```

**API**
Base path: `/api`

Authentication uses a Bearer token issued by the `/api/register` and `/api/login` endpoints.
Include the header `Authorization: Bearer <token>` for protected routes.

**Endpoints**
| Method | Path | Auth | Description |
| --- | --- | --- | --- |
| POST | `/api/register` | No | Register a user and return a token |
| POST | `/api/login` | No | Login and return a token |
| POST | `/api/logout` | Yes | Revoke the current access token |
| GET | `/api/products` | No | List products |
| GET | `/api/products/{id}` | No | Get a single product |
| GET | `/api/wishlist` | Yes | List the authenticated user's wishlist |
| POST | `/api/wishlist` | Yes | Add a product to the wishlist |
| DELETE | `/api/wishlist/{product}` | Yes | Remove a product from the wishlist |

**Request Examples**
Register:
```bash
curl -X POST http://127.0.0.1:8000/api/register \
  -H "Accept: application/json" \
  -d "name=Ada Lovelace" \
  -d "email=ada@example.com" \
  -d "password=password123" \
  -d "password_confirmation=password123"
```

Login:
```bash
curl -X POST http://127.0.0.1:8000/api/login \
  -H "Accept: application/json" \
  -d "email=ada@example.com" \
  -d "password=password123"
```

Add to wishlist:
```bash
curl -X POST http://127.0.0.1:8000/api/wishlist \
  -H "Accept: application/json" \
  -H "Authorization: Bearer <token>" \
  -d "product_id=1"
```

**Responses**
All responses share a standard shape:
```json
{
  "status": "Request was successful.",
  "message": null,
  "data": {}
}
```

Validation errors return HTTP 422 and include field errors in `data`.
Auth errors return HTTP 401 with `message` set to `Unauthenticated.`.
Missing resources return HTTP 404 with `message` set to `Resource not found.`.

**Testing**
```bash
php artisan test
```
