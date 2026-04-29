<?php
// api/index.php - Punto de entrada para API REST

session_start();
header('Content-Type: application/json');

require_once __DIR__ . '/../config/database.php';

// Autocargador para controllers y models
spl_autoload_register(function ($class) {
    $dirs = ['controllers', 'models'];
    foreach ($dirs as $dir) {
        $file = __DIR__ . "/../$dir/$class.php";
        if (file_exists($file)) {
            require_once $file;
            return;
        }
    }
});

// Obtener la ruta solicitada
$request_uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$request_method = $_SERVER['REQUEST_METHOD'];

// Extraer la ruta del API (sin /api/)
$api_route = str_replace('/api', '', $request_uri);

// Enrutamiento del API
switch ($api_route) {
    case '/apostar':
        if ($request_method === 'POST') {
            if (!isset($_SESSION['user_id'])) {
                http_response_code(401);
                echo json_encode(['success' => false, 'message' => 'No autenticado']);
                exit;
            }
            
            $bet = new BetController();
            $bet->realizarApuesta();
        } else {
            http_response_code(405);
            echo json_encode(['success' => false, 'message' => 'Método no permitido']);
        }
        break;

    default:
        http_response_code(404);
        echo json_encode(['success' => false, 'message' => 'Ruta API no encontrada']);
        break;
}
