# 📚 Course Manager - Web Application

**Course Manager** adalah aplikasi web manajemen kursus yang dibangun dengan PHP, Slim Framework, dan Bootstrap. Aplikasi ini menyediakan antarmuka web yang user-friendly untuk mengelola data kursus dengan fitur CRUD (Create, Read, Update, Delete) lengkap.

## ✨ Features

- ✅ **Web GUI** - Interface web yang modern dan responsive
- ✅ **CRUD Operations** - Create, Read, Update, Delete courses
- ✅ **Persistent Storage** - Data tersimpan dalam JSON file
- ✅ **Form Validation** - Client-side dan server-side validation
- ✅ **Responsive Design** - Mobile-friendly dengan Bootstrap 5
- ✅ **Clean Architecture** - Separation of concerns (Entity, Repository, Service, Controller)
- ✅ **Unit Tests** - Comprehensive PHPUnit tests
- ✅ **CLI Support** - Command-line interface masih tersedia

## 🛠️ Tech Stack

- **PHP** 8.0+
- **Slim Framework** 4.x - Micro-framework untuk routing
- **Twig** 3.x - Template engine
- **Bootstrap** 5.3 - CSS framework
- **PHP-DI** 7.x - Dependency injection container
- **PHPUnit** 11.x - Testing framework

## 📋 Requirements

- PHP >= 8.0
- Composer
- Web server (Apache/Nginx) atau PHP built-in server

## 🚀 Installation

### 1. Install Dependencies

```bash
composer install
```

### 2. Setup Data Directory

Windows:
```powershell
New-Item -ItemType Directory -Force -Path data
Set-Content -Path "data\courses.json" -Value "[]"
```

Linux/Mac:
```bash
mkdir -p data && echo "[]" > data/courses.json
```

### 3. Start Web Server

**Option A: PHP Built-in Server (Development)**

```bash
php -S localhost:8080 -t public
```

Buka browser: http://localhost:8080

**Option B: Apache/Nginx**

Arahkan document root ke folder `public/`

## 📖 Usage

### Web Interface

1. **View All Courses** - Buka http://localhost:8080/courses
2. **Create Course** - Klik "Add New Course" atau akses `/courses/create`
3. **View Details** - Klik "View" pada course card
4. **Edit Course** - Klik "Edit" pada course card atau detail page
5. **Delete Course** - Klik "Delete" dan konfirmasi

### CLI Interface (Masih Tersedia)

```bash
# List all courses
php bin/console list

# Create new course
php bin/console create "Course Name" "Description"

# Get course by ID
php bin/console get <course-id>

# Delete course
php bin/console delete <course-id>

# Help
php bin/console help
```

## 🧪 Run Tests

```bash
# Run all tests
./vendor/bin/phpunit

# Run with details
./vendor/bin/phpunit --testdox

# Run with coverage (requires Xdebug)
./vendor/bin/phpunit --coverage-html coverage
```

**Test Results:**
- ✅ 21 tests
- ✅ 31 assertions
- ✅ 100% pass rate

## 📁 Project Structure

```
pertemuan2/
├── public/                  # Web root
│   ├── index.php           # Application entry point
│   ├── .htaccess           # Apache rewrite rules
│   └── assets/
│       ├── css/
│       │   └── style.css   # Custom styles
│       └── js/
│           └── app.js      # JavaScript functionality
├── src/
│   ├── Controller/         # HTTP request handlers
│   │   └── CourseController.php
│   ├── Entity/             # Domain models
│   │   └── Course.php
│   ├── Repository/         # Data access layer
│   │   ├── CourseRepositoryInterface.php
│   │   ├── InMemoryCourseRepository.php
│   │   └── JsonCourseRepository.php
│   └── Service/            # Business logic
│       └── CourseService.php
├── templates/              # Twig templates
│   ├── layout.html.twig    # Base layout
│   ├── error.html.twig     # Error page
│   └── courses/
│       ├── index.html.twig  # List view
│       ├── create.html.twig # Create form
│       ├── edit.html.twig   # Edit form
│       └── show.html.twig   # Detail view
├── tests/                  # PHPUnit tests
├── data/                   # JSON storage
│   └── courses.json
├── bin/
│   └── console            # CLI script
├── vendor/                # Composer dependencies
├── composer.json
└── README.md
```

## 🎨 Screenshots

### Course List Page
- Grid view dengan course cards
- Quick actions: View, Edit, Delete
- Responsive design

### Create/Edit Form
- Form validation
- User-friendly input fields
- Error handling

### Course Detail
- Complete course information
- Action buttons (Edit, Delete)
- Breadcrumb navigation

## 🔧 Configuration

### Routing

Routes didefinisikan di `public/index.php`:

```php
$app->get('/courses', [CourseController::class, 'index']);
$app->get('/courses/create', [CourseController::class, 'create']);
$app->post('/courses/create', [CourseController::class, 'store']);
$app->get('/courses/{id}', [CourseController::class, 'show']);
$app->get('/courses/{id}/edit', [CourseController::class, 'edit']);
$app->post('/courses/{id}/edit', [CourseController::class, 'update']);
$app->post('/courses/{id}/delete', [CourseController::class, 'delete']);
```

### Dependency Injection

Dependencies dikelola oleh PHP-DI container di `public/index.php`:

```php
$container->set('courseRepository', function() {
    return new JsonCourseRepository(__DIR__ . '/../data/courses.json');
});

$container->set('courseService', function($container) {
    return new CourseService($container->get('courseRepository'));
});
```

## 🧩 API Endpoints

| Method | Endpoint | Description |
|--------|----------|-------------|
| GET | `/courses` | List all courses |
| GET | `/courses/create` | Show create form |
| POST | `/courses/create` | Store new course |
| GET | `/courses/{id}` | Show course details |
| GET | `/courses/{id}/edit` | Show edit form |
| POST | `/courses/{id}/edit` | Update course |
| POST | `/courses/{id}/delete` | Delete course |

## 🎓 Architecture

Aplikasi ini menggunakan **Clean Architecture** dengan layer:

1. **Entity Layer** - Domain models (Course)
2. **Repository Layer** - Data access abstraction
3. **Service Layer** - Business logic
4. **Controller Layer** - HTTP request handling
5. **View Layer** - Presentation (Twig templates)

**Benefits:**
- ✅ Separation of Concerns
- ✅ Testability
- ✅ Maintainability
- ✅ Flexibility (mudah ganti storage backend)

## 🧪 Testing

Tests mencakup:

### Repository Tests
- ✅ Save and find operations
- ✅ List all courses
- ✅ Update course
- ✅ Delete course
- ✅ Clear all data

### Service Tests
- ✅ Create course with validation
- ✅ Update course with validation
- ✅ Retrieve course
- ✅ List courses
- ✅ Delete course

### Utility Tests
- ✅ Word count functionality
- ✅ Kilometer to miles conversion
- ✅ Date manipulation
- ✅ Hash functions

## 🚀 Deployment

### Production Setup

1. Set Twig cache enabled:

```php
$container->set('view', function() {
    return Twig::create(__DIR__ . '/../templates', [
        'cache' => __DIR__ . '/../var/cache/twig'
    ]);
});
```

2. Disable error middleware display:

```php
$app->addErrorMiddleware(false, true, true);
```

3. Setup proper file permissions:

```bash
chmod -R 755 public/
chmod -R 775 data/
chmod -R 775 var/cache/
```

## 🤝 Contributing

1. Fork the repository
2. Create feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to branch (`git push origin feature/AmazingFeature`)
5. Open Pull Request

## 📝 License

This project is open source and available under the MIT License.

## 👨‍💻 Author

Course Manager - PPL Project
POLTEK SSN - Semester 7

## 🙏 Acknowledgments

- Slim Framework - https://www.slimframework.com/
- Bootstrap - https://getbootstrap.com/
- Twig - https://twig.symfony.com/
- PHPUnit - https://phpunit.de/

---

**Happy Coding! 🚀**

