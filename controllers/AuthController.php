<?php
    class AuthController {
        private $db;
        
        public function __construct() {
            $database = new Database();
            $this->db = $database->getConnection();
        }

        public function register() {
            if($_SERVER['REQUEST_METHOD'] === 'POST') {
                $user = new User($this->db);
                
                $user->nombre = $_POST['nombre'];
                $user->email = $_POST['email'];
                $user->password = $_POST['password'];
                
                if($user->register()) {
                    $_SESSION['success'] = "¡Registro exitoso! Ahora puedes iniciar sesión.";
                    header("Location: /login");
                    exit();
                } else {
                    $_SESSION['error'] = "Error al registrar. El email ya existe.";
                    header("Location: /register");
                    exit();
                }
            }
        }

        public function login() {
            if($_SERVER['REQUEST_METHOD'] === 'POST') {
                $user = new User($this->db);

                $user->email = $_POST['email'];
                $user->password = $_POST['password'];

                if($user->login()) {
                    $_SESSION['user_id'] = $user->id;
                    $_SESSION['user_nombre'] = $user->nombre;
                    $_SESSION['user_saldo'] = $user->saldo;

                    header("Location: /dashboard");
                    exit();
                } else {
                    $_SESSION['error'] = "Email o contraseña incorrectos.";
                    header("Location: /login");
                    exit();
                }
            }
        }

        public function logout() {
            $_SESSION = array();

            if (ini_get("session.use_cookies")) {
                $params = session_get_cookie_params();
                setcookie(session_name(), '', time() - 42000,
                    $params["path"], $params["domain"],
                    $params["secure"], $params["httponly"]
                );
            }

            session_destroy();

            header("Location: /");
            exit();
        }
    }
?>