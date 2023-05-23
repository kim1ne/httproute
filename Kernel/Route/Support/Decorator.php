<?php

namespace Kernel\Route\Support;

use Kernel\Route\Dispatcher;
use Kernel\Route\Exceptions\RequestMethodException;
use Kernel\Route\Itinerary;

abstract class Decorator
{
    /**
     * @param string $name
     * @param array $arguments
     * @return Dispatcher
     * @throws RequestMethodException
     * call a method that matches the name of the HTTP request in lowercase
     */
    public function __call(string $name, array $arguments): Dispatcher
    {
        return $this->setRoute($name, $arguments);
    }

    /**
     * @throws RequestMethodException
     */
    protected function setRoute(string $requestMethod, array $arguments): Dispatcher
    {
        $dispatcher = new Dispatcher($arguments[0], ...$arguments[1]);
        Itinerary::setDispatcher($requestMethod, $dispatcher);
        return $dispatcher;
    }
}