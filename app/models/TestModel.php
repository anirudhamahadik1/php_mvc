<?php
class TestModel{
    public $id = null;
    public $name = null;
    public $email = null;
    public $message = null;

    public function create(){
        try{
            $conn = new PDO("mysql:host=" . $GLOBALS["DB_HOST"] . ";dbname=" . $GLOBALS["DB_NAME"], $GLOBALS["DB_USERNAME"], $GLOBALS["DB_PASSWORD"]);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $conn->prepare("INSERT INTO contact (name, email, message) VALUES (:name, :email, :message)");
            $stmt->bindParam(":name", $this->name);
            $stmt->bindParam(":email", $this->email);
            $stmt->bindParam(":message", $this->message);
            $stmt->execute();

            return array(
                "status" => "success",
                "message" => "Successfully created record"
            );
        }
        catch(PDOEception $e){
            return array(
                "status" => "failed",
                "message" => $e->getMessage()
            );
        }
    }

    public function read(){
        try{
            $conn = new PDO("mysql:host=" . $GLOBALS["DB_HOST"] . ";dbname=" . $GLOBALS["DB_NAME"], $GLOBALS["DB_USERNAME"], $GLOBALS["DB_PASSWORD"]);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $conn->prepare("SELECT * FROM contact WHERE id = :id");
            $stmt->bindParam(":id", $this->id);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $result = $stmt->fetchAll();

            return array(
                "status" => "success",
                "message" => "Succeccfully fetched record",
                "data" => $result
            );
        }
        catch(PDOException $e){
            return array(
                "status" => "failed",
                "message" => $e->getMessage()
            );
        }
    }
}
?>