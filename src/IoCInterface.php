<?php
namespace Websoftwares\Adr;
interface IoCInterface
{
    public function register($name, \Closure $resolve);
    public function resolve($name);
    public function registered($name);
}
