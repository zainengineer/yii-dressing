<?php
/**
 * @var $this RoleController
 * @var $role YdRole
 *
 * @author Brett O'Donnell <cornernote@gmail.com>
 * @author Zain Ul abidin <zainengineer@gmail.com>
 * @copyright 2013 Mr PHP
 * @link https://github.com/cornernote/yii-dressing
 * @license BSD-3-Clause https://raw.github.com/cornernote/yii-dressing/master/license.txt
 */

$this->pageTitle = $role->getName();

$this->renderPartial('/role/_menu', array(
    'role' => $role,
));

$attributes = array();
$attributes[] = array(
    'name' => 'id',
);
$attributes[] = array(
    'name' => 'name',
);
$attributes[] = array(
    'name' => 'created',
);
$attributes[] = array(
    'name' => 'modified',
);

$this->widget('widgets.DetailView', array(
    'data' => $role,
    'attributes' => $attributes,
));
