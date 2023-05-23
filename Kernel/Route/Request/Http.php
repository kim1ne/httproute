<?php

namespace Kernel\Route\Request;

use Exception;
use Kernel\Route\Exceptions\RequestMethodException;

class Http
{
    const REQUEST_METHOD_GET = 'get';
    const REQUEST_METHOD_POST = 'post';
    const REQUEST_METHOD_HEAD = 'head';
    const REQUEST_METHOD_DELETE = 'delete';
    const REQUEST_METHOD_PATCH = 'patch';
    const REQUEST_METHOD_OPTIONS = 'options';

    public function all(): array
    {
        return array_merge(
            $this->getParameters(),
            $this->getPost(),
            $this->getParsedBody()
        );
    }

    public function getParsedBody(): array
    {
        return json_decode(file_get_contents('php://input'), true) ?? [];
    }

    public function getParameters(): array
    {
        $get = $_GET;
        unset($get['route']);
        return $get;
    }

    public function getUrl(): string
    {
        $route = $_GET['route'] ?? '';
        return trim($route, '/');
    }

    public function getPost(): array
    {
        return $_POST;
    }

    public function getCookie(): array
    {
        return $_COOKIE;
    }

    public function getServer(): array
    {
        return $_SERVER;
    }

    public function getRequestMethod(): string
    {
        return strtolower($this->getServer()['REQUEST_METHOD']);
    }

    public function getUserAgent(): string
    {
        return $this->getServer()['HTTP_USER_AGENT'];
    }

    public function getDomain(): string
    {
        $server = $this->getServer();
        return $server['REQUEST_SCHEME'] . '://' . $server['HTTP_HOST'];
    }

    public static function getMethods(): array
    {
        return [
            self::REQUEST_METHOD_GET,
            self::REQUEST_METHOD_POST,
            self::REQUEST_METHOD_HEAD,
            self::REQUEST_METHOD_DELETE,
            self::REQUEST_METHOD_PATCH,
            self::REQUEST_METHOD_OPTIONS,
        ];
    }

    /**
     * @throws Exception
     */
    public static function protect(string $requestMethod): void
    {
        if (!in_array($requestMethod, self::getMethods())) {
            throw new RequestMethodException();
        }
    }
}