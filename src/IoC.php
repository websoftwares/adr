<?php
namespace Websoftwares\Adr;
/**
 * class that implements inversion of control.
 */
class IoC implements IoCInterface
{
    /**
     * @var $registry array
     */
    protected $registry = [];

    /**
     * @param $name
     * @param $resolve \Closure
     */
    public function register($name, \Closure $resolve)
    {
        $this->registry[$name] = $resolve;
    }

    /**
     * @param $name
     * @return object
     */
    public function resolve($name, $args = null)
    {
        if ($this->registered($name)) {
            $name = $this->registry[$name];

            return $args ? $name($args) : $name();
        }
        throw new \Exception('Nothing registered with that name.');
    }

    /**
     *@param $name
     */
    public function registered($name)
    {
        return array_key_exists($name,$this->registry);
    }
}
