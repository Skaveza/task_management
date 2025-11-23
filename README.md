#  Graduate Job Search Task Manager

A full-stack Laravel application designed to help graduates organize and track their job search activities, from applications to skill-building and networking.

![Laravel](https://img.shields.io/badge/Laravel-11.x-FF2D20?style=flat&logo=laravel)
![PHP](https://img.shields.io/badge/PHP-8.x-777BB4?style=flat&logo=php)
![TailwindCSS](https://img.shields.io/badge/Tailwind-3.x-38B2AC?style=flat&logo=tailwind-css)
![MySQL](https://img.shields.io/badge/MySQL-8.x-4479A1?style=flat&logo=mysql)

## Table of Contents

- [Features](#features)
- [Demo](#demo)
- [Tech Stack](#tech-stack)
- [Installation](#installation)
- [Usage](#usage)
- [API Documentation](#api-documentation)
- [Project Structure](#project-structure)
- [Screenshots](#screenshots)
- [Roadmap](#roadmap)
- [Contributing](#contributing)
- [License](#license)
- [Author](#author)

##  Features

### Core Functionality
-  **CRUD Operations** - Create, Read, Update, Delete tasks
-  **Task Categories** - Job Application, Skill Building, Networking, Other
-  **Status Tracking** - Mark tasks as complete/incomplete
-  **Due Date Management** - Set and track task deadlines
- **Overdue Detection** - Automatic identification of overdue tasks
-  **Search & Filter** - Find tasks by title, description, or status
-  **Statistics Dashboard** - Visual overview of task progress

### Technical Features
-  **Authentication** - Secure user registration and login (Laravel Breeze)
-  **Modern UI** - Beautiful, responsive interface with Tailwind CSS
-  **RESTful API** - JSON API endpoints for frontend integration
-  **Responsive Design** - Works seamlessly on desktop and mobile
-  **Real-time Updates** - Dynamic frontend without page refreshes
-  **Data Validation** - Server-side validation for data integrity
-  **MVC Architecture** - Clean separation of concerns

##  Demo

**Live Demo:** [Coming Soon]

**Test Credentials:**
- Email: `demo@taskmanager.com`
- Password: `password123`

##  Tech Stack

### Backend
- **Framework:** Laravel 11.x
- **Language:** PHP 8.2+
- **Database:** MySQL 8.0
- **Authentication:** Laravel Breeze
- **API:** RESTful JSON API

### Frontend
- **CSS Framework:** Tailwind CSS 3.x
- **JavaScript:** Vanilla ES6
- **Build Tool:** Vite
- **Icons:** Heroicons (SVG)

### Development Tools
- **Version Control:** Git
- **Dependency Management:** Composer, NPM
- **Local Server:** PHP Artisan Serve
- **Database Management:** phpMyAdmin

##  Installation

### Prerequisites

Ensure you have the following installed:
- PHP >= 8.2
- Composer
- Node.js & NPM
- MySQL 8.0+
- Git

### Step 1: Clone Repository

```bash
git clone https://github.com/yourusername/graduate-task-manager.git
cd graduate-task-manager
```

### Step 2: Install Dependencies

```bash
# Install PHP dependencies
composer install

# Install JavaScript dependencies
npm install
```

### Step 3: Environment Configuration

```bash
# Copy environment file
cp .env.example .env

# Generate application key
php artisan key:generate
```

### Step 4: Database Setup

Update your `.env` file with database credentials:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=task_manager
DB_USERNAME=root
DB_PASSWORD=your_password
```

Create the database:

```bash
# Using MySQL command line
mysql -u root -p
CREATE DATABASE task_manager;
EXIT;

# Or use phpMyAdmin GUI
```

### Step 5: Run Migrations

```bash
php artisan migrate
```

### Step 6: Seed Demo Data (Optional)

```bash
php artisan tinker
```

Then in Tinker:

```php
// Create demo user
\App\Models\User::create([
    'name' => 'Demo User',
    'email' => 'demo@taskmanager.com',
    'password' => bcrypt('password123')
]);

// Create sample tasks
\App\Models\Task::create([
    'user_id' => 1,
    'title' => 'Apply to Google Software Engineering Role',
    'description' => 'Submit application through careers portal',
    'type' => 'job_application',
    'due_date' => now()->addDays(7),
    'is_completed' => false
]);

\App\Models\Task::create([
    'user_id' => 1,
    'title' => 'Complete Laravel Course on Laracasts',
    'description' => 'Finish Laravel from Scratch series',
    'type' => 'skill_building',
    'due_date' => now()->addDays(14),
    'is_completed' => false
]);

exit
```

### Step 7: Start Development Servers

Open two terminal windows:

**Terminal 1 - Vite (Frontend):**
```bash
npm run dev
```

**Terminal 2 - Laravel (Backend):**
```bash
php artisan serve
```

### Step 8: Access Application

Open your browser and visit:
- **Modern Frontend:** `http://127.0.0.1:8000`
- **Dashboard:** `http://127.0.0.1:8000/dashboard` (requires login)

##  Usage

### Creating a Task

1. Navigate to the homepage
2. Fill in the "Add New Task" form:
   - **Title:** Required (e.g., "Apply to RWBuild")
   - **Description:** Optional details
   - **Type:** Select category (Job Application, Skill Building, etc.)
   - **Due Date:** Optional deadline
3. Click "Add Task"

### Managing Tasks

- **Complete Task:** Click the checkbox next to the task
- **Delete Task:** Click the red trash icon
- **Filter Tasks:** Use the All/Pending/Completed buttons
- **Search Tasks:** Type in the search bar to find specific tasks

### Viewing Statistics

The dashboard shows:
- Total number of tasks
- Completed tasks count
- Pending tasks count
- Overdue tasks count

##  API Documentation

### Base URL

```
http://127.0.0.1:8000/api
```

### Endpoints

#### Get All Tasks

```http
GET /api/tasks
```

**Response:**
```json
{
  "success": true,
  "data": [
    {
      "id": 1,
      "user_id": 1,
      "title": "Apply to Google",
      "description": "Submit application",
      "type": "job_application",
      "is_completed": false,
      "due_date": "2024-12-31",
      "created_at": "2024-11-21T10:30:00.000000Z",
      "updated_at": "2024-11-21T10:30:00.000000Z"
    }
  ]
}
```

#### Create Task

```http
POST /api/tasks
Content-Type: application/json

{
  "title": "New Task",
  "description": "Task description",
  "type": "job_application",
  "due_date": "2024-12-31"
}
```

**Response:**
```json
{
  "success": true,
  "message": "Task created successfully",
  "data": {
    "id": 2,
    "title": "New Task",
    ...
  }
}
```

#### Get Single Task

```http
GET /api/tasks/{id}
```

#### Update Task

```http
PUT /api/tasks/{id}
Content-Type: application/json

{
  "title": "Updated Title",
  "is_completed": true
}
```

#### Delete Task

```http
DELETE /api/tasks/{id}
```

#### Toggle Task Completion

```http
PATCH /api/tasks/{id}/toggle
```

#### Get Statistics

```http
GET /api/tasks-statistics
```

**Response:**
```json
{
  "success": true,
  "data": {
    "total_tasks": 10,
    "completed_tasks": 4,
    "pending_tasks": 6,
    "overdue_tasks": 2
  }
}
```

##  Project Structure

```
task-manager/
├── app/
│   ├── Http/
│   │   └── Controllers/
│   │       ├── Api/
│   │       │   └── TaskController.php    # API endpoints
│   │       ├── TaskController.php        # Web routes
│   │       └── DashboardController.php   # Dashboard logic
│   └── Models/
│       └── Task.php                      # Task model
├── database/
│   └── migrations/
│       └── *_create_tasks_table.php      # Database schema
├── resources/
│   ├── views/
│   │   ├── tasks-modern.blade.php        # Modern frontend
│   │   ├── dashboard.blade.php           # User dashboard
│   │   └── tasks/
│   │       ├── index.blade.php           # Task list
│   │       ├── create.blade.php          # Create form
│   │       └── edit.blade.php            # Edit form
│   ├── css/
│   │   └── app.css                       # Tailwind styles
│   └── js/
│       └── app.js                        # JavaScript
├── routes/
│   ├── web.php                           # Web routes
│   ├── api.php                           # API routes
│   └── auth.php                          # Authentication routes
├── .env.example                          # Environment template
├── composer.json                         # PHP dependencies
├── package.json                          # Node dependencies
└── README.md                             # This file
```

##  Screenshots
<img width="1381" height="777" alt="Screenshot 2025-11-21 at 08 52 19" src="https://github.com/user-attachments/assets/b515b087-957e-4cf6-9184-6b53cb5390f0" />

### Homepage - Modern Interface
Beautiful, clean interface for managing tasks with real-time updates.

### Statistics Dashboard
Visual overview showing task progress, completion rates, and overdue items.

### Task Management
Easy-to-use interface for creating, editing, and organizing tasks by category.

##  Roadmap

### Version 1.0 (Current)
- [x] Basic CRUD operations
- [x] Task categories
- [x] Due date tracking
- [x] Search and filter
- [x] Statistics dashboard
- [x] RESTful API

### Version 1.1 (Planned)
- [ ] Task priority levels (High, Medium, Low)
- [ ] Email notifications for overdue tasks
- [ ] Task notes and comments
- [ ] File attachments
- [ ] Export tasks to PDF/CSV
- [ ] Dark mode toggle

### Version 2.0 (Future)
- [ ] Team collaboration features
- [ ] Calendar view integration
- [ ] Mobile app (React Native)
- [ ] Kanban board view
- [ ] Task templates
- [ ] Advanced analytics and reporting

##  Contributing

Contributions are welcome! Please follow these steps:

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit your changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

### Coding Standards

- Follow PSR-12 coding standards for PHP
- Use meaningful variable and function names
- Add comments for complex logic
- Write tests for new features
- Update documentation as needed

##  License

This project is open-source and available under the [MIT License](LICENSE).

##  Author

- **GitHub:** [Skaveza](https://github.com/Skaveza)
- **LinkedIn:** [Sifa Mwachoni](https://www.linkedin.com/in/sifa-mwachoni/)


##  Support

If you have any questions or run into issues:

1. Check the [Installation](#installation) section
2. Review [API Documentation](#api-documentation)
3. Open an issue on GitHub


---

## Troubleshooting

### Common Issues

**Problem: "SQLSTATE connection refused"**
```bash
# Solution: Make sure MySQL is running
sudo service mysql start  # Linux
# OR start XAMPP/MAMP MySQL
```

**Problem: "npm run dev" not working**
```bash
# Solution: Reinstall node modules
rm -rf node_modules package-lock.json
npm install
npm run dev
```

**Problem: "Class 'Task' not found"**
```bash
# Solution: Clear and regenerate autoload files
composer dump-autoload
php artisan config:clear
```

**Problem: API returns 404**
```bash
# Solution: Clear route cache
php artisan route:clear
php artisan route:list --path=api  # Verify routes exist
```

**Problem: Styles not loading**
```bash
# Solution: Make sure Vite dev server is running
npm run dev
# Keep this terminal open while developing
```

### Debug Mode

Enable debug mode in `.env` for detailed error messages:

```env
APP_DEBUG=true
```

**Important:** Set to `false` in production!

---

##  Additional Resources

- [Laravel Documentation](https://laravel.com/docs)
- [Tailwind CSS Documentation](https://tailwindcss.com/docs)
- [Laravel Breeze Documentation](https://laravel.com/docs/starter-kits)
- [RESTful API Design Best Practices](https://restfulapi.net/)
- [Laracasts - Laravel from Scratch](https://laracasts.com/series/laravel-from-scratch)

---

**Last Updated:** November 21, 2024  
**Version:** 1.0.0
