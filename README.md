# Barangay Bulletin – Purok Payot

Lab Activity 10 for 4-334 Full-Stack Web Development (Ateneo de Davao University).
A small blog for Barangay Matina Crossing Hall in Davao City. Barangay officials (authors) post announcements, and residents can browse, search and page through them. Every page reads real rows from SQLite through Eloquent.

Built by Alexzander Payot.

## My personal values

| Item | Value |
|---|---|
| Posts per page | **6**. "Payot" has 5 letters, and the brief says to use 6 when the last name is shorter than 6 letters. |
| Custom category | **Livelihood** (the other four are Announcement, Health, Peace & Order, Ayuda) |
| Pinned post | "Purok Payot Clean-up Drive", published on **2026-05-20** (my birthday) |
| Hand-made author | Kagawad Alexzander Payot, kagawad.payot@bulletin.test, created with `Author::create()` |

## What is in the database

After `php artisan migrate:fresh --seed`:

- 5 authors (my Kagawad + 4 from the factory)
- 51 posts: 40 published, 10 drafts, plus my pinned post (41 are visible on the site)

## Pages

- `/posts` shows published posts only, pinned first and then newest. It has a title search (`?q=`), a category filter (`?category=`) and pagination.
- `/posts/{id}` shows one post and adds 1 to its views. A draft or a missing id gives a 404.

## How to run it

```
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate:fresh --seed
npm install
npm run dev
php artisan serve
```

Run `npm run dev` and `php artisan serve` in two separate terminals, then open http://127.0.0.1:8000.

If `database/database.sqlite` does not exist, create it first (PowerShell: `New-Item database/database.sqlite`).

## Notes

- `docs/tinker.png` shows `find()`, changing an attribute, and `save()` in tinker.
- Laravel version: composer installed Laravel 13 for me, but the Artisan commands are the same as in the brief.
- Tailwind v4 (`@tailwindcss/vite`) is used for the styling.
