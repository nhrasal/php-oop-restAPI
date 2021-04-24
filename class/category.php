<?php
require_once(__DIR__.'/../class/BaseResponse.php');

class Category  extends BaseResponse{

        // Connection
    private $conn;

        // Table
    private $db_table = "categories";

        // Columns
    public $id;
    public $name;
    public $delete_status;
    public $createdAt;
    public $updatedAt;


        // Db connection
    public function __construct($db){
        $this->conn = $db;
    }

        // GET ALL
    public function getCategories(){
        $sqlQuery = "SELECT id, name, delete_status, createdAt FROM " . $this->db_table . "";
        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->execute();
        return $stmt;
    }

        // CREATE
    public function createCategory(){
        $sqlQuery = "INSERT INTO
        ". $this->db_table ."
        SET
        name = :name";
        $stmt = $this->conn->prepare($sqlQuery);
            // sanitize
        $this->name=htmlspecialchars(strip_tags($this->name));
            // bind data
        $stmt->bindParam(":name", $this->name);
        if($stmt->execute()){
           return true;
       }
       return false;
   }


        // UPDATE
  public function getSingleCategory(){
    $sqlQuery = "SELECT
    id, 
    name, 
    delete_status, 
    createdAt
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
    $this->delete_status = $dataRow['delete_status'];
    $this->createdAt = $dataRow['createdAt'];
}        

        // UPDATE
public function updateCategory(){
    $sqlQuery = "UPDATE
    ". $this->db_table ."
    SET
    name = :name, 
    delete_status = :delete_status, 
    WHERE 
    id = :id";

    $stmt = $this->conn->prepare($sqlQuery);

    $this->name=htmlspecialchars(strip_tags($this->name));
    $this->createdAt=htmlspecialchars(strip_tags($this->createdAt));
    $this->updatedAt=htmlspecialchars(strip_tags($this->updatedAt));
    $this->id=htmlspecialchars(strip_tags($this->id));

            // bind data
    $stmt->bindParam(":name", $this->name);
    $stmt->bindParam(":updatedAt", $this->updatedAt);
    $stmt->bindParam(":created", $this->created);
    $stmt->bindParam(":id", $this->id);

    if($stmt->execute()){
       return true;
   }
   return false;
}

        // SOFT DELETE
function softDeleteCategory(){
    $sqlQuery = "UPDATE
    ". $this->db_table ."
        SET
        delete_status = :delete_status, 
        WHERE 
        id = :id";
    $stmt = $this->conn->prepare($sqlQuery);
    $this->delete_status=1;
    $this->id=htmlspecialchars(strip_tags($this->id));
    $stmt->bindParam(":id", $this->id);

    if($stmt->execute()){
        return true;
    }
    return false;
}      

 // Hard DELETE
function deleteCategory(){
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

