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

/** @var YdActiveForm $form */
$form = $this->beginWidget('dressing.widgets.YdActiveForm', array(
    //'action' => Yii::app()->createUrl($this->route),
    'type' => 'horizontal',
    'method' => 'get',
    'htmlOptions' => array('class' => 'hide'),
));
$form->searchToggle('role-grid-search', 'role-grid');

echo '<fieldset>';
echo '<legend>' . $this->getName() . ' ' . Yii::t('dressing', 'Search') . '</legend>';
echo $form->textFieldRow($role, 'id');
echo $form->textFieldRow($role, 'name');
echo '</fieldset>';

echo '<div class="form-actions">';
$this->widget('bootstrap.widgets.TbButton', array('buttonType' => 'submit', 'type' => 'primary', 'icon' => 'search white', 'label' => Yii::t('dressing', 'Search')));
echo '</div>';

$this->endWidget();
