<?php
/**
 * YdLinkBehavior gives models a url() and link() method.
 *
 * @property YdActiveRecord $owner
 *
 * @author Brett O'Donnell <cornernote@gmail.com>
 * @author Zain Ul abidin <zainengineer@gmail.com>
 * @copyright 2013 Mr PHP
 * @link https://github.com/cornernote/yii-dressing
 * @license BSD-3-Clause https://raw.github.com/cornernote/yii-dressing/master/license.txt
 *
 * @package dressing.behaviors
 */
class YdLinkBehavior extends CActiveRecordBehavior
{

    /**
     * @var string The name of default action for the model, usually view
     */
    public $defaultAction = 'view';

    /**
     * @var string The name of the controller to be used in links
     */
    public $controllerName;

    /**
     * Returns the name of the controller to be used in links
     *
     * @return string
     */
    public function getControllerName()
    {
        if ($this->controllerName)
            return $this->controllerName;
        return $this->controllerName = lcfirst(get_class($this->owner));
    }

    /**
     * The name of this model to be used in titles
     *
     * @return string
     */
    public function getName()
    {
        return $this->owner->getIdString();
    }

    /**
     * The name and id of the model
     * eg: ActiveRecord-123
     *
     * @return string
     */
    public function getIdString()
    {
        return get_class($this->owner) . '-' . $this->getPrimaryKeyString();
    }

    /**
     * Returns a URL Array to the model
     *
     * @param string $action
     * @param array $params
     * @return array
     */
    public function getUrl($action = null, $params = array())
    {
        if (!$action)
            $action = $this->defaultAction;
        return array_merge(array(
            '/' . $this->getControllerName() . '/' . $action,
            'id' => $this->getPrimaryKeyString(),
        ), (array)$params);
    }

    /**
     * Returns a URL String to the model
     *
     * @param string $action
     * @param array $params
     * @return string
     */
    public function getUrlString($action = null, $params = array())
    {
        $params = $this->getUrl($action, $params);
        $route = array_shift($params);
        return Yii::app()->createUrl($route, $params);
    }

    /**
     * Returns a Link to the model
     *
     * @param string $title
     * @param string $urlAction
     * @param array $urlParams
     * @param array $htmlOptions
     * @return string
     */
    public function getLink($title = null, $urlAction = null, $urlParams = array(), $htmlOptions = array())
    {
        if ($title === null)
            $title = $this->owner->getName();
        return CHtml::link($title, $this->owner->getUrl($urlAction, $urlParams), $htmlOptions);
    }

    /**
     * Override this in your model to return an array of links to be used in a menu
     *
     * @param bool $extra
     * @return array
     */
    public function getMenuLinks($extra = false)
    {
        $links = array();
        // eg:
        //$links[] = array('label' => Yii::t('dressing', 'Update'), 'url' => $this->owner->getUrl('update'));
        return $links;
    }

    /**
     * Returns Primary Key Schema as a string
     *
     * @return string
     */
    public function getPrimaryKeySchemaString()
    {
        if (is_array($this->owner->tableSchema->primaryKey))
            return implode('-', $this->owner->tableSchema->primaryKey);
        return $this->owner->tableSchema->primaryKey;
    }

    /**
     * Returns Primary Key as a string
     *
     * @return string
     */
    public function getPrimaryKeyString()
    {
        if (is_array($this->owner->getPrimaryKey()))
            return implode('-', $this->owner->getPrimaryKey());
        return $this->owner->getPrimaryKey();
    }

}
