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

### 8. Seed the database with test data
To view the website with some test data you can run the command:
```bash
php artisan migrate:fresh --seed
```

### 9. Run the Project
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



## Sources and Inspirations 📚

### Internet Sources 🌐
- **Laravel Documentation**: This project heavily leverages Laravel's core functionality and best practices, as detailed in the [official Laravel documentation](https://laravel.com/docs/).
- **MySQL Documentation**: The database setup and queries follow the guidelines presented in the [MySQL official documentation](https://dev.mysql.com/doc/).
- **Mailtrap**: For email testing, we use [Mailtrap](https://mailtrap.io/) to simulate sending emails in a safe environment before going live.
- **Composer**: For PHP dependency management, the project follows Composer guidelines available on the [Composer website](https://getcomposer.org/).

### ChatGPT Conversations 💬

Throughout the development process of the application, valuable insights and solutions were gathered through detailed conversations with ChatGPT. These discussions contributed to various aspects of both the **backend** and **frontend** development, as well as **game mechanics** and **database design**. Key contributions include:

- **Backend and Frontend Structure**: Conversations on topics like **game logic**, **user authentication**, and **data storage strategies** provided crucial guidance for structuring the app in an efficient and scalable way.
  
- **Security Best Practices**: Discussions focused on **user input management**, **database queries**, and **email functionality** led to the adoption of best practices, such as **XSS/CSRF protection** and **password hashing**.

- **Laravel Design Recommendations**: Advice on **route organization**, **controller setup**, and **test implementation** helped follow Laravel conventions and ensured a clean and maintainable codebase.

---

### Links to the Conversations

The conversations can be found here:

- [ChatGPT1: Frontend Laravel](https://chatgpt.com/share/67881139-aa3c-8009-8ba9-0007fe002980)
- [ChatGPT2: Game Logic](https://chatgpt.com/share/678811e9-8cc8-8009-b82d-d6b52ef5dc6d)
- [ChatGPT3: Enemy Logic](https://chatgpt.com/share/67881238-54c8-8009-bc08-49dded691f48)
- [ChatGPT4: Admin Page](https://chatgpt.com/share/678812af-cb90-8009-9562-a606a2ec7f62)
- [ChatGPT5: Restructuring FAQ's](https://chatgpt.com/share/6788132d-b484-8009-af42-990f038ec5db)
- [ChatGPT6: AlpineJS Structuring](https://chatgpt.com/share/67881379-9fb0-8009-a1e7-ad2cf6308478)
- [ChatGPT7: Seeder Creation](https://chatgpt.com/share/678813cd-51f8-8009-931b-18532b597e62)


# Requirements Overview

## Functional Minimum Requirements

### 1. Login System  
- **Users can log in.**  
- **All visitors can create a new account.**  
- **A user account can be either a regular user or an admin.**  
- **Only admins can promote users to admin status and revoke those rights.**  
- **Only admins can manually create a new user (and make them an admin if necessary).**  

**Explanation and Code Placement:**  
- **Login functionality**: .  
- **Admin functionality**: .  

### 2. Profile Page  
- **Each user has their own public profile page, accessible to everyone, even non-logged-in users.**  
- **A logged-in user can modify their own data.**  
- **The profile contains at least the following data (fields are optional):**
    - Username  
    - Birthday  
    - Profile picture (stored on the web server)  
    - Short "about me" text  

**Explanation and Code Placement:**  
- **Profile page**: .  
- **User's ability to edit data**: .  

### 3. Latest News  
- **Admins can add, edit, and delete news items.**  
- **Every visitor can see a list of all news items and view details of each news item.**  
- **News items include at least:**
    - Title  
    - Image (stored on the server)  
    - Content  
    - Publication date  

**Explanation and Code Placement:**  
- **CRUD operations for news items**: .

### 4. FAQ Page  
- **The FAQ page contains a list of questions and answers, grouped by category.**  
- **Admins can add, edit, and delete categories and Q&A entries.**  
- **Every visitor can see the FAQ.**  

**Explanation and Code Placement:**  
- **FAQ functionality**: .

### 5. Contact Page  
- **Every visitor can fill out a contact form.**  
- **When the contact form is submitted, the admin receives an email with the form's content.**  

**Explanation and Code Placement:**  
- **Contact form handling**: .

### 6. Extra Features (Optional but beneficial for higher grades)  
- **Admins can view all submitted contact forms in an admin panel and respond to messages.**  
- **Users can leave comments on news items.**  
- **Users can send messages to another user's profile or send a private message.**  
- **Users can add questions to the FAQ.**  
- *Other project-specific features.*

**Explanation and Code Placement:**  
- **Additional features**: .

## Technical Requirements

### Views  
- **Use at least two layouts.**  
- **Use components where logical.**  
- **Use techniques covered in the course and exercises.**

**Explanation and Code Placement:**  
- **Layouts and components**:.

### Control Structures  
- **XSS protection**  
- **CSRF protection**  
- **Client-side validation**

**Explanation and Code Placement:**  
- **Security features**: .

### Routes  
- **All routes use controller methods.**  
- **All routes use necessary middleware.**  
- **Group your routes where possible.**

**Explanation and Code Placement:**  
- **Routes**: .

### Controllers  
- **Use controllers to split your logic and CRUD operations.**  

**Explanation and Code Placement:**  
- **Controller structure**: .

### Models  
- **Use Eloquent models for each entity.**  
- **Define necessary relationships:**
    - At least one **one-to-many**  
    - At least one **many-to-many**  

**Explanation and Code Placement:**  
- **Models**: .

### Database  
- **Ensure the database is working properly.**  
- **Ensure it contains the necessary base data.**

**Explanation and Code Placement:**  
- **Database setup**: .

### Authentication  
- **Standard functionalities:**
    - Log in/out  
    - 'Remember me'  
    - Register  
    - Password reset option  

**Explanation and Code Placement:**  
- **Authentication**: .




