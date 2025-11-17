<?php
declare(strict_types=1);

use DI\Container;
use Slim\Factory\AppFactory;
use Slim\Views\Twig;
use Slim\Views\TwigMiddleware;
use App\Controller\CourseController;
use App\Repository\CourseRepositoryInterface;
use App\Repository\JsonCourseRepository;
use App\Service\CourseService;

require_once __DIR__ . '/../vendor/autoload.php';

// Create Container with definitions
$container = new Container([
    // Bind interface to concrete implementation
    CourseRepositoryInterface::class => function() {
        return new JsonCourseRepository(__DIR__ . '/../data/courses.json');
    },
    
    CourseService::class => function($container) {
        return new CourseService($container->get(CourseRepositoryInterface::class));
    },
    
    // TwigMiddleware looks for 'view' key
    'view' => function() {
        return Twig::create(__DIR__ . '/../templates', ['cache' => false]);
    },
    
    Twig::class => function($container) {
        return $container->get('view');
    },
    
    CourseController::class => function($container) {
        return new CourseController(
            $container->get(CourseService::class),
            $container->get(Twig::class)
        );
    }
]);

AppFactory::setContainer($container);

// Create App
$app = AppFactory::create();

// Add Twig middleware
$app->add(TwigMiddleware::createFromContainer($app));

// Add error middleware
$app->addErrorMiddleware(true, true, true);

// Routes
$app->get('/', [CourseController::class, 'index']);
$app->get('/courses', [CourseController::class, 'index']);
$app->get('/courses/create', [CourseController::class, 'create']);
$app->post('/courses/create', [CourseController::class, 'store']);
$app->get('/courses/{id}', [CourseController::class, 'show']);
$app->get('/courses/{id}/edit', [CourseController::class, 'edit']);
$app->post('/courses/{id}/edit', [CourseController::class, 'update']);
$app->post('/courses/{id}/delete', [CourseController::class, 'delete']);

$app->run();
