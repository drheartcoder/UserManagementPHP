<?php
include_once 'db.php';

class UserController {
    private $conn;
    private $table_name = "users";

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getUsers() {
        $query = "SELECT id, name, email, dob FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function getUser($id) {
        $query = "SELECT id, name, email, dob FROM " . $this->table_name . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $id);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            return $row;
        } else {
            return null;
        }
    }

    public function createUser($data) {
        $query = "INSERT INTO " . $this->table_name . " SET name=:name, email=:email, password=:password, dob=:dob";
        $stmt = $this->conn->prepare($query);

        // Hash the password
        $hashed_password = password_hash($data['password'], PASSWORD_BCRYPT);

        // bind values
        $stmt->bindParam(":name", $data['name']);
        $stmt->bindParam(":email", $data['email']);
        $stmt->bindParam(":password", $hashed_password);
        $stmt->bindParam(":dob", $data['dob']);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function updateUser($id, $data) {
        if (!empty($data['password'])) {
            $query = "UPDATE " . $this->table_name . " SET name=:name, email=:email, password=:password, dob=:dob WHERE id=:id";
            $stmt = $this->conn->prepare($query);

            // Hash the password
            $hashed_password = password_hash($data['password'], PASSWORD_BCRYPT);

            // bind values
            $stmt->bindParam(":id", $id);
            $stmt->bindParam(":name", $data['name']);
            $stmt->bindParam(":email", $data['email']);
            $stmt->bindParam(":password", $hashed_password);
            $stmt->bindParam(":dob", $data['dob']);
        } else {
            $query = "UPDATE " . $this->table_name . " SET name=:name, email=:email, dob=:dob WHERE id=:id";
            $stmt = $this->conn->prepare($query);

            // bind values
            $stmt->bindParam(":id", $id);
            $stmt->bindParam(":name", $data['name']);
            $stmt->bindParam(":email", $data['email']);
            $stmt->bindParam(":dob", $data['dob']);
        }

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteUser($id) {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(1, $id);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
?>