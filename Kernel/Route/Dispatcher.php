<?php

namespace Kernel\Route;

use Kernel\Route\Request\Http;

class Dispatcher
{
    readonly string $url;
    readonly array $match;
    readonly string $className;
    readonly ?string $action;

    public function __construct(
        string $url,
        string $className,
        ?string $action = null
    )
    {
        $this->url = trim($url, '/');
        $this->className = $className;
        $this->action = $action ?? '__invoke';
    }

    /**
     * @return false|$this
     */
    public function init(): false|self
    {
        $currentUrl = (new Http())->getUrl();
        $pattern = '~^' . $this->url . '$~';
        preg_match($pattern, $currentUrl, $match);

        if (!empty($match)) {
            unset($match[0]);

            $this->match = $match;
            return $this;
        }

        return false;
    }
}