<?php
require_once(__DIR__.'/../class/BaseResponse.php');

class User  extends BaseResponse{

        // Connection
    private $conn;

        // Table
    private $db_table = "users";

        // Columns
    public $id;
    public $name;
    public $email;
    public $phone;
    public $password;
    public $role;
    public $status;
    public $deleteStatus;
    public $createdAt;
    public $updatedAt;

        // Db connection
    public function __construct($db){
        $this->conn = $db;
    }

        // GET ALL
    public function getUsers(){
        $sqlQuery = "SELECT id, name, email, phone, role, status,createdAt,updatedAt FROM " . $this->db_table . "WHERE deleteStatus=0";
        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->execute();
        return $stmt;
    }

        // CREATE
    public function createUser(){
        $sqlQuery = "INSERT INTO
        ". $this->db_table ."
        SET
        name = :name, 
        email = :email, 
        phone = :phone, 
        status = :status, 
        role = :role, 
        password = :password";
        
        $stmt = $this->conn->prepare($sqlQuery);
        
            // sanitize
        $this->name=htmlspecialchars(strip_tags($this->name));
        $this->email=htmlspecialchars(strip_tags($this->email));
        $this->phone=htmlspecialchars(strip_tags($this->phone));
        $this->status=htmlspecialchars(strip_tags($this->status));
        $this->role=htmlspecialchars(strip_tags($this->role));
        $this->password=htmlspecialchars(strip_tags($this->password));
        
            // bind data
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":phone", $this->phone);
        $stmt->bindParam(":status", $this->status);
        $stmt->bindParam(":role", $this->role);
        $stmt->bindParam(":password", $this->password);
        
        if($stmt->execute()){
         return true;
     }
     return false;
 }

        // UPDATE
 public function getSingleUser(){
    $sqlQuery = "SELECT
    id, 
    name, 
    email, 
    phone, 
    status, 
    role, 
    status
    FROM
    ". $this->db_table ."
    WHERE 
    id = ?
    LIMIT 0,1";

    $stmt = $this->conn->prepare($sqlQuery);

    $stmt->bindParam(1, $this->id);

    $stmt->execute();

    $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);

    $this->name = $dataRow['name'];
    $this->email = $dataRow['email'];
    $this->phone = $dataRow['phone'];
    $this->role = $dataRow['role'];
    $this->status = $dataRow['status'];
}        

        // UPDATE
public function updateUser(){
    $sqlQuery = "UPDATE
    ". $this->db_table ."
    SET
    name = :name, 
    email = :email, 
    phone = :phone, 
    status = :status, 
    role = :role, 
    password = :password
    WHERE 
    id = :id";

    $stmt = $this->conn->prepare($sqlQuery);

    $this->name=htmlspecialchars(strip_tags($this->name));
    $this->email=htmlspecialchars(strip_tags($this->email));
    $this->phone=htmlspecialchars(strip_tags($this->phone));
    $this->status=htmlspecialchars(strip_tags($this->status));
    $this->role=htmlspecialchars(strip_tags($this->role));
    $this->password=htmlspecialchars(strip_tags($this->password));
    $this->updatedAt=htmlspecialchars(strip_tags($this->updatedAt));
    $this->id=htmlspecialchars(strip_tags($this->id));

            // bind data
    $stmt->bindParam(":name", $this->name);
    $stmt->bindParam(":email", $this->email);
    $stmt->bindParam(":phone", $this->phone);
    $stmt->bindParam(":status", $this->status);
    $stmt->bindParam(":role", $this->role);
    $stmt->bindParam(":password", $this->password);
    $stmt->bindParam(":updatedAt", $this->updatedAt);
    $stmt->bindParam(":id", $this->id);

    if($stmt->execute()){
     return true;
 }
 return false;
}        //soft Delete UPDATE
public function softDeleteUser(){
    $sqlQuery = "UPDATE
    ". $this->db_table ."
    SET
    deleteStatus = :deleteStatus
    WHERE 
    id = :id";

    $stmt = $this->conn->prepare($sqlQuery);

    $this->deleteStatus=htmlspecialchars(strip_tags($this->deleteStatus));
    $this->id=htmlspecialchars(strip_tags($this->id));

            // bind data
    $stmt->bindParam(":deleteStatus", $this->deleteStatus);
    $stmt->bindParam(":id", $this->id);

    if($stmt->execute()){
     return true;
 }
 return false;
}

        // DELETE
function deleteUser(){
    $sqlQuery = "DELETE FROM " . $this->db_table . " WHERE id = ?";
    $stmt = $this->conn->prepare($sqlQuery);

    $this->id=htmlspecialchars(strip_tags($this->id));

    $stmt->bindParam(1, $this->id);

    if($stmt->execute()){
        return true;
    }
    return false;
}

}
?>

