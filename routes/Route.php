<?php
class Route{
    /*
        * $routes is a multidimentional array.
        * It contains all the routes required by the application.
        * The key of this array defines the URL path. Also each URL path has assigned to its controller, method and authcheck.
        * You can add your own routes to this array.
    */
    private $routes = array(
        "test" => array(
            "controller" => "TestController",
            "method" => "testFunction",
            "authcheck" => false
        ),
        "test/create" => array(
            "controller" => "TestController",
            "method" => "testCreate",
            "authcheck" => false
        ),
        "test/read" => array(
            "controller" => "TestController",
            "method" => "testRead",
            "authcheck" => false
        ),
        "test/readfetchapi" => array(
            "controller" => "TestController",
            "method" => "testReadFetchAPI",
            "authcheck" => false
        )
    );

    public function matchRoute($route){
        if(array_key_exists($route,$this->routes)){
            $controller = $this->routes[$route]['controller'];
            $method = $this->routes[$route]['method'];
            $authCheck = $this->routes[$route]['authcheck'];
      
            // Check for the session.
            if($authCheck == true){
                if(isset($_REQUEST["token"])){
                    require __DIR__.'/../app/helpers/Token.php';
                    $token = new Token;
                    if(!$token->verifyAPIToken()){
                        header('Content-Type: application/json');
                        echo json_encode(array(
                            "status" => "failed",
                            "status_code" => 401,
                            "message" => "Unauthorized access. Please login to continue",
                            "data" => null
                        ));
                        return;
                    }
                }
                else{
                    header('Content-Type: application/json');
                    echo json_encode(array(
                        "status" => "failed",
                        "status_code" => 401,
                        "message" => "Unauthorized access. Please login to continue",
                        "data" => null
                    ));
                    return;
                }
                
            }
      
            require __DIR__.'/../app/controllers/' . $controller . '.php';
      
            $controllerObj = new $controller();
            $controllerObj->$method();
        }
        else{
            header("HTTP/1.0 404 Not Found");
            return;
        }
    }
}
?>