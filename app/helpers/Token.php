<?php
use \Firebase\JWT\JWT;

class Token{
    public function generateAPIToken($data){
        $key = $GLOBALS["TOKEN_KEY"];
        $payload = array(
            "iss" => $_SERVER['PHP_SELF'],
            "sub" => "authentication",
            "aud" => "web/app",
            "iat" => date('Y-m-d h:i:s'),
            "data" => $data
        );
        return JWT::encode($payload, $key);
    }

    public function verifyAPIToken(){
        try{
            $key = $GLOBALS['TOKEN_KEY'];
            $decoded = JWT::decode($_REQUEST["token"], $key, array('HS256'));

            if($decoded){
                return true;
            }
        }
        catch(Exception $e){
            return false;
        }
    }

    public function getDecodedData(){
        $key = $GLOBALS['TOKEN_KEY'];
        $decoded = JWT::decode($_REQUEST["token"], $key, array('HS256'));

        return $decoded->data;
    }
}
?>