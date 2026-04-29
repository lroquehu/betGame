<?php
// router.php - Para el servidor embebido de PHP

$url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Si es un archivo o directorio real, sírvelo directamente
if (is_file(__DIR__ . $url) || is_dir(__DIR__ . $url)) {
    return false;
}

// Si no, carga el index.php
require_once __DIR__ . '/index.php';
