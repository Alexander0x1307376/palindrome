<?php
namespace app\components;

/**
 * Класс, ответственный за рендер страниц
 */
class ViewRenderer
{
    public static function renderHTML($viewPath)
    {
        require(ROOT.$viewPath);
    }
}
