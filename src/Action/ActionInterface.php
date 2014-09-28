<?php
namespace Websoftwares\Adr\Action;
interface ActionInterface
{
    /**
	 * Send the response back to the client.
	 * @return void
	 */
    public function send();
}
