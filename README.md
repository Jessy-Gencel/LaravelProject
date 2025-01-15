# Laravel Project: Alien Defense 🚀

![PHP](https://img.shields.io/badge/PHP-%3E%3D8.1-blue) ![MySQL](https://img.shields.io/badge/MySQL-%3E%3D8.0-orange) ![Laravel](https://img.shields.io/badge/Laravel-11.x-red) ![Node.js](https://img.shields.io/badge/Node.js-%3E%3D16.0-green)

## Overview
Welcome to **Alien Defense**, a Laravel-based application featuring:

- A website experience with news, FAQs, user profiles, and leaderboards.
- A **tower defense game** inspired by the popular Plants vs Zombies.

Dive into the game and compete with friends to defend against alien invasions while enjoying seamless user interactions.

---

## Prerequisites
Ensure you have the following installed before proceeding:

1. **PHP** (version 8.1 or higher).
2. **MySQL** (version 8.0 or higher).
3. **WSL** (Windows Subsystem for Linux) - if you are on Windows.
4. **Composer** (Dependency Manager for PHP).
5. **Node.js** (for frontend dependencies).
6. **Git** (for cloning the repository).
7. **Mailtrap** (for testing email functionality).

---

## Installation Guide

Follow these steps to set up the project:

### 1. Clone the Repository
Clone the repository to your local machine and store it in `/var/www/html/name-of-cloned-repo` to avoid debugging errors.

```bash
git clone <repository-url>
cd name-of-cloned-repo
```

### 2. Set Up the Database
1. Log in to MySQL:
   ```bash
   mysql -u root -p
   ```
2. Create a new database:
   ```sql
   CREATE DATABASE project_database;
   ```
3. Create a new MySQL user and grant permissions:
   ```sql
   CREATE USER 'project_user'@'localhost' IDENTIFIED BY 'secure_password';
   GRANT ALL PRIVILEGES ON project_database.* TO 'project_user'@'localhost';
   FLUSH PRIVILEGES;
   ```

### 3. Generate the Application Key
Generate the application key for your Laravel application:
```bash
php artisan key:generate
```

### 4. Configure Environment Variables
1. Rename the `.env.example` file to `.env`:
   ```bash
   mv .env.example .env
   ```
2. Open the `.env` file and configure the following sections:

   **Application Key**
   ```env
   APP_KEY="Your app key that was just generated"
   ```

   **Database Configuration:**
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=project_database
   DB_USERNAME=project_user
   DB_PASSWORD=your_user_password
   ```

   **Mailer Configuration:**
   ```env
   MAIL_MAILER=smtp
   MAIL_HOST=smtp.mailtrap.io
   MAIL_PORT=2525
   MAIL_USERNAME=your_mailtrap_username
   MAIL_PASSWORD=your_mailtrap_password
   MAIL_ENCRYPTION=tls
   MAIL_FROM_ADDRESS=example@example.com
   MAIL_FROM_NAME="Alien Defense"
   ```

### 5. Install Dependencies
Install the necessary dependencies:
```bash
composer install
npm install
```

### 6. Add Necessary Images
Download the image folders from the provided [Google Drive link](https://drive.google.com/drive/folders/1yXtwHPg8jSp3WjF9MovqwiqQ6VlkQhaq?usp=drive_link). Place the folders as follows:

- **Under `public/`:**
  - Place the folder named `storage`.

- **Under `storage/app/`:**
  - Copy the same folder, rename it to `public`, and place it here.

### 7. Link Storage
Run the following Artisan command:
```bash
php artisan storage:link
```

### 8. Run the Project
Start the development servers:

1. Start the Laravel backend:
   ```bash
   php artisan serve
   ```
2. Start the frontend development server:
   ```bash
   npm run dev
   ```

---

## Testing the Installation
To verify the setup, visit the link in the php artisan terminal or visit:
```
http://localhost:8000
```
You should see the Laravel welcome page.

---

## 🎮 Enjoy the Game!
Your Laravel project is now ready. Defend against the alien invasion and aim for the top of the leaderboard. Happy gaming!

