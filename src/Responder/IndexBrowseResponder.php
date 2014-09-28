<?php
namespace Websoftwares\Adr\Responder;
use Symfony\Component\HttpFoundation\Response,
    Websoftwares\Adr\AbstractResponder;

class IndexBrowseResponder extends AbstractResponder
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
        $this->response->headers->set('Content-Type', 'application/json');
        $this->response->send();
    }
}
