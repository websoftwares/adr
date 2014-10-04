<?php
namespace Websoftwares\Adr\Action\Index;
use Websoftwares\Adr\Action\ActionInterface,
    Symfony\Component\HttpFoundation\Request,
    Websoftwares\Adr\IoCInterface as Domain,
    Websoftwares\Adr\Responder\Index\BrowseResponder as Responder;

class BrowseAction implements ActionInterface
{
    public function __construct(
        Request $request,
        Domain $domain,
        Responder $responder
    )
    {
        $this->request = $request;
        $this->domain = $domain;
        $this->responder = $responder;
    }

    public function send(array $params)
    {
        $this->responder->setVariables("data", ["title" => "Hello World", "body" => "Hello World"]);

        return $this->responder->send();
    }
}
