<?php
namespace Websoftwares\Adr\Action;
interface ActionInterface
{
    /**
	 * send    Send the response back to the client.
	 * @param  array $params
	 */
    public function send(array $params);
}
