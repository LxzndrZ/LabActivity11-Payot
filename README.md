# Barangay Bulletin - Purok Payot (Lab Activity 11)

A small Laravel site for the bulletin board of Purok Payot, Barangay Matina Crossing. Every post shows its author and tags, logged-in residents can comment, and Kagawads can write new posts from the site.

My personal setup:
- Site title: Barangay Bulletin - Purok Payot
- Posts per page: 6
- Kagawad: Kagawad Alexzander Payot
- Pinned post: "Purok Payot Clean-up Drive" (published May 20, 2026)

## Seeded logins

Both accounts use the password `bulletin2026`.

| Name | Email | Role |
|---|---|---|
| Lola Payot | lola.payot@bulletin.test | Resident (can comment, cannot write posts) |
| Kagawad Alexzander Payot | kagawad.payot@bulletin.test | Kagawad (can comment and write posts) |

## My 5 tags

Purok Payot, Urgent, Libre, Schedule, Community

## Relationships and why I used them

| Link | Type | Why |
|---|---|---|
| User to Author | hasOne (Author belongsTo User) | One login account belongs to one author profile. The link is `authors.user_id`. Residents like Lola have no author profile. |
| Author to Post | hasMany (Post belongsTo Author) | One author writes many posts. Each post has one author (`posts.author_id`). |
| Post to Comment | hasMany (Comment belongsTo Post) | One post can get many comments. Each comment is on one post. |
| User to Comment | hasMany (Comment belongsTo User) | One user can write many comments. Each comment has one writer. |
| Post and Tag | belongsToMany | A post can have many tags and a tag can be on many posts, so I used the `post_tag` pivot table. I use `sync()` and never insert into it by hand. |
| Author to Comment | hasManyThrough (through Post) | Comments do not have an author id. They are linked to posts, and posts are linked to authors. This lets me count "comments received" for an author in one call. |

## What I used for the other requirements

- No N+1: the index uses `with(['author', 'tags'])` and `withCount('comments')`. The show page uses `load()` for author, tags and `comments.user`. `preventLazyLoading` is on while developing.
- Tag filter: `/posts?tag=Urgent` uses `whereHas` on the tags relation.
- Form Requests: `StoreCommentRequest` (logged-in users only) and `StorePostRequest` (only users with an author profile). The controllers stay thin.
- Comment too short message: "Purok Payot comments need at least 3 characters."

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

On Windows PowerShell, use `copy .env.example .env` instead of `cp`. If `database/database.sqlite` is missing, create an empty file with that name before running the migrate command. Keep `npm run dev` running in one terminal and `php artisan serve` in another, then open http://127.0.0.1:8000.