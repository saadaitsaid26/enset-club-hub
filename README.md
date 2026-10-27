# Club Management System (PP-GestionDesClubes)

A full-stack club management platform for schools/universities: manage clubs, announcements, events & activities, room (salle) reservations, material reservations, and users — with role-based access (admin, club manager, member).

## Project structure

```
.
├── frontend/   # React 19 + Vite + Tailwind CSS 4 SPA
└── backend/    # Laravel 10 REST API (PHP 8.1+, MySQL, Sanctum auth)
```

## Tech stack

| Layer    | Technologies |
|----------|--------------|
| Frontend | React 19, Vite, Tailwind CSS 4, React Router 7, TanStack Query, Axios, React Hook Form + Yup |
| Backend  | Laravel 10, Laravel Sanctum, MySQL, Mail (SMTP) |

## Prerequisites

- **Node.js** 18+ and npm
- **PHP** 8.1+ with the `mbstring`, `pdo_mysql` extensions
- **Composer** 2
- **MySQL** 8 (or MariaDB)

## Getting started

### 1. Backend (Laravel API — runs on `http://localhost:8000`)

```bash
cd backend

# Install PHP dependencies
composer install

# Create your environment file
cp .env.example .env          # Windows: copy .env.example .env

# Generate the application key
php artisan key:generate

# Configure your database in .env (DB_DATABASE, DB_USERNAME, DB_PASSWORD),
# then create the database (e.g. clubs_gestion) and run:
php artisan migrate --seed

# Start the API server
php artisan serve
```

The seeder creates a super admin account and sample data.

### 2. Frontend (React SPA — runs on `http://localhost:5173`)

```bash
cd frontend
npm install
npm run dev
```

## Configuration notes

- The frontend currently calls the API at **`http://localhost:8000/api`** (hardcoded in components) and serves images from `http://localhost:8000`. If you change the backend port or deploy remotely, update these URLs in `frontend/src`.
- CORS is configured in `backend/config/cors.php` and already allows `http://localhost:5173` and `http://localhost:3000`.
- Mail sending (e.g. club admin credentials) is configured via the `MAIL_*` variables in `backend/.env`.

## Scripts

| Location  | Command         | Description            |
|-----------|-----------------|------------------------|
| frontend  | `npm run dev`   | Start dev server       |
| frontend  | `npm run build` | Production build       |
| frontend  | `npm run lint`  | Run ESLint             |
| backend   | `php artisan serve` | Start API server  |
| backend   | `php artisan test`  | Run tests         |
