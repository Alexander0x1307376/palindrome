<?php
namespace app\components;

/**
 * Класс, позволяющий описывать простые маршруты (без параметров)
 */
class SimpleRouter
{
    /**
     * Данный метод предназначен для описания действий, выполняемых для данного маршрута
     * 
     */
    public static function addRoute($route, $callback)
    {
        if(Request::getUri() === $route)
        {
            $callback();
            exit();
        }
    }
}