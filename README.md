# Assignment 03 --- BookStock (Laravel + MySQL)

A web-based library management system built with **Laravel** and
**MySQL**, allowing full CRUD operations with image upload support.

---

## Features

- Categories CRUD
- Authors CRUD
- Books CRUD
- Book cover upload (with drag & drop preview)
- Book status (Available / Borrowed)
- Published date support
- Foreign key relationships:
  - Books → Author
  - Books → Category
- Image storage using Laravel file system
- Clean UI layout using Blade layouts & partials

---

## Project Structure

app/ bootstrap/ config/ database/ public/ resources/views/ routes/
storage/

### Important Folders

- resources/views/ → Blade templates (UI)
- app/Http/Controllers/ → Controllers
- database/migrations/ → Table structure
- storage/app/public/ → Uploaded book covers
- routes/web.php → Route definitions

---

## Database Structure

### categories

- id
- name (unique)
- timestamps

### authors

- id
- name (unique)
- bio (text)
- timestamps

### books

- id
- title
- isbn (unique)
- author_id (FK)
- category_id (FK)
- cover_image
- description
- published_at
- status (available / borrowed)
- timestamps

---

## Requirements

- PHP 8.x
- Composer
- MySQL / MariaDB
- Laravel 12
- Node.js (optional, if compiling assets)

---

## Setup Instructions

### 1) Clone Repository

git clone https://github.com/bdkazal/Assignment-03-BookStock.git

---

### 2) Install Dependencies

composer install

---

### 3) Configure Environment

cp .env.example .env php artisan key:generate

Update database credentials in .env:

DB_DATABASE=bookstock DB_USERNAME=root DB_PASSWORD=

---

### 4) Run Migrations

php artisan migrate

---

### 5) Create Storage Link

php artisan storage:link

---

### 6) Run Server

php artisan serve

Visit: http://127.0.0.1:8000

---

## Notes

- Cover images are stored in storage/app/public/covers
- Old cover image is deleted when updating with a new one
- Validation prevents duplicate ISBN and duplicate category/author
  names
- Edit pages correctly ignore unique validation for current record
- Status updates correctly reflect in list view

---

## Author

Submitted by: S M Kazal Mahmood\
Batch: Batch 4 (Full stack Laravel Career Path with PHP, Vue.js & AI)\
Email: kazalmahmood@gmail.com
