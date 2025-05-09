# Secure User Registration System

This project is a secure user registration form built using **vanilla HTML, CSS, JavaScript, PHP**, and **MySQL**, following best practices for input validation, secure password handling, and responsive design.

[View a demo of the project here](demo.cedarvalewebdesign.ca)

## 📋 Features

- Responsive, accessible registration form
- Dynamic form behavior based on account type (Individual vs Company)
- Front-end validation using JavaScript
- Secure back-end processing with PHP
- Passwords are hashed using `password_hash()`
- User data stored in a MySQL database with appropriate constraints

---

## 🚀 Getting Started

### 📦 Requirements

- Apache Web Server
- PHP 7.4+
- MySQL 5.7+
- Ubuntu Linux (or compatible system)

---

### ⚙️ Setup Instructions (Local Dev on Ubuntu)

1. **Install the LAMP stack:**

   ```bash
   sudo apt update
   sudo apt install apache2 mysql-server php libapache2-mod-php php-mysql
   ```

2. **Clone or copy the project to your web root:**

   ```bash
   sudo mkdir -p /var/www/user-registration
   sudo chown -R $USER:www-data /var/www/user-registration
   ```

3. **Import the SQL schema:**

   ```bash
   mysql -u your_mysql_user -p registration_db < /path/to/schema.sql
   ```

4. **Configure your DB credentials in db.php:**

   ```php
   $host = 'localhost';
   $db   = 'registration_db';
   $user = 'your_mysql_user';
   $pass = 'your_mysql_password';
   ```

5. **Visit the form in your browser:**

   ```bash
   http://localhost/user-registration/
   ```
