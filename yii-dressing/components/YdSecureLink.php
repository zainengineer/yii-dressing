<?php
/**
 * Class YdSecureLink
 *
 * @author Brett O'Donnell <cornernote@gmail.com>
 * @author Zain Ul abidin <zainengineer@gmail.com>
 * @copyright 2013 Mr PHP
 * @link https://github.com/cornernote/yii-dressing
 * @license BSD-3-Clause https://raw.github.com/cornernote/yii-dressing/master/license.txt
 *
 * @package dressing.components
 */
class YdSecureLink
{

    /**
     * @static
     * @param $action
     * @param $params
     * @param $ttl
     * @return string
     */
    static public function getUrl($action, $params, $ttl)
    {
        $params['ttl'] = $ttl;
        $params['rnd'] = md5(microtime(true));
        $params['key'] = md5(implode('', $params) . YII_DRESSING_HASH);
        return Yii::app()->createAbsoluteUrl($action, $params);
    }

    /**
     * @static
     * @param $data
     * @param $paramNames
     * @return bool
     */
    static public function validate($data, $paramNames)
    {
        if (!isset($data['ttl']) || !isset($data['rnd'])) {
            return false;
        }
        if ($data['ttl'] < time()) {
            return false;
        }
        $params = array();
        foreach ($paramNames as $name) {
            if (isset($data[$name])) {
                $params[$name] = $data[$name];
            }
        }
        $params['ttl'] = $data['ttl'];
        $params['rnd'] = $data['rnd'];
        $key = md5(implode('', $params) . YII_DRESSING_HASH);
        return ($data['key'] == $key);
    }

}
