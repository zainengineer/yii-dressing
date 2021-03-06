<?php
/**
 * Class YdNumberHelper
 *
 * @author Brett O'Donnell <cornernote@gmail.com>
 * @author Zain Ul abidin <zainengineer@gmail.com>
 * @copyright 2013 Mr PHP
 * @link https://github.com/cornernote/yii-dressing
 * @license BSD-3-Clause https://raw.github.com/cornernote/yii-dressing/master/license.txt
 *
 * @package dressing.components
 */
class YdNumberHelper extends CComponent
{

    /**
     * @param array $array
     * @return bool|float
     */
    public function getMedian($array = array())
    {
        if (!is_array($array) || empty($array)) return false;
        sort($array);
        $n = count($array);
        if ($n < 1)
            return 0;
        $h = intval($n / 2);
        return ($n % 2 == 0) ? ($array[$h] + $array[$h - 1]) / 2 : $array[$h];
    }

    /**
     * @param array $array
     * @return bool|float
     */
    public function getAverage($array = array())
    {
        if (!is_array($array) || empty($array)) return false;
        return array_sum($array) / count($array);
    }

    /**
     * @param array $array
     * @return bool|float
     */
    public function getHigh($array = array())
    {
        if (!is_array($array) || empty($array)) return false;
        return max($array);
    }

    /**
     * @param array $array
     * @return bool|float
     */
    public function getLow($array = array())
    {
        if (!is_array($array) || empty($array)) return false;
        return min($array);
    }
}