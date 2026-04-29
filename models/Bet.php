<?php
    class Bet {
        private $conn;
        private $table = "bets";
        public $id, $user_id, $monto, $equipo_seleccionado, $resultado, $ganancia;

        public function __construct($db) { $this->conn = $db; }

        public function registrarApuesta() {
            $query = "INSERT INTO " . $this->table . " 
                    (user_id, monto, equipo_seleccionado, resultado, ganancia) 
                    VALUES (:user_id, :monto, :equipo, :resultado, :ganancia)";
            $stmt = $this->conn->prepare($query);
            
            $stmt->bindParam(":user_id", $this->user_id);
            $stmt->bindParam(":monto", $this->monto);
            $stmt->bindParam(":equipo", $this->equipo_seleccionado);
            $stmt->bindParam(":resultado", $this->resultado);
            $stmt->bindParam(":ganancia", $this->ganancia);
            return $stmt->execute();
        }

        public function getHistorialByUser($userId, $limit = 20) {
            $query = "SELECT * FROM " . $this->table . " 
                    WHERE user_id = :user_id 
                    ORDER BY fecha_apuesta DESC 
                    LIMIT :limit";
            
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(":user_id", $userId);
            $stmt->bindParam(":limit", $limit, PDO::PARAM_INT);
            $stmt->execute();
            
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public function getEstadisticas($userId) {
            $query = "SELECT 
                        COUNT(*) as total_apuestas,
                        SUM(monto) as total_apostado,
                        SUM(ganancia) as total_ganado,
                        COUNT(CASE WHEN ganancia > 0 THEN 1 END) as apuestas_ganadas
                    FROM " . $this->table . " 
                    WHERE user_id = :user_id";
            
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(":user_id", $userId);
            $stmt->execute();
            
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }
    }
?>