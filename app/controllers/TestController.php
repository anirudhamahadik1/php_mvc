<?php
require __DIR__ . "/../helpers/Request.php";
require __DIR__ . "/../models/TestModel.php";

class TestController{
    private $request;
    public function __construct(){
        $this->request = new Request;
    }

    public function testFunction(){
        echo "This is Test Function";
    }

    public function testCreate(){
        $testModel = new TestModel;
        $testModel->name = $_REQUEST["name"];
        $testModel->email = $_REQUEST["email"];
        $testModel->message = $_REQUEST["message"];
        $result = $testModel->create();

        echo $this->request->responseJSON($result);
    }

    public function testRead(){
        $testModel = new TestModel;
        $testModel->id = $_REQUEST["id"];
        $result = $testModel->read();

        echo $this->request->responseJSON($result);
    }
}
?>