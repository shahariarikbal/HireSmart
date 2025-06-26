
---

## 🧱 Models & Relationships

- `User` (roles: admin, employer, candidate)
- `UserProfile` (1:1 with User)
- `JobList` (belongs to Employer)
- `Application` (candidate applies to Job)
- `Skill` (many-to-many with User via `UserSkill`)
- `UserSkill` (pivot table)

---

## 🔐 Authentication

- JWT-based login
- JWT-based logout
- Tokens issued via `/api/login`
- Use token as `Authorization: Bearer <token>` in all protected routes

---

## 🧪 Rate Limiting

- Login endpoint: `5 requests per minute`
- Job application: `1 request per minute per user`
- Rate limiting is middleware based using Laravel throttle

---

## 🐳 Docker Setup

### Prerequisites

- [Docker](https://www.docker.com/) & [Docker Compose](https://docs.docker.com/compose/)

### Quick Start

```bash
# 1. Clone the repo
git clone https://github.com/shahariarikbal/HireSmart/hiresmart.git
cd hiresmart

# 2. Create environment file
cp .env.example .env

# 3. Build and run containers
docker-compose up --build -d

# 4. Install dependencies inside container
docker-compose exec web composer install

# 5. Generate app key and JWT secret
docker-compose exec web php artisan key:generate
docker-compose exec web php artisan jwt:secret

# 6. Run migrations and seeders
docker-compose exec web php artisan migrate --seed
