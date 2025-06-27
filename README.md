
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


📆 Background Jobs & Scheduling
This project includes automated background tasks and scheduled jobs to enhance platform functionality and maintain data integrity.

✅ Job Scheduling Features
1. 🧠 Candidate-to-Job Matching
Automatically runs in the background to match active candidates to suitable jobs based on:

Required skills

Location preference

Salary range

When a match is found, a notification is queued (can be logged or emailed)

2. 🗃 Task: Archive Old Job Posts
Automatically archives job listings older than 30 days

Runs daily using Laravel's scheduler

3. 🚫 Task: Remove Unverified Users
Automatically deletes users who haven't verified their email

Runs weekly

⚙️ How It Works
Laravel’s queue:work is used for background job processing

Laravel’s schedule:run is used for time-based task scheduling

🧪 How to Run Background Jobs in Docker
Start the queue worker:


docker-compose exec web php artisan queue:work
Run scheduled tasks manually (for testing):


docker-compose exec web php artisan schedule:run
✅ In production, you'll use a cron job that runs php artisan schedule:run every minute (as Laravel recommends).

✉️ Notification Delivery (Mocked or Real)
You can configure Laravel to:

Log notifications (default for dev)

Send real emails (Mailtrap, SMTP, etc.)

Update the .env file for email delivery:


MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=your_username
MAIL_PASSWORD=your_password
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS=no-reply@hiresmart.com
MAIL_FROM_NAME="${APP_NAME}"
