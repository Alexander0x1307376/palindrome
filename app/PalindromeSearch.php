<?php

namespace app;

/**
 * Класс, осуществляющий поиск палиндромов
 * 
 */
class PalindromeSearch
{
    /**
     * Возвращает массив палиндромов, обнаруженных в строке
     * 
     * @param string $string Принимаемая строка
     * 
     * @return array
     */
    public static function getPalindroms($string)
    {
        $string = mb_strtolower($string);
        $charArray = preg_split('//u', $string, null, PREG_SPLIT_NO_EMPTY); //разбиваем строку на символы

        // получаем данные о палиндромах
        $palOddData = self::calculatePalindromeData($charArray); //нечётные
        $palEvenData = self::calculatePalindromeData($charArray, true); //чётные

        if(array_sum(array_merge($palOddData, $palEvenData)) === 0)
            return false; //возврат, если палиндромов в строке не обнаружено


        //формируем массив палиндромов
        for($i = 0; $i < count($palOddData); $i++)
            if($palOddData[$i] > 0)
                $palArray[] = self::getSubstringByRadius($string, $i, $palOddData[$i]);

        for($i = 0; $i < count($palEvenData); $i++)
            if($palEvenData[$i] > 0)
                $palArray[] = self::getSubstringByRadius($string, $i, $palEvenData[$i], true);
        
        return $palArray;
    }

    /**
     * Возвращает подстроку по индексу и "радиусу"
     * 
     * @param string $str - строка, из которой возвращаем подстроку
     * @param integer $index - индекс символа - центр возвращаемой строки
     * @param integer $radius - количество символов слева и справа от центра
     * @param bool $isEven - флаг, определяющий получение чётной подстроки таким образом,
     *  что условный центральный символ ствинут вправо относительно центра чётной строки,
     *  (например в подстроке 'azaaza' центром будет третий справа символ 'a')
     * 
     * @return string
     */
    private static function getSubstringByRadius($str, $index, $radius, $isEven = false)
    {
        $radius = $isEven ? --$radius : $radius;
        $startPos = $index - $radius - ($isEven ? 1 : 0);
        $endPos = $index + $radius;
        $length = $endPos - $startPos + 1;
        return mb_substr($str, $startPos, $length);
    }

    /**
     * Возврашает массив радиусов обнаруженных палиндромов
     * 
     * @param array $charArray - массив символов, из которого высчитываются нужные данные
     * @param bool $isEven - флаг, определяющий режим поиска чётных палиндромов (по умолчанию - нечётные)
     * 
     * @return array
     */
    private static function calculatePalindromeData($charArray, $isEven = false)
    {
        $shift = $isEven ? 1 : 0; //смещение для вычисления чётных палиндромов
        $d = []; //массив радиусов палиндромов
        $leftBorder = 0;
        $rightBorder = -1;
        $length = count($charArray);

        for($i = 0; $i < $length; $i++)
        {            
            if($i > $rightBorder)
                $radius = 1;
            else
                $radius = min($d[$leftBorder + $rightBorder - $i + $shift], $rightBorder - $i + $shift) + 1;

            while(
                $i + $radius - $shift < $length &&
                $i - $radius >= 0 &&
                $charArray[$i+$radius-$shift] == $charArray[$i - $radius]
            ) ++$radius;

            $d[$i] = --$radius;

            if($i + $radius - $shift > $rightBorder)
                $leftBorder = $i - $radius;
                $rightBorder = $i + $radius - $shift;
        }
        return $d;
    }
}
