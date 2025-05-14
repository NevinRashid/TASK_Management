# Task management system

## System analysis
We have a task management system, so we need several entities:
1) Task, which has the properties :
     id(primary_key), title, description, start_date, due_date, status_id (Foreign key), assigned_by (Foreign key), actual_start_date, actual_end_date and timestamps.
2) Status, which has the properties :
    id (primary_key), name, description, color and timestamps.
3) User, which has the property :
     id (primary_key), name, email, password, role and timestamps.
- **The relationships between the entities we have are**:
1) The relationship between the task and the status is (one to many). Each task is subordinate to only one status, but a status can be followed by more than one task.
2) The relationship between the task and the user, There are two relationships:
    1- one to many: It represents the relationship between task creators and the task, as each task is created by only one user, but a user can create more than one task.
    2- many to many: It represents the relationship between the people who carry out the task and the task, where each task can be carried out by more than one user, and the user can also carry out more than one task**(Here it was considered that one task can be carried out by an entire team and not one person)**.

### Description
This project is a **Task Management** built using **Laravel 12**. It allows users (only the project_manager, the admin, and the task creator) to perform **CRUD operations** (Create, Read, Update, Delete) on the task, and it also allows only the project_manager and the admin to perform CRUD operations (Create, Update, Read, Delete) on the status.
CRUD operations are also applied to the user. Only the admin and project_manager can add a new user to the system. As for modifying, deleting, and showing all users, only the project_manager may do so. Only the project_manager has the right to define the user role, and only the project_manager and the user who owns the account can see the process of seeing a user's information.
The Sanctum package was used for authentication in the API.

### Key Features:
- **CRUD Operations**: Create, read, update, and delete task in the system .
- **CRUD Operations**: Create, read, update, and delete status in the system .
- **CRUD Operations**: Create, read, update, and delete user in the system .
- **Form Requests**: Validation is handled by custom form request classes.
- **Seeders**: Populate the database with initial data for testing and development.

### Technologies Used:
- **Laravel 12**
- **PHP**
- **MySQL**
- **XAMPP** (for local development environment)
- **Composer** (PHP dependency manager)


---

## Installation

### Prerequisites

Ensure you have the following installed on your machine:
- **XAMPP**: For running MySQL and Apache servers locally.
- **Composer**: For PHP dependency management.
- **PHP**: Required for running Laravel.
- **MySQL**: Database for the project

### Steps to Run the Project

1. Clone the Repository  
   ```bash
   git clone https://github.com/NevinRashid/TASK_Management.git
2. Navigate to the Project Directory
   ```bash
   cd task_management
3. Install Dependencies
   ```bash
   composer install
4. Create Environment File
   ```bash
   cp .env.example .env
   Update the .env file with your database configuration (MySQL credentials, database name, etc.).
5. Generate Application Key
    ```bash
    php artisan key:generate
6. Run Migrations
    ```bash
    php artisan migrate
7. Seed the Database
    ```bash
    php artisan db:seed
8. Run the Application
    ```bash
    php artisan serve

## API Documentation
You can find and test all API endpoints in the provided Postman collection.

### Postman Collection:
- https://www.postman.com/nevinrashid/my-wokspace/collection/usvcy7c/task-management
