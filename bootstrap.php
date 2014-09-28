<?php
/*
|--------------------------------------------------------------------------
| Error reporting enabled default remove for production
|--------------------------------------------------------------------------
*/
error_reporting(E_ALL);
ini_set('display_errors',1);
/*
|--------------------------------------------------------------------------
| Autoload classes
|--------------------------------------------------------------------------
*/
include "vendor/autoload.php";
/*
|--------------------------------------------------------------------------
| Config IoC container object.
|--------------------------------------------------------------------------
*/
$ioc = new Websoftwares\Adr\Domain\IoC();
/*
|--------------------------------------------------------------------------
| Config Router
|--------------------------------------------------------------------------
*/
$ioc->register("router",function () {
    $router_factory = new \Aura\Router\RouterFactory();
    $router = $router_factory->newInstance();

    // Home route
    $router->addGet('index.browse', '/')
        ->addValues([
            'action' => "IndexBrowseAction",
            'format' => '.json'
            ]);

    return $router;
});
/*
|--------------------------------------------------------------------------
| Dispatch
|--------------------------------------------------------------------------
*/
use Symfony\Component\HttpFoundation\Response;

$request = Symfony\Component\HttpFoundation\Request::createFromGlobals();
$response  = new Response();

$path = parse_url($request->server->get('REQUEST_URI'), PHP_URL_PATH);

$route = $ioc->resolve("router")->match($path, $_SERVER);

if ($route) {

    $pathFile = explode(".", $route->name);
    $ActionClass = "Websoftwares\\Adr\\Action\\" . $route->params["action"];
    $ResponderClass =  "Websoftwares\\Adr\\Responder\\" . str_replace("Action", "Responder", $route->params["action"]);

    $responder = (new $ResponderClass($response))
        ->setPath("../views/" . $pathFile[0] . "/")
        ->setFile($pathFile[1] . $route->params["format"]);

    (new $ActionClass($request, $ioc, $responder))->send();

} else {
    $response->setContent("No resource found");
    $response->headers->set('Content-Type', 'text/plain');
    $response->setStatusCode(Response::HTTP_NOT_FOUND);
    $response->send();
}
