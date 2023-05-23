<?php

namespace Kernel\Route;

use Kernel\Route\Support\Decorator;

/**
 * @method Dispatcher get(string $url, array $arguments)
 * @method Dispatcher put(string $url, array $arguments)
 * @method Dispatcher post(string $url, array $arguments)
 * @method Dispatcher head(string $url, array $arguments)
 * @method Dispatcher delete(string $url, array $arguments)
 * @method Dispatcher patch(string $url, array $arguments)
 * @method Dispatcher options(string $url, array $arguments)
 */
class Route extends Decorator
{

}