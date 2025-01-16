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
- **Login functionality**: All the basic functionality is present and can be found in the login screen. When logging in the is_admin field will determine whether or not the user receives the admin homepage or not. The templates responsible are the login blade and the home blade page.    
- **Admin functionality**: The admin receives a dashboard allowing them to allevate users to admin status and can also create users. These functions can be found by clicking on user management when on the admin dashboard. The logic is governed by the AdminController and the blade for adding users can be found under the admin folder under views

### 2. Profile Page  
- **Each user has their own public profile page, accessible to everyone, even non-logged-in users.**  
- **A logged-in user can modify their own data.**  
- **The profile contains at least the following data (fields are optional):**
    - Username  
    - Birthday  
    - Profile picture (stored on the web server)  
    - Short "about me" text  

**Explanation and Code Placement:**  
- **Profile page**: The profile pages can be viewed by anyone. This can be done by navigating to the leaderboard section and clicking on a user, the page shown is the profile_view and the logic is managed by the ProfileController. All users can alter their own profiles by clicking on their profile in the top right when logged in and changing one of the fields with the pencil icon. This logic is managed by the profile view and is also managed by the ProfileController.

### 3. Latest News  
- **Admins can add, edit, and delete news items.**  
- **Every visitor can see a list of all news items and view details of each news item.**  
- **News items include at least:**
    - Title  
    - Image (stored on the server)  
    - Content  
    - Publication date  

**Explanation and Code Placement:**  
- **News items**: The news items can be found by navigating to news as either a logged in admin,user or just a stranger. Admins can fully manage news items, these features can be found on the news page when logged in as an admin. The blade files responsible for this feature can be found under news in the create and index blade files. The NewsController manages all of the logic attached

### 4. FAQ Page  
- **The FAQ page contains a list of questions and answers, grouped by category.**  
- **Admins can add, edit, and delete categories and Q&A entries.**  
- **Every visitor can see the FAQ.**  

**Explanation and Code Placement:**  
- **FAQ functionality**: The FAQ's can be found on the FAQ page. They are accessible to all visitors of the site. The FAQ's are grouped per category. FAQ's can be added by both logged in users and admins, a user first requires the admin to validate the FAQ for it to be visible to the public. The Views can be found in the FAQ folder and the FaqController handles the logic of the Faq's

### 5. Contact Page  
- **Every visitor can fill out a contact form.**  
- **When the contact form is submitted, the admin receives an email with the form's content.**  

**Explanation and Code Placement:**  
- **Contact form handling**: The contact form page is accessible to everyone and sends an email to the configured admin. The contact form page can be found in contact blade and the logic is managed by the ContactController. 

### 6. Extra Features (Optional but beneficial for higher grades)  
- **Admins can view all submitted contact forms in an admin panel and respond to messages.**  
- **Users can leave comments on news items.**  
- **Users can leave comments on another user's profile.**  
- **Users can add questions to the FAQ.**  
- *Other project-specific features.*

**Explanation and Code Placement:**  
- **Contact panel**: The admin has a panel which shows all contact requests and allows for answering of the requests, this then automatically sends an email with the answer to the provided email adress of the user. The page can be found by clicking on the contact section of the navbar while logged in as an admin. The page is kept under the admin folder called contactDashboard and the logic is managed by the AdminController
- **Comments on news**: Users can leave comments on news articles. A logged in user will see the option to leave a comment on a news instance. This is managed by the newsController, and has the functionality managed on the news index page.
- **User Comments on profiles**: Users can leave comments on another user's profile. This can be found on the profile_view page which can be accessed by entering the leaderboard page and then clicking on a user. The comments are managed by the profileController.
- **Adding questions to FAQ**: As mentioned already, users can ask questions via the Faq page which will then be sent to an admin for approval and answering. This function is managed by the FAQ controller and can be accessed on the FAQ page.
- **Blacklisting users**: Admins have the option to blacklist users. Once that the blacklist button is pressed the user is unable to access the website. This functionality can be found on the admin dashboard and is managed by the admin controller. To ensure that this functionality is enforced A custom middleware was made to check this field on all users before any routing. It can be found in the bootstap folder in app.php.
- **Leaderboards**: A custom feature showing the scores of all users and their ranking based on how many enemies they managed to kill in the game. The leaderboard file can be found under the folder leaderboard and is managed by the LeaderboardController. Admin users additionally get the option to ban scores because of signs of tampering, this then also automatically blacklists the user.
- **Badges**: A custom feature working similarily to achievements in Steam. Upon completing certain actions the user will be awarded a badge which they can see on their profile or when viewing another users profile. The badges are given in a variety of functions, to see some examples the GameController awards a decent amount. Additionally badges can be found upon completing your profile and making your account for the first time.
- **Game**: Next to just the Laravel project there is an entire game section of the project. This is a fully functional game with 2 towers and 13 enemies custom made in PhaserJS. Each enemy is uniques in their skillset ensuring a fun challenge. Anyone is invited to try and beat the almighty juggernaut.

## Technical Requirements

### Views  
- **Use at least two layouts. -> Layout folder has layouts for header and footer pages and the game window. It also features a layout for banned users**  
- **Use components where logical. -> Editable fields, pfp uploads and other profile page structures are reused throughout the profile page **  
- **Necessary control structures -> @CSRF is used on forms, middleware and Laravel features are used to counter XSS while client side validation is used on users profile making.**
  
### Routes  
- **All routes use controller methods. -> Web route file always use Controller methods**  
- **All routes use necessary middleware. -> Routes only allowed to be viewed by certain users have the necessary auth middleware and admins have a custom admin middleware**  
- **Group your routes where possible. -> The routes are grouped where possible**

### Controllers  
- **Use controllers to split your logic and CRUD operations. -> All functionality is linked to Controllers which each have clearly defined responsibilities**  


### Models  
- **Use Eloquent models for each entity. -> each entity has a corresponding model which can be found in the middleware list.**  
- **Define necessary relationships:**
    - At least one **one-to-many -> A user can have be the author of multiple faqs. This can be found on line 38 of the user model**  
    - At least one **many-to-many -> A user can have multiple achievements and an achievement can belong to multiple users. This can be found on line 55 of the user model**  


### Database  
- **Ensure the database is working properly. -> Database has correct migrations**  
- **Ensure it contains the necessary base data. -> Database has correct seeders**


### Authentication  
- **Standard functionalities:**
    - Log in/out -> can be found on the login page and is managed in the authController from line 18-39 and 90-97
    - 'Remember me' ->  Can be found in the AuthController from line 30-34 
    - Register  -> Can be found in the AuthController from line 46-89 
    - Password reset option -> Can be found in the AuthController from line 120-174





