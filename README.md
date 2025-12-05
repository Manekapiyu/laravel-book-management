# 📚 Laravel Book Management & Borrowing System

*A Laravel Skill-Test Project implementing CRUD, stock management, and a full borrowing/return workflow.*

---

## 📖 Overview

This project is a **Laravel-based CRUD application** for managing books, book categories, and book borrowing/return tracking.  
It demonstrates:

- Laravel CRUD operations  
- Database relationships (1-M, M-1)  
- Stock auto-update logic  
- Borrow & return mapping  
- Form validation  
- Blade templating  
- Eloquent ORM  
- Routing & controllers  
- Database seeding  

### ✔️ Features for Admins

- Add, edit, delete, and list books  
- Filter books by category  
- Issue books (stock decreases)  
- Return books (stock increases)  
- Prevent issuing when stock is zero  
- Track borrowings with timestamps  

---

## 🚀 Technologies Used

- **Laravel** (PHP Framework)  
- **MySQL**  
- **Eloquent ORM**  
- **Blade Templates**  
- **Node.js + Vite**  
- **Bootstrap 5**  

---

## 🛠 Installation Guide

### 1️⃣ Clone the repository
git clone https://github.com/Manekapiyu/laravel-book-management.git
cd laravel-book-management

### 2️⃣ Install PHP dependencies  
composer install

### 3️⃣ Install frontend dependencies  
npm install  
npm run dev

### 4️⃣ Configure environment variables  
Create the .env file:  
cp .env.example .env

###  Update database settings:
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=books_crud
DB_USERNAME=root
DB_PASSWORD=

### 5️⃣ Generate application key  
php artisan key:generate

### 6️⃣ Run migrations & seeders  
php artisan migrate --seed

This creates:
- All required tables  
- 5 categories in book_cate  
- Sample books (if included)  

### 📦 Features Included

## 📘 Book Management (CRUD)
- Create new books  
- Edit book details  
- Delete books  
- View full book list  
- Filter by category  
- Display category name in UI  

## 📂 Category Management
- Table: book_cate  
- Seeded with 5 default categories  
- Used as FK in books table  

## 🔄 Borrow & Return System
- Issue a book to a user  
- Return a book  
- Auto stock update  
- Prevent issuing when stock = 0  
- Borrow record tracking:

| Column      | Description      |
|-------------|------------------|
| user_id     | who borrowed     |
| book_id     | which book       |
| issued_at   | timestamp        |
| returned_at | timestamp        |
| status      | issued/returned  |

## 🔐 Validation Rules  
**Book Creation/Update**

| Field    | Rules               |
|----------|---------------------|
| title    | required            |
| author   | required            |
| price    | required, numeric   |
| stock    | required, numeric   |
| category | required, valid FK  |

## 🧱 Database Schema  

### book_cate
| Column | Type |
|--------|------|
| id | PK |
| name | string |
| timestamps | |

### books
| Column | Type |
|--------|------|
| id | PK |
| title | string |
| author | string |
| price | decimal |
| stock | integer |
| book_category_id | FK |
| timestamps | |

### users
Laravel default authentication users.

### borrowings
| Column | Type |
|--------|------|
| id | PK |
| user_id | FK |
| book_id | FK |
| issued_at | timestamp |
| returned_at | timestamp |
| status | issued/returned |
| timestamps | |

### ▶️ Running the App  
Start the server:
php artisan serve

Visit:  
http://localhost:8000

### 👨‍💻 Add Authentication  
composer require laravel/breeze --dev  
php artisan breeze:install  
npm install && npm run dev  
php artisan migrate

