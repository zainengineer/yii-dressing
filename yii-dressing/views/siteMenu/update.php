<?php
/**
 * @var $this YdSiteMenuController
 * @var $menu YdSiteMenu
 *
 * @author Brett O'Donnell <cornernote@gmail.com>
 * @author Zain Ul abidin <zainengineer@gmail.com>
 * @copyright 2013 Mr PHP
 * @link https://github.com/cornernote/yii-dressing
 * @license BSD-3-Clause https://raw.github.com/cornernote/yii-dressing/master/license.txt
 */

$this->pageTitle = $menu->getName();

$this->renderPartial('/siteMenu/_menu', array(
    'siteMenu' => $menu,
));
$this->renderPartial('/siteMenu/_form', array(
    'menu' => $menu,
));
