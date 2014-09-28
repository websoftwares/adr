<?php
namespace Websoftwares\Adr\Domain;
interface IoCInterface
{
    public function register($name, \Closure $resolve);
    public function resolve($name);
    public function registered($name);
}
