# Inventory Management System

![Docker](https://img.shields.io/badge/Docker-Enabled-blue)
![Laravel](https://img.shields.io/badge/Laravel-Framework-red)
![MySQL](https://img.shields.io/badge/Database-MySQL-orange)

## 📌 About Project

**Inventory Management System** adalah aplikasi berbasis web yang digunakan untuk mengelola data inventory, monitoring stok, serta membantu proses administrasi barang.

Aplikasi ini menggunakan **Docker** untuk mempermudah proses instalasi, development, dan deployment.

Project ini juga terintegrasi dengan workflow automation menggunakan **n8n** untuk mendukung proses pengelolaan data.


## 🛠 Technology

### Backend
- Laravel
- PHP

### Frontend
- Blade
- Tailwind CSS
- JavaScript

### Database
- MySQL

### Automation
- n8n

### Environment
- Docker
- Docker Compose


## ⚙️ Requirement

Pastikan sudah memiliki:

- Git
- Docker
- Docker Compose


## 🚀 Installation

### 1. Clone Repository

```bash
git clone https://github.com/Zahdikafahriza/inventory_management.git
```

### 2. Masuk ke Folder Project

```bash
cd inventory_management
```

### 3. Setup Environment

```bash
cp .env.example .env
```

### 4. Jalankan Docker Container

```bash
docker compose up -d --build
```

### 5. Jalankan Database Migration

```bash
docker exec -it nama_container php artisan migrate
```

### 6. Akses Aplikasi

```
http://localhost
```


## 🐳 Docker Command

Menjalankan container:

```bash
docker compose up -d
```

Menghentikan container:

```bash
docker compose down
```

Melihat log:

```bash
docker compose logs -f
```

Build ulang:

```bash
docker compose up -d --build
```


## 🔐 Environment

Jangan upload file:

```
.env
```

Karena berisi data sensitif seperti:

- Database credential
- Application key
- API Key

Gunakan:

```
.env.example
```

sebagai template konfigurasi.


## 📂 Project Structure

```
inventory_management/

├── app/
├── database/
├── public/
├── resources/
├── routes/
├── Dockerfile
├── docker-compose.yml
└── .env.example
```


## 🌐 Deployment

Project dapat dijalankan pada:

✅ Local Development  
✅ VPS  
✅ Cloud Server  


## 📄 License

Project ini dibuat untuk kebutuhan pembelajaran,
pengembangan sistem, dan portfolio.


## 👤 Developer

**Zahdika Fahriza**

GitHub:
https://github.com/Zahdikafahriza
