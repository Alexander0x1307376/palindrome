<?php
namespace app\components;

use app\config;

/**
 * Класс, отвечающий за маршрутизацию запросов
 * 
 */
class Router
{
    /**
     * @var $routes - массив роутов
     */
    private $routes;

    /**
     * @var $prefix - префикс, определяющий пространство имён, в котором находятся классы-контроллеры
     */
    private $prefix = 'app\\controllers\\';

    /**
     * Конструктор класса
     */
    public function __construct()
    {
        $this->routes = include(ROOT.'/app/config/Routes.php');
    }

    /**
     * Основной метод роутера, находит маршрут, создаёт соответствующий класс, вызывает соответствующий метод
     */
    public function run()
    {
        $uri = Request::getUri();
        foreach ($this->routes as $key => $routeItem)
        {
            if($routeItem['uri'] === $uri)
            {
                $controllerPath = $this->prefix.$routeItem['class'];
                $controller = new $controllerPath;
                $method = $routeItem['method'];
                $controller->$method();
                return;
            }
                
            // if($routeItem['uri'] === $uri)
            // {

            // }
        }
        echo 'Совпадений нет '.$uri;
    }
}
