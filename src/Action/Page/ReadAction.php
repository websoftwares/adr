<?php
namespace Websoftwares\Adr\Action\Page;
use Websoftwares\Adr\Action\ActionInterface,
    Symfony\Component\HttpFoundation\Request,
    Websoftwares\Adr\IoCInterface as Domain,
    Websoftwares\Adr\Responder\Page\ReadResponder as Responder;

class ReadAction implements ActionInterface
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
        $this->responder->setVariables("data", $this->domain->resolve("pages")[$params["id"]]);

        return $this->responder->send($params["format"]);
    }
}
