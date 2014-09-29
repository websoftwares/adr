<?php
namespace Websoftwares\Adr\Action;
use Symfony\Component\HttpFoundation\Request,
    Websoftwares\Adr\Domain\IoCInterface as Domain,
    Websoftwares\Adr\Responder\IndexBrowseResponder as Responder;

class IndexBrowseAction implements ActionInterface
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
