<?php

namespace Kernel\Route;

use Exception;
use Kernel\Route\Exceptions\RequestMethodException;
use Kernel\Route\Request\Http;

class Itinerary
{
    private static array $dispatchers;
    private static Dispatcher|bool $dispatcher;

    /**
     * @throws RequestMethodException|Exception
     */
    public static function setDispatcher(string $requestMethod, Dispatcher $dispatcher): void
    {
        Http::protect($requestMethod);
        self::$dispatchers[$requestMethod][] = $dispatcher;
    }

    /**
     * @throws RequestMethodException|Exception
     */
    public static function returnDispatchers(string $requestMethod): array
    {
        Http::protect($requestMethod);
        return self::$dispatchers[$requestMethod] ?? [];
    }

    /**
     * @throws RequestMethodException
     */
    public static function getDispatcher(): false|Dispatcher
    {
        if (empty(self::$dispatcher)) {
            self::$dispatcher = self::initialize();
        }
        return self::$dispatcher;
    }

    /**
     * @throws RequestMethodException
     */
    private static function initialize(): false|Dispatcher
    {
        $dispatchers = self::returnDispatchers((new Http())->getRequestMethod());

        $dispatcher = false;
        foreach ($dispatchers as $item)
        {
            /**
             * @var Dispatcher $item
             */
            $dispatcher = $item->init();

            if ($dispatcher !== false) {
                break;
            }
        }

        return $dispatcher;
    }
}