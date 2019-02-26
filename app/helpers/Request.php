<?php
class Request{
    public function responseJSON($data){
        header('Content-Type: application/json');
        return json_encode($data);
    }
}
?>
