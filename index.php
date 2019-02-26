<?php
/*
    * Entry point of application.
    * Every request is redirected to this file. This can be done using server configuration file (.htaccess).
*/

// File app.php loads the database configuartion.
require __DIR__ . "/config/app.php";

// File autoload.php loads the modules from vendor directory.
require __DIR__ . '/vendor/autoload.php';

/*
    * Loads the helper class View.
    * This class helps to parse the HTML content from the file.
*/
require __DIR__.'/app/helpers/View.php';

/*
    * Get the URL path (this path is captured through server configuration file .htaccess) fired in the browser and passed to the Route class.
    * Route class is present in routes/Route.php file.
*/
if(isset($_GET["route"])){
    require __DIR__.'/routes/Route.php';
    
    $route = new Route;
    $route->matchRoute(rtrim($_GET['route'], '/'));
}
else{
    $view = new View;
    $view->parseHTML('Welcome');
}
?>