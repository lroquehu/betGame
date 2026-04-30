<?php
session_start();
require_once __DIR__ . '/config/database.php';

// Autocargador simplificado para evitar fallos de rutas
spl_autoload_register(function ($class) {
    $dirs = ['controllers', 'models', 'middleware'];
    foreach ($dirs as $dir) {
        $file = __DIR__ . "/$dir/$class.php";
        if (file_exists($file)) {
            require_once $file;
            return;
        }
    }
});

// Capturar la ruta actual
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$method = $_SERVER['REQUEST_METHOD'];

// Lógica de Enrutamiento Directo
switch ($uri) {
    case '/':
    case '/home':
        require_once __DIR__ . '/views/home.php';
        break;

    case '/login':
        require_once __DIR__ . '/middleware/AuthMiddleware.php';
        AuthMiddleware::redirectIfLoggedIn();

        $auth = new AuthController();
        if ($method === 'POST') {
            $auth->login();
        } else {
            require_once __DIR__ . '/views/login.php';
        }
        break;

    case '/register':
        require_once __DIR__ . '/middleware/AuthMiddleware.php';
        AuthMiddleware::redirectIfLoggedIn();

        $auth = new AuthController();
        if ($method === 'POST') {
            $auth->register();
        } else {
            require_once __DIR__ . '/views/register.php';
        }
        break;

    case '/dashboard':
        require_once __DIR__ . '/middleware/AuthMiddleware.php';
        AuthMiddleware::checkAuth();

        $database = new Database();
        $db = $database->getConnection();
        $userModel = new User($db);
        $data = $userModel->getUserById($_SESSION['user_id']);
        $_SESSION['user_saldo'] = $data['saldo'];

        require_once __DIR__ . '/views/dashboard.php';
        break;

    case '/perfil':
        if (!isset($_SESSION['user_id'])) { header("Location: /login"); exit(); }
        require_once __DIR__ . '/views/perfil.php'; // Debes crear esta vista
        break;

    case '/configuracion':
        if (!isset($_SESSION['user_id'])) { header("Location: /login"); exit(); }
        require_once __DIR__ . '/views/configuracion.php'; // Debes crear esta vista
        break;

    case '/logout':
        $auth = new AuthController();
        $auth->logout();
        break;

    // Rutas para la API del Juego
    case '/api/apostar':
        if ($method === 'POST') {
            $bet = new BetController();
            $bet->realizarApuesta();
        }
        break;

    default:
        // Servir archivos estáticos (CSS, JS, Imágenes)
        $file = __DIR__ . $uri;
        if (file_exists($file) && is_file($file)) {
            $ext = pathinfo($file, PATHINFO_EXTENSION);
            $mimes = ['css'=>'text/css', 'js'=>'application/javascript', 'jpg'=>'image/jpeg', 'png'=>'image/png'];
            if(isset($mimes[$ext])) header("Content-Type: " . $mimes[$ext]);
            readfile($file);
            exit;
        }
        http_response_code(404);
        echo "404 - No encontrado";
        break;
}