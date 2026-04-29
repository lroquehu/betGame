<?php
    class AuthMiddleware {
        public static function checkAuth() {
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }

            if (!isset($_SESSION['user_id'])) {
                // Si no hay sesión, destruir rastro y mandar a la landing
                header("Location: /");
                exit();
            }

            header("Cache-Control: no-cache, no-store, must-revalidate");
            header("Pragma: no-cache");
            header("Expires: 0");
        }

        public static function redirectIfLoggedIn() {
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }

            if (isset($_SESSION['user_id'])) {
                header("Location: /dashboard");
                exit();
            }
        }
    }