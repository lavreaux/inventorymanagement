# PT ChipiChapa – Inventory & Ordering System

A small Laravel web app where an admin manages products and categories, and customers browse the catalog, add items to a cart, and check out to get a printable invoice.

## Features

**Admin**
- Add, edit, and delete categories and products (with image upload)

**Customer**
- Register and log in
- Browse products and add them to a cart
- Check out with a delivery address and postal code
- View and print the invoice

## Requirements

- PHP 8.0 or newer
- Composer
- MySQL (for example via XAMPP or Laragon)

No Node.js is needed. Tailwind CSS is loaded from a CDN, so an internet connection is required to see the styling.

## Setup

1. Install dependencies:
   ```
   composer install
   ```
2. Create your environment file and app key:
   ```
   cp .env.example .env
   php artisan key:generate
   ```
   On Windows PowerShell, use `copy .env.example .env` instead of `cp`.
3. Start MySQL and create an empty database named `inv_db`. If your MySQL user or password differs from the defaults, edit `DB_USERNAME` and `DB_PASSWORD` in `.env`.
4. Create the tables and sample data:
   ```
   php artisan migrate --seed
   ```
5. Make uploaded product images visible:
   ```
   php artisan storage:link
   ```
6. Start the app:
   ```
   php artisan serve
   ```
   Then open http://127.0.0.1:8000

## Starting data

The app starts **empty**. `php artisan migrate --seed` creates only one account:

| Role | Email | Password |
|------|-------|----------|
| Admin | admin@example.com | admin123 |

There are no categories, products, or customers yet. To get started:

1. Log in as the admin.
2. Add at least one **category** (every product needs one).
3. Add **products** with an image, price, and stock.
4. Register a customer account to try the catalog, cart, and checkout.

Change the admin password before using this anywhere other than your own computer.

## Rules built into the app

- Registration: name 3–40 characters, a `@gmail.com` email, a phone number starting with `08`, and a password of 6–12 characters.
- Checkout: delivery address 10–100 characters, postal code exactly 5 digits, and every quantity must be at least 1.
- An order is rejected if a product does not have enough stock.
- Category names must be unique.

## Main pages

| URL | Who | What |
|-----|-----|------|
| `/register`, `/login` | Everyone | Create an account / sign in |
| `/products` | Logged-in users | Product catalog |
| `/cart` | Logged-in users | Cart and checkout |
| `/invoice/{id}` | Logged-in users | Invoice (printable) |
| `/admin/products` | Admin | Manage products |
| `/admin/categories` | Admin | Manage categories |

## Project structure (the parts you will edit most)

- `routes/web.php` – all page URLs
- `app/Http/Controllers/` – the logic for each page
- `app/Models/` – database tables as PHP classes
- `database/migrations/` – table definitions
- `resources/views/` – the pages (Blade templates)

## Troubleshooting

- **"could not connect to the database" / "connection refused":** MySQL is not running, or the `DB_*` values in `.env` are wrong.
- **"No application encryption key has been specified":** run `php artisan key:generate`.
- **Product images are missing:** run `php artisan storage:link`, then re-upload the images (they are not stored in Git).
- **Anything else:** check the last lines of `storage/logs/laravel.log`.
