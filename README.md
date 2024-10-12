# Project Overview

This project is a **Laravel-based web application** designed to track user activity and provide functionality for both regular users and administrators. It includes basic user management (registration, login, and logout) with an additional layer of activity tracking, where every significant user action (such as page views, button clicks, and file downloads) is recorded. Administrators have access to a panel that allows them to view and filter user activity logs and generate reports based on recent user behavior. The project incorporates modern design principles for responsive and user-friendly interface functionality.

## Key Features
### 1. **User Authentication**
   - The application provides full authentication functionality including user **registration**, **login**, and **logout**. The authentication system is powered by **Laravel’s Auth** features, ensuring secure password handling with **Hashing**.
   - Users have roles: a standard user and an admin. Admins have additional permissions to view statistics and reports.
   - **Blade templates** are used to conditionally render the interface based on user roles.

### 2. **User Activity Logging**
   - Every time a user performs key actions, such as logging in, logging out, viewing specific pages (e.g., **Page A: Buy a cow**, **Page B: Download**), or clicking buttons, these actions are logged in the database using the **ActivityLog** model.
   - Admins can view detailed logs of all actions performed by users, including timestamps and descriptions of actions like "viewed page A" or "purchased a cow."

### 3. **Admin Panel**
   - The admin dashboard provides access to **user activity statistics**. Admins can view:
     - User logins, logouts, page visits, and specific actions (such as clicking "Buy a cow" or downloading a file).
     - The statistics page offers **filtering options** by date, user, and type of action, making it easier to pinpoint specific behaviors or trends.
   - An interactive **reports page** is provided, offering visual charts generated using **Chart.js**. The charts show trends of user activity over time, giving insight into how frequently certain actions occur over a set period.

### 4. **Modern Design & Responsiveness**
   - The project uses custom **CSS** for a clean, modern, and responsive design. The layout is structured to work well across desktop, tablet, and mobile devices.
   - The interface incorporates a **top navigation bar** that adjusts based on whether the user is logged in, and whether they are an admin. Admin-only options are hidden from regular users.
   - The design also includes **hover effects**, **animations**, and **alerts** for user actions (such as successful purchases or file downloads).

### 5. **Database Integration & Migrations**
   - The project utilizes **Laravel's Eloquent ORM** to interact with the database, ensuring smooth handling of user data and activity logs.
   - **Database migrations** handle the creation and management of tables like users, activity logs, etc. This allows for a structured and consistent database schema that can be easily updated.
   - A MySQL database is used for persistent data storage, configured via the `.env` file.

## Installation and Setup

### 1. Clone the Repository
```bash
git clone https://github.com/your-repo-url.git
```

### 2. Install Dependencies
```bash
composer install
```

### 3. Set Up the Environment
- Copy the `.env.example` file to `.env`:
```bash
cp .env.example .env
```
- Configure your database settings (e.g., DB name, user, password) in the `.env` file.

### 4. Generate Application Key
```bash
php artisan key:generate
```

### 5. Run Migrations
- To set up the database tables, run:
```bash
php artisan migrate
```

### 6. Serve the Application
```bash
php artisan serve
```
- The application will be available at `http://127.0.0.1:8000`.

### 7. Testing Admin Functionality
- You can create an admin account by using **Tinker** or directly in the database, ensuring that the role is set to "admin."

## File Structure and Components
### Key Files and Folders
- **app/Http/Controllers/**: Contains the application logic, including the `AuthController`, `PageController`, and `AdminController`.
- **resources/views/**: Contains the **Blade templates** for different pages, including the user dashboard, admin statistics, reports, and authentication forms (login, registration).
- **app/Models/ActivityLog.php**: The model that handles logging of user actions.
- **database/migrations/**: Contains the migration files responsible for creating the users and activity_logs tables.

### Templating
- The project uses **Blade templates** for all the views. Blade offers a clean way to extend layouts and handle dynamic content (like user-specific data) within templates.
- The layout file `layouts/app.blade.php` is the base template that provides the navigation and includes user-specific and role-based content.

## Technologies Used
### Backend:
- **Laravel**: Provides the core framework with MVC architecture.
- **Blade**: Templating engine used to dynamically generate HTML views.
- **Eloquent ORM**: Simplifies database interactions and handles data relationships.
- **MySQL**: Database for storing users, activity logs, and admin-generated reports.
  
### Frontend:
- **HTML/CSS**: Custom CSS for a modern, clean design. 
- **JavaScript**: Used to enhance user interactivity with actions like AJAX requests for purchasing a cow and downloading files without page reload.
- **Chart.js**: A library used for generating visual reports (line charts) on user activity in the admin panel.

### Additional Features
- **User Roles and Authorization**: The application uses **Laravel’s built-in authentication** to manage roles (user and admin). Middleware restricts certain features to admins only.
- **Activity Tracking**: All major user actions (login, logout, page visits, button clicks) are stored in the database, allowing for detailed tracking of user behavior.
