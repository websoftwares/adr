<?php
namespace Websoftwares\Adr\Action;
use Symfony\Component\HttpFoundation\Request,
    Websoftwares\Adr\Domain\IoCInterface as Domain,
    Websoftwares\Adr\Responder\PageReadResponder as Responder;

class PageReadAction implements ActionInterface
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
