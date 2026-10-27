# 🎓 ENSET Club Hub

<div align="center">

![React](https://img.shields.io/badge/React-19-61DAFB?logo=react&logoColor=white)
![Vite](https://img.shields.io/badge/Vite-5-646CFF?logo=vite&logoColor=white)
![Tailwind CSS](https://img.shields.io/badge/Tailwind_CSS-4-06B6D4?logo=tailwindcss&logoColor=white)
![Laravel](https://img.shields.io/badge/Laravel-10-FF2D20?logo=laravel&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-%3E%3D8.1-777BB4?logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-8-4479A1?logo=mysql&logoColor=white)

**A full-stack club management platform for ENSET** — digitizing student club life: clubs, announcements, events, and room & material reservations, with role-based access control.

</div>

---

## 📋 About

**ENSET Club Hub** is a web platform that manages the entire lifecycle of student clubs at ENSET. The Super Admin oversees clubs, users, rooms, and reservation approvals, while each Club Admin manages their own club's profile, announcements, events, and reservation requests. Public visitors can browse clubs, announcements, and activities without an account.

## ✨ Features

### 🌍 Public (no account required)
- Browse all clubs with logos and descriptions
- View club announcements and activities/events
- Read announcement & event details

### 🔐 Authentication
- Token-based login via **Laravel Sanctum**
- Role-aware sessions (Super Admin / Club Admin)
- Logout & profile endpoints

### 👑 Super Admin
- **Clubs** — create, activate/deactivate, delete; view club members
- **Club Admin accounts** — create club admin accounts (credentials sent by email)
- **Users** — list, search by email, create, delete
- **Rooms (Salles)** — create, update, delete, list
- **Reservations** — approve/reject room and material reservations, filter by club & status

### 🏫 Club Admin
- **Club profile** — update their own club (logo, description, etc.)
- **Announcements** — create, update, delete for their club
- **Activities/Events** — create, update, delete for their club
- **Room reservations** — request, update, cancel; view available rooms by date
- **Material reservations** — request, update, cancel

## 🧱 Tech Stack

| Layer | Technologies |
|-------|--------------|
| **Frontend** | React 19, Vite, Tailwind CSS 4, React Router 7, TanStack Query, Axios, React Hook Form + Yup, Framer Motion, React Toastify, FontAwesome / Lucide icons |
| **Backend** | Laravel 10 (PHP ≥ 8.1), Laravel Sanctum, Role middleware, Blade mail templates |
| **Database** | MySQL 8 |
| **Mail** | SMTP (club admin credentials email) |

## 📁 Project Structure

```
enset-club-hub/
├── frontend/                 # React SPA (Vite + Tailwind)
│   ├── public/               # Static assets (logos, images)
│   └── src/
│       └── pages/
│           ├── Admin/        # Super Admin dashboard (clubs, users, rooms, reservations)
│           ├── clubs/        # Club space (profile, announcements, reservations)
│           ├── events/       # Public events & activities
│           ├── Anouncements/ # Public announcements
│           ├── landing/      # Landing page (hero, features, footer)
│           └── login/        # Authentication
└── backend/                  # Laravel 10 REST API
    ├── app/
    │   ├── Http/Controllers/ # Auth, Clubs, Announcements, Activities, Salles, Reservations, Users
    │   ├── Http/Middleware/  # RoleMiddleware (super_admin / admin_club)
    │   ├── Mail/             # ClubAdminCredentials mail
    │   └── Models/           # User, Club, Announcement, Activity, Salle, Reservations
    ├── config/cors.php       # Allowed frontend origins
    ├── database/
    │   ├── migrations/       # Schema
    │   └── seeders/          # SuperAdminSeeder + sample data
    ├── routes/api.php        # API routes grouped by role
    └── resources/views/      # Mail templates
```

## 🚀 Getting Started

### Prerequisites

| Tool | Version |
|------|---------|
| Node.js | ≥ 18 |
| PHP | ≥ 8.1 (`mbstring`, `pdo_mysql`) |
| Composer | ≥ 2 |
| MySQL | ≥ 8 |

### 1️⃣ Backend — Laravel API (port `8000`)

```bash
cd backend

# 1. Install PHP dependencies
composer install

# 2. Create your environment file
cp .env.example .env            # Windows: copy .env.example .env

# 3. Generate the application key
php artisan key:generate

# 4. Configure the database in .env
#    DB_CONNECTION=mysql
#    DB_HOST=127.0.0.1
#    DB_PORT=3306
#    DB_DATABASE=clubs_gestion     # create this database first
#    DB_USERNAME=root
#    DB_PASSWORD=

# 5. Run migrations + seeders (creates the Super Admin + sample data)
php artisan migrate --seed

# 6. Create the public storage symlink (for club logos & event images)
php artisan storage:link

# 7. Start the API
php artisan serve
```

> **Mail (optional):** to send club admin credentials by email, fill the `MAIL_*` variables in `.env` with a working SMTP account (e.g. Gmail app password).

### 2️⃣ Frontend — React SPA (port `5173`)

```bash
cd frontend
npm install
npm run dev
```

The app opens at **http://localhost:5173**.

### 🔑 Default Super Admin (created by the seeder)

| Email | Password |
|-------|----------|
| `superadmin@enset.ma` | `admin123` |

> ⚠️ Change this password immediately in any real environment. You can also create additional super admins via `php artisan tinker` (see the note in `backend/routes/api.php`).

## 🔌 API Overview

Base URL: `http://localhost:8000/api` — token passed as Bearer (Sanctum).

<details>
<summary><strong>Public endpoints</strong></summary>

| Method | Endpoint | Description |
|--------|----------|-------------|
| GET | `/clubs` | List all clubs |
| GET | `/clubs/{id}` | Club details |
| GET | `/announcements` | All announcements |
| GET | `/announcements/{id}` | Announcement details |
| GET | `/Clubannouncements/{id}` | Announcements of one club |
| GET | `/activities` | All activities |
| GET | `/activities/{id}` | Activity details |
| GET | `/ClubActivity/{id}` | Activities of one club |

</details>

<details>
<summary><strong>Authenticated (any role)</strong></summary>

| Method | Endpoint | Description |
|--------|----------|-------------|
| POST | `/login` | Login (returns token) |
| POST | `/logout` | Revoke token |
| GET | `/me` | Current user info |
| GET | `/materials` | List material reservations |
| GET | `/salle_reservation` | List room reservations |

</details>

<details>
<summary><strong>Super Admin only</strong></summary>

| Method | Endpoint | Description |
|--------|----------|-------------|
| POST | `/clubs` | Create a club |
| POST | `/clubs/{id}/active` | Activate / deactivate a club |
| DELETE | `/clubs/{id}` | Delete a club |
| POST | `/admins` | Create a club admin (emails credentials) |
| GET | `/clubs/{clubId}/users/details` | Members of a club |
| GET/POST/DELETE | `/salles`, `/salles/{id}`, `/salles/update/{id}` | Manage rooms |
| POST | `/materials/{id}/status` | Approve/reject material reservation |
| POST | `/salle_reservation/{id}/status` | Approve/reject room reservation |
| GET | `/club/{clubId}/reservations` | Club reservations by status |
| GET/POST/DELETE | `/users`, `/users/{id}` | Manage users |

</details>

<details>
<summary><strong>Club Admin only</strong></summary>

| Method | Endpoint | Description |
|--------|----------|-------------|
| POST | `/clubs/update/{id}` | Update own club profile |
| POST/DELETE | `/announcements/{id}`, `/announcements` | Manage own announcements |
| POST/DELETE | `/activities/{id}`, `/activities` | Manage own activities |
| POST | `/salles-available` | Search available rooms |
| POST/DELETE | `/salle_reservation`, `/salle_reservation/update/{id}` | Manage room reservations |
| POST/DELETE | `/materials`, `/materials/update/{id}` | Manage material reservations |

</details>

## ⚙️ Configuration Notes

- **API URL:** the frontend currently targets `http://localhost:8000/api` (and image URLs on `http://localhost:8000`) — these are hardcoded across `frontend/src`. If you change the backend port or deploy, update them (a `VITE_API_URL` refactor is on the roadmap).
- **CORS:** allowed origins live in `backend/config/cors.php` (`http://localhost:5173` and `:3000` are pre-configured).
- **File uploads:** club logos and activity images are stored under `backend/storage/app/public` (served via the `storage:link` symlink).
- **Roles:** enforced server-side by `app/Http/Middleware/RoleMiddleware.php` (`role:super_admin` / `role:admin_club`).

## 📜 NPM & Artisan Scripts

| Location | Command | Description |
|----------|---------|-------------|
| frontend | `npm run dev` | Start dev server (HMR) |
| frontend | `npm run build` | Production build → `dist/` |
| frontend | `npm run preview` | Preview the production build |
| frontend | `npm run lint` | ESLint |
| backend | `php artisan serve` | Start API on :8000 |
| backend | `php artisan migrate --seed` | Create schema + seed data |
| backend | `php artisan test` | Run test suite |
| backend | `php artisan storage:link` | Symlink public storage |

## 🗺️ Roadmap

- [ ] Move the API base URL to `VITE_API_URL` (single source of truth)
- [ ] Public registration & member accounts (club membership)
- [ ] Email notifications for reservation approvals
- [ ] Automated tests (Pest / PHPUnit + Vitest)
- [ ] CI pipeline (GitHub Actions)
- [ ] Docker Compose for one-command setup
- [ ] Deployment guide (shared hosting / VPS)

## 🤝 Contributing

This is a student-built project. If you'd like to contribute: fork the repo, create a feature branch (`feature/my-feature`), commit your changes, and open a Pull Request.

## 👤 Author

**Saad AIT SAIDOU-ALI** — [@saadaitsaid26](https://github.com/saadaitsaid26)

Developed as an academic project at **ENSET** (École Normale Supérieure de l'Enseignement Technique).

---

<div align="center">

Made with ❤️ for the ENSET student community

</div>
