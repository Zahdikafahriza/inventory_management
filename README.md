# Inventory Management System

Project      : Inventory Management
Developer    : Zahdika Fahriza
Environment  : Docker
Version      : 1.0.0


============================================================
                      ABOUT PROJECT
============================================================

Inventory Management System adalah aplikasi berbasis web yang
digunakan untuk mengelola data inventory, monitoring stok,
serta membantu proses administrasi barang.

Aplikasi ini menggunakan Docker untuk mempermudah proses
instalasi, development, dan deployment.

Project ini juga terintegrasi dengan workflow automation
menggunakan n8n untuk mendukung proses pengelolaan data.


============================================================
                      TECHNOLOGY
============================================================

Backend:
- Laravel
- PHP

Frontend:
- Blade
- Tailwind CSS
- JavaScript

Database:
- MySQL

Automation:
- n8n

Environment:
- Docker
- Docker Compose


============================================================
                      REQUIREMENT
============================================================

Pastikan sudah memiliki:

- Git
- Docker
- Docker Compose


============================================================
                      INSTALLATION
============================================================

1. Clone repository

git clone https://github.com/Zahdikafahriza/inventory_management.git


2. Masuk ke folder project

cd inventory_management


3. Copy environment

cp .env.example .env


4. Jalankan Docker Container

docker compose up -d --build


5. Jalankan migration database

docker exec -it nama_container php artisan migrate


6. Akses aplikasi

http://localhost


============================================================
                      DOCKER COMMAND
============================================================

Menjalankan container:

docker compose up -d


Menghentikan container:

docker compose down


Melihat log:

docker compose logs -f


Build ulang container:

docker compose up -d --build


============================================================
                      ENVIRONMENT
============================================================

Jangan upload file:

.env


File .env berisi konfigurasi sensitif seperti:

- Database credential
- Application key
- API Key


Gunakan:

.env.example

sebagai template konfigurasi.


============================================================
                      PROJECT STRUCTURE
============================================================

inventory_management/

├── app/
├── database/
├── public/
├── resources/
├── routes/
├── Dockerfile
├── docker-compose.yml
└── .env.example


============================================================
                      DEPLOYMENT
============================================================

Project dapat dijalankan pada:

✓ Local Development
✓ VPS
✓ Cloud Server


============================================================
                      LICENSE
============================================================

Project ini dibuat untuk kebutuhan pembelajaran,
pengembangan sistem, dan portfolio.


============================================================
                      CONTACT
============================================================

Developer:
Zahdika Fahriza


GitHub:
https://github.com/Zahdikafahriza


============================================================
