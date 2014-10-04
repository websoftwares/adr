<?php
namespace Websoftwares\Adr\Responder\Page;
use Symfony\Component\HttpFoundation\Response,
    Websoftwares\Adr\AbstractResponder;

class ReadResponder extends AbstractResponder
{
    public function __construct(
        Response $response
    )
    {
        $this->response = $response;
    }

    public function send($contentType)
    {
        $this->response->setContent($this->render());
        if ($contentType === ".html") {
            $this->response->headers->set('Content-Type', 'text/html');
        } elseif ($contentType === ".json") {
            $this->response->headers->set('Content-Type', 'application/json');
        }
        $this->response->send();
    }
}
