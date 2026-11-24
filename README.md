# Kilele Properties: complete Laravel 12 project

A premium real-estate website (charcoal and red) with a back office. This is a **complete project**: the Laravel 12 skeleton plus the site. It only needs its PHP packages installed.

## Install (Windows, WAMP/XAMPP)

Requirements: PHP 8.2 or newer (`php -v`), Composer, MySQL running.

1. In phpMyAdmin, create an empty database named **strateurban** (or change `DB_DATABASE` in `.env` to any name you created). If your MySQL root user has a password, set `DB_PASSWORD` in `.env`.
2. Double-click **install.bat** (or run the four commands inside it by hand):
   ```
   composer install
   php artisan migrate:fresh --seed
   php artisan storage:link
   php artisan serve
   ```
3. Open http://127.0.0.1:8000

Back office: http://127.0.0.1:8000/admin, login `admin@kilele.test` / `ChangeMe-2026!` (change it under My account).

`.env` is already set up with an app key, local mode and debug on, so errors show their real message. Set `APP_DEBUG=false` and `APP_ENV=production` only when you deploy.

## Before you go live

- The 13 listings and 3 developments are **samples** (marked "(sample)", with generated artwork). Replace them with real properties and photographs. Prices and unit details in the samples are made up.
- Only publish returns or income figures you can support. The site never promises guaranteed returns.
- The team member and testimonial are hidden samples. Fill them in before showing them.
- Name, colours, logo, email, phone, address and WhatsApp live in **Admin > Settings**; they are placeholders.
- The privacy and terms pages are templates. Have a lawyer review them.

## Notes

- Icons are inline SVG. Tailwind, Alpine and Google Fonts load from CDNs, so pages need internet.
- Enquiries and subscribers are always saved, even if email fails. Notifications go to `storage/logs/laravel.log` until you configure SMTP.
- Property shortcuts: `/for-sale`, `/for-rent`, `/apartments-for-sale`, `/apartments-for-rent`, `/houses-for-rent`, `/land-for-sale`, `/land-for-lease`.

## Troubleshooting

- A page shows "500": open `storage/logs/laravel.log` and read the last error, or turn on `APP_DEBUG=true` in `.env` and reload.
- "Access denied" or "Unknown database": the database in `.env` does not exist, or the username/password is wrong.
- Uploaded images missing: run `php artisan storage:link`.
- "Class not found": run `composer dump-autoload`.
- Unstyled pages: check your internet connection.
