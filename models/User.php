<?php
class User {
    private $conn;
    private $table = "users";

    public $id;
    public $nombre;
    public $email;
    public $password;
    public $saldo;
    public $bono_bienvenida;
    public $fecha_registro;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function register() {
        $query = "INSERT INTO " . $this->table . " 
                  (nombre, email, password, saldo, bono_bienvenida) 
                  VALUES (:nombre, :email, :password, 10.00, 1)";
        
        $stmt = $this->conn->prepare($query);
        
        $hashed_password = password_hash($this->password, PASSWORD_DEFAULT);
        
        $stmt->bindParam(":nombre", $this->nombre);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":password", $hashed_password);
        
        if($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function login() {
        $query = "SELECT * FROM " . $this->table . " WHERE email = :email LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":email", $this->email);
        $stmt->execute();
        
        if($stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if(password_verify($this->password, $row['password'])) {
                $this->id = $row['id'];
                $this->nombre = $row['nombre'];
                $this->email = $row['email'];
                $this->saldo = $row['saldo'];
                $this->bono_bienvenida = $row['bono_bienvenida'];
                return true;
            }
        }
        return false;
    }

    public function actualizarSaldo($userId, $nuevoSaldo) {
        $query = "UPDATE " . $this->table . " SET saldo = :saldo WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":saldo", $nuevoSaldo);
        $stmt->bindParam(":id", $userId);
        return $stmt->execute();
    }

    public function getUserById($id) {
        $query = "SELECT * FROM " . $this->table . " WHERE id = :id LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        
        if($stmt->rowCount() > 0) {
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }
        return null;
    }

    public function getRanking() {
        $query = "SELECT nombre, saldo FROM " . $this->table . " ORDER BY saldo DESC LIMIT 5";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>