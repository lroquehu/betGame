<?php
// roquebet/controllers/BetController.php
class BetController {
    private $db;
    
    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
    }

    public function realizarApuesta() {
        $data = json_decode(file_get_contents("php://input"), true);
        $userId = $_SESSION['user_id'];
        $equipoApostado = $data['equipo'];
        $monto = floatval($data['monto']);

        $user = new User($this->db);
        $userData = $user->getUserById($userId);

        if($userData['saldo'] < $monto) {
            echo json_encode(['success' => false, 'message' => 'Saldo insuficiente']);
            return;
        }

        // 1. Determinar resultado de la ruleta
        $opciones = ['LOCAL', 'VISITANTE', 'EMPATE'];
        $resultadoFinal = $opciones[array_rand($opciones)];
        
        // 2. Calcular Ganancia según tus reglas
        $ganancia = 0;
        if ($resultadoFinal === 'EMPATE') {
            $ganancia = $monto / 2; // Recupera la mitad
        } elseif ($resultadoFinal === $equipoApostado) {
            $ganancia = $monto * 2; // Gana el doble
        } else {
            $ganancia = 0; // Pierde todo
        }

        // 3. Actualizar Saldo en DB
        $nuevoSaldo = $userData['saldo'] - $monto + $ganancia;
        $user->actualizarSaldo($userId, $nuevoSaldo);
        $_SESSION['user_saldo'] = $nuevoSaldo;

        // 4. Registrar en historial
        $bet = new Bet($this->db);
        $bet->user_id = $userId;
        $bet->monto = $monto;
        $bet->equipo_seleccionado = $equipoApostado;
        $bet->resultado = $resultadoFinal;
        $bet->ganancia = $ganancia;
        $bet->registrarApuesta();

        echo json_encode([
            'success' => true,
            'resultado' => $resultadoFinal,
            'ganancia' => $ganancia,
            'nuevoSaldo' => $nuevoSaldo
        ]);
    }
}