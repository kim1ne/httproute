# HTTP Route Service

```php
use Kernel\Route\Route;

$route = new Route();

$route->get('/', [Controller::class]);
// $route->post('/', [Controller::class]);
// $route->put('/', [Controller::class]);
// $route->head('/', [Controller::class]);
// $route->patch('/', [Controller::class]);
// $route->options('/', [Controller::class]);
// $route->delete('/', [Controller::class]);

public function __invoke() 
{
    // code...
}
```

```php

$route->get('/news/(\w+)', [Controller::class, 'get']);

public function get(int $id) 
{
    echo $id;
}
```

### Return Current route

```php
use Kernel\Route\Itinerary;

$dispatcher = Itinerary::getDispatcher();
$match = $dispatcher->match;
$className = $dispatcher->className;
$action = $dispatcher->action;
```

### Create Controller

```php
$controller = new $className();
$controller->$action(...$match);
```
