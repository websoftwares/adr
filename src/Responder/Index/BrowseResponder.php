<?php
namespace Websoftwares\Adr\Responder\Index;
use Symfony\Component\HttpFoundation\Response,
    Websoftwares\Adr\AbstractResponder;

class BrowseResponder extends AbstractResponder
{
    public function __construct(
        Response $response
    )
    {
        $this->response = $response;
    }

    public function send()
    {
        $this->response->setContent($this->render());
        $this->response->headers->set('Content-Type', 'text/html');
        $this->response->send();
    }
}
