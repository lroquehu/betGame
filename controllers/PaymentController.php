<?php
class PaymentController {
    private $db;
    
    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
    }

    public function recargar() {
        $data = json_decode(file_get_contents("php://input"), true);
        
        $userId = $_SESSION['user_id'];
        $monto = floatval($data['monto']);
        
        // Aquí integrarías Stripe o cualquier pasarela de pago
        // Por ahora simulamos el pago exitoso
        
        $user = new User($this->db);
        $userData = $user->getUserById($userId);
        
        $nuevoSaldo = $userData['saldo'] + $monto;
        $user->actualizarSaldo($userId, $nuevoSaldo);
        
        $_SESSION['user_saldo'] = $nuevoSaldo;
        
        echo json_encode([
            'success' => true,
            'nuevoSaldo' => $nuevoSaldo,
            'message' => 'Recarga exitosa'
        ]);
    }
}
?>