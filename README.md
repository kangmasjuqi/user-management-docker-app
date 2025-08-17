# User Management - Docker App for Laravel + React

A simple full-stack application with MySQL database, Laravel backend API, and React frontend, all containerized with Docker.

-- pic 1 
<img width="531" height="663" alt="Screen Shot 2025-08-17 at 07 27 20" src="https://github.com/user-attachments/assets/4d9eb364-9b8e-4e16-a431-687a8b8a9f3d" />

-- pic 2
<img width="997" height="710" alt="Screen Shot 2025-08-17 at 07 27 36" src="https://github.com/user-attachments/assets/4836ea32-4e37-4edc-b60a-ce5b8d5c939a" />

-- pic 3
<img width="925" height="492" alt="Screen Shot 2025-08-17 at 07 27 45" src="https://github.com/user-attachments/assets/ce34f764-94f2-4827-8505-d06d614d62b8" />

-- pic 4
<img width="1190" height="702" alt="Screen Shot 2025-08-17 at 07 28 17" src="https://github.com/user-attachments/assets/48eab69b-6a58-4713-86ae-e4a62b7c5490" />


## Demo

https://www.loom.com/share/f7abe4959a2c4340a68c56afe2b34aed


## 🏗️ Architecture

- **Database**: MySQL with users and user_educations tables
- **Backend**: Laravel API with authentication and CRUD endpoints
- **Frontend**: React SPA with mobile-responsive UI
- **Containerization**: Docker & Docker Compose

## 📁 Project Structure

```
project-root/
├── docker-compose.yml
├── backend/
│   ├── Dockerfile
│   └── [Laravel application files]
├── frontend/
│   ├── Dockerfile
│   └── [React application files]
```

## 🐳 Docker Configuration

## 🚀 API Endpoints

### Authentication
- `POST /api/register` - User registration
- `POST /api/login` - User login
- `POST /api/logout` - User logout

### Data Endpoints
- `GET /api/dashboard` - Dashboard statistics
- `GET /api/users` - List all users
- `GET /api/users/{id}` - User details with educations

## 💻 Frontend Pages

### Pages Structure
- **Login Page** (`/login`) - User authentication
- **Register Page** (`/register`) - User registration
- **Dashboard** (`/dashboard`) - Statistics overview
- **Users List** (`/users`) - All users listing
- **User Detail** (`/users/:id`) - Individual user with educations
- **Logout** - Logout functionality in header/nav

### Mobile Responsiveness
- Responsive design using CSS Grid/Flexbox
- Mobile-first approach
- Touch-friendly interface elements
- Optimized for screens 320px and above

## 🛠️ Setup Instructions

### Prerequisites
- Docker & Docker Compose installed
- Ports 3000, 8000, and 3307 available

### Quick Start

1. **Clone and setup project structure**
```bash
mkdir user-management-docker-app && cd user-management-docker-app
# Create the directory structure as shown above
```

2. **Start all services**
```bash
docker-compose up -d
```

3. **Setup Laravel backend**
```bash
# Generate application key
docker exec fullstack_backend php artisan key:generate

# Run migrations
docker exec fullstack_backend php artisan migrate

# Run seeders (creates 10 users with 2-5 educations each)
docker exec fullstack_backend php artisan db:seed
```

4. **Access the application**
- Frontend: http://localhost:3000
- Backend API: http://localhost:8000
- Database: localhost:3306

### Development Commands

```bash
# View logs
docker-compose logs -f [service_name]

# Stop services
docker-compose down

# Rebuild containers
docker-compose up --build

# Access container bash
docker exec -it fullstack_backend bash
docker exec -it fullstack_frontend sh
```

## 🔧 Environment Variables

### Backend (.env)
```env
DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=fullstack_db
DB_USERNAME=laravel_user
DB_PASSWORD=laravel_password
```

### Frontend (.env)
```env
REACT_APP_API_URL=http://localhost:8000
```

## 🎯 Features

### Database
- ✅ MySQL 8.0 with persistent storage
- ✅ Automated initialization scripts
- ✅ Seeded with 10 sample users
- ✅ 2-5 education records per user

### Backend
- ✅ Laravel 10+ API
- ✅ JWT authentication
- ✅ RESTful endpoints
- ✅ Database seeders with realistic data
- ✅ CORS configuration for frontend

### Frontend
- ✅ React 18+ SPA
- ✅ Responsive mobile design
- ✅ Authentication flow
- ✅ CRUD operations
- ✅ Modern UI components

## 🔍 Troubleshooting

### Common Issues

**Database connection failed**
```bash
# Check if database is running
docker-compose ps
# Check database logs
docker-compose logs db
```

**Laravel migrations fail**
```bash
# Wait for database to be ready, then retry
docker exec fullstack_backend php artisan migrate:fresh --seed
```

**Frontend can't reach backend**
- Verify REACT_APP_API_URL in frontend .env
- Check if backend container is running on port 8000

**Port conflicts**
- Modify ports in docker-compose.yml if defaults are occupied
- Update frontend .env accordingly

## 📝 Next Steps

- Add Redis for caching and sessions
- Implement file upload functionality  
- Add email verification
- Set up automated testing
- Configure production environment
- Add nginx reverse proxy
- Set up CI/CD pipeline

