# User Management System

## Overview

This project demonstrates a basic User Management System using Core PHP for the backend RESTful API and a frontend application that interacts with this API. It includes a MySQL database for storing user information.

## Project File Structure

- **`index.php`**: The main entry point for API requests. Handles CRUD operations based on HTTP methods.
- **`UserController.php`**: Contains the logic for interacting with the database and performing CRUD operations.
- **`db.php`**: Contains the database connection configuration.
- **`index.html`**: Frontend application that interacts with the API. Provides forms for adding, updating, and deleting users, and a table to list users.

## Setup Instructions

### Prerequisites

- PHP
- MySQL
- Local Server (in my case XAMPP)
- Git

### Database Setup

1. Open MySQL command-line client or phpMyAdmin.
2. Create the `user_management` database
3. Execute the SQL commands in `user_management.sql` to create the `users` table.

### Project Setup Instructions

1. Clone the repository:
    git clone https://github.com/drheartcoder/UserManagementPHP.git

2. Set up the database:
    - Create a MySQL database named `user_management`.
    - Execute the SQL commands in `user_management.sql` to create the `users` table.

3. Configure the database connection:
    - Update the `db.php` file with your database credentials.

4. Start the Local server

5. Change `localURL` variable in `index.html`according to url path of the project.

6. Open `index.html` in browser to use the frontend application.

## Decisions and Assumptions

- The password is hashed using `bcrypt` before storing it in the database.
- The frontend uses vanilla JavaScript to interact with the backend API.