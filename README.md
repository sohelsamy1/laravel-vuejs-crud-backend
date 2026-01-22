# Laravel Vue.js CRUD Backend API

This repository contains the **Backend REST API** for a Laravel + Vue.js CRUD application.  
The backend is built with **Laravel**, secured using **Laravel Sanctum**, and provides authentication, profile management, and task management APIs.

👉 **Frontend:** Built with **Vue.js**  
🔗 Frontend Repository: https://github.com/sohelsamy1/laravel-vuejs-crud-frontend  
👉 **Screenshots & demo video:** Will be added later

---

##  Tech Stack

- Laravel
- Laravel Sanctum (API Authentication)
- RESTful API
- MySQL (or compatible database)

---

## 📦 Features

### 🔐 Authentication
- User Registration
- User Login
- User Logout
- Get authenticated user info (`/me`)

### 👤 Profile
- Update authenticated user profile

### Task Management
- Create task
- List tasks
- View single task
- Update task
- Delete task (soft delete)
- Restore task
- Force delete task
- Update task status
- Filter tasks by status
- Task summary (including trashed tasks)

---

## 🔗 API Routes (v1)

All API endpoints are prefixed with:

/api/v1


### 🔓 Public Routes
| Method | Endpoint | Description |
|------|---------|-------------|
| POST | /register | User registration |
| POST | /login | User login |

---

### 🔐 Protected Routes (auth:sanctum)

#### Auth
| Method | Endpoint | Description |
|------|---------|-------------|
| POST | /logout | Logout user |
| GET | /me | Get authenticated user |

#### Profile
| Method | Endpoint | Description |
|------|---------|-------------|
| PATCH | /profile | Update profile |

#### Tasks
| Method | Endpoint | Description |
|------|---------|-------------|
| GET | /tasks | Get all tasks |
| POST | /tasks | Create task |
| GET | /tasks/{id} | Get single task |
| PUT/PATCH | /tasks/{id} | Update task |
| DELETE | /tasks/{id} | Soft delete task |
| POST | /tasks/{id}/restore | Restore task |
| DELETE | /tasks/{id}/force | Permanently delete task |
| PATCH | /tasks/{task}/status | Update task status |
| GET | /tasks/summary | Task summary |
| GET | /tasksfilter | Filter tasks by status |

---

## ⚙️ Installation

```bash
git clone <repository-url>
cd project-folder
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan serve

```

## 🔐 Authentication Notes

Authentication is handled using Laravel Sanctum
All protected routes require a valid Bearer Token

## Frontend

The frontend is developed separately using Vue.js and consumes this API.

## Screenshots & Demo

Screenshots and demo video will be added in future updates.

## Author

Sohel Samy
- GitHub: https://github.com/sohelsamy1  
- LinkedIn: https://linkedin.com/in/sohelsamy

⭐ If you like this project, feel free to star the repository.
