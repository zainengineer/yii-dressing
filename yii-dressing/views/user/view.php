<?php
/**
 * @var $this UserController
 * @var $user YdUser
 *
 * @author Brett O'Donnell <cornernote@gmail.com>
 * @author Zain Ul abidin <zainengineer@gmail.com>
 * @copyright 2013 Mr PHP
 * @link https://github.com/cornernote/yii-dressing
 * @license BSD-3-Clause https://raw.github.com/cornernote/yii-dressing/master/license.txt
 */
$this->pageTitle = $user->getName();

$this->renderPartial('/user/_menu', array(
    'user' => $user,
));

$attributes = array();
$attributes[] = 'id';
$attributes[] = 'username';
$attributes[] = 'name';
$attributes[] = array(
    'name' => 'email',
    'value' => CHtml::link($user->email, 'mailto:' . $user->email),
    'type' => 'raw',
);
$attributes[] = 'phone';
$attributes[] = array(
    'label' => Yii::t('dressing', 'Roles'),
    'value' => implode(', ', CHtml::listData($user->role, 'id', 'name')),
);
$attributes[] = 'created';
$this->widget('dressing.widgets.YdDetailView', array(
    'data' => $user,
    'attributes' => $attributes,
));

