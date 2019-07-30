<?php
namespace app\components;

/**
 * Класс, осуществляющий приём запросов от клиентов
 */
class Request
{
    /**
     * Возвращает данные, пришедшие с методом POST по заголовку $name
     * 
     * @param string $name - заголовок
     */
    public static function getPost($name)
    {
        if(!empty($_POST))
        {
            return isset($_POST[$name]) ? $_POST[$name] : null;
        }
        else
        {
            $post = json_decode(file_get_contents('php://input'), true);
            return isset($post[$name]) ? $post[$name] : null;
        }
    }

    /**
     * Возвращает uri целиком
     * 
     */
    public static function getUriWithRequest()
    {
       return isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : null;
    }

    /**
     * Возвращает uri
     * 
     */
    public static function getUri()
    {
        $uri = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : null;
        if(is_null($uri)) 
            return null;

        preg_match('~.+?(?=\?)~', $uri, $matches);
        return isset($matches[0]) ? $matches[0] : $uri;
    }
}
