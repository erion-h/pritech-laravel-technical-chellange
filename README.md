# Mini Issue Tracker

A small Laravel 13 app for managing projects, issues, tags, and comments — built for the PRITECH Laravel technical task.

## Stack

- Laravel 13, Laravel Breeze (Blade stack) for authentication
- Tailwind CSS + Vite for styling
- SQLite for the database (zero-config, no server setup required)
- Vanilla JavaScript (`fetch`) for AJAX interactions — no SPA framework

## Setup

```bash
composer install
npm install

cp .env.example .env
php artisan key:generate

php artisan migrate --seed
npm run build

php artisan serve
```

Visit `http://127.0.0.1:8000` and log in with one of the seeded accounts below.

For local development with hot-reloading assets, run `npm run dev` in a separate terminal instead of `npm run build`.

## Seeded accounts

| Email | Password | Role |
|---|---|---|
| alice@example.com | password | Owns 3 projects |
| bob@example.com | password | Owns 3 projects |

Plus 6 additional users available as assignable issue members. The seeder creates 6 projects, ~72 issues spanning every status/priority combination, 6 tags, and a randomized spread of comments and member assignments — enough data to exercise every filter, search, and pagination path on first run.

## Features

- **Projects** — list, create, edit, delete, and view a project with its issues. Only the project owner can edit or delete it (enforced via `ProjectPolicy`, with Blade `@can` guards hiding the buttons for non-owners).
- **Issues** — list with filters by status, priority, and tag, plus a debounced AJAX text search across title/description. Full CRUD, and a detail page showing tags, assigned members, and comments.
- **Tags** — create tags (unique name) and list them with issue counts. Attach/detach tags on an issue via AJAX, no page reload.
- **Comments** — paginated, AJAX-loaded list on the issue page. Adding a comment validates `author_name`/`body`, prepends the new comment to the list, and clears the form — with inline validation errors (no `alert()`).
- **Members (bonus)** — assign/unassign users to an issue via a second pivot (`issue_user`), with AJAX attach/detach mirroring the tags UI.

## Tests

```bash
php artisan test
```

Feature tests cover the `ProjectPolicy` authorization rules, issue filtering, and the comment AJAX validation/success paths.
