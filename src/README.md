# 📦 Inventory Management System

A comprehensive inventory management system built with Laravel for managing products, tracking stock in/out transactions, and monitoring real-time inventory levels.

## ✨ Features

- **Master Product Management** - Create, read, update, and delete products with multiple items support
- **Stock In Transactions** - Record stock entries with automatic date, product selection, quantity, and notes
- **Stock Out Transactions** - Record stock exits with automatic date, product selection, quantity, and notes
- **Real-time Stock Calculation** - Automatic stock calculation based on initial stock, stock in, and stock out
- **Transaction Logs** - View detailed logs for all stock in/out transactions with filtering capabilities
- **Total Stock View** - Comprehensive view showing current stock levels with filtering and pagination
- **User Authentication** - Secure login system using Laravel Breeze (username-based authentication)
- **Responsive Design** - Modern and clean UI built with Tailwind CSS

## 🛠️ Tech Stack

- **Framework:** Laravel 12
- **Authentication:** Laravel Breeze
- **Database:** MySQL
- **Frontend:** Blade Templates with Tailwind CSS
- **JavaScript:** Vanilla JS for dynamic filtering

## 📋 Requirements

- PHP >= 8.2
- Composer
- MySQL >= 5.7
- Node.js & NPM (for asset compilation)

## 🚀 Installation

1. **Clone the repository**
   ```bash
   git clone https://github.com/kikybulin/inventory-app.git
   cd inventory-app
   ```

2. **Install dependencies**
   ```bash
   composer install
   npm install
   ```

3. **Environment setup**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Configure database**
   Edit `.env` file and set your database credentials:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=your_database_name
   DB_USERNAME=your_username
   DB_PASSWORD=your_password
   ```

5. **Run migrations and seeders**
   ```bash
   php artisan migrate
   php artisan db:seed
   ```

6. **Compile assets**
   ```bash
   npm run build
   ```

7. **Start the server**
   ```bash
   php artisan serve
   ```

   Visit `http://localhost:8000` in your browser.

## 👤 Default Login Credentials

- **Username:** admin
- **Password:** admin

## 📁 Project Structure

```
databasebarang/
├── app/
│   ├── Http/Controllers/
│   │   ├── BarangController.php
│   │   ├── StockInController.php
│   │   ├── StockOutController.php
│   │   ├── TotalStockController.php
│   │   ├── StockInLogController.php
│   │   └── StockOutLogController.php
│   └── Models/
│       ├── Barang.php
│       ├── StockIn.php
│       └── StockOut.php
├── database/
│   ├── migrations/
│   └── seeders/
│       └── AdminUserSeeder.php
└── resources/
    └── views/
        ├── barangs/
        ├── stock-ins/
        ├── stock-outs/
        ├── total-stock/
        ├── stock-in-logs/
        └── stock-out-logs/
```

## 🗄️ Database Schema

### Tables

- **barangs** - Product master data (nama_barang, jenis_barang, stock_awal)
- **stock_ins** - Stock in transactions (barang_id, tanggal, jumlah, keterangan)
- **stock_outs** - Stock out transactions (barang_id, tanggal, jumlah, keterangan)
- **users** - User accounts with username authentication

## 🔐 Authentication

The application uses Laravel Breeze with custom username-based authentication. Registration and password reset features are disabled - only login is available.

## 📝 Usage

1. **Login** with the default credentials
2. **Master Barang** - Add products with name, type, and initial stock
3. **Stock In** - Record incoming stock by selecting product type and name
4. **Stock Out** - Record outgoing stock (validates available stock)
5. **Total Stock** - View current stock levels with filtering options
6. **Log Stock In/Out** - View transaction history with date and filter options

## 🌐 Deployment

For deployment on aapanel or similar hosting:

1. Set document root to `public` directory
2. Update `.env` with production settings
3. Run `composer install --optimize-autoloader --no-dev`
4. Run `php artisan config:cache`
5. Run `php artisan route:cache`
6. Set proper permissions for `storage` and `bootstrap/cache`

## 📄 License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## 👨‍💻 Author

**Kikybulin**
- GitHub: [@kikybulin](https://github.com/kikybulin)

## 🤝 Contributing

Contributions, issues, and feature requests are welcome! Feel free to check the [issues page](https://github.com/kikybulin/inventory-app/issues).

---

⭐ If you find this project helpful, please give it a star!
