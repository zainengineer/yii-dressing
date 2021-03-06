<?php
/**
 * @var $this ContactUsController
 * @var $contactUs YdContactUs
 *
 * @author Brett O'Donnell <cornernote@gmail.com>
 * @author Zain Ul abidin <zainengineer@gmail.com>
 * @copyright 2013 Mr PHP
 * @link https://github.com/cornernote/yii-dressing
 * @license BSD-3-Clause https://raw.github.com/cornernote/yii-dressing/master/license.txt
 */

/** @var YdActiveForm $form */
$form = $this->beginWidget('dressing.widgets.YdActiveForm', array(
    'id' => 'contactUs-form',
    'type' => 'vertical',
));
echo $form->beginModalWrap();
echo $form->errorSummary($contactUs);

echo $form->textFieldRow($contactUs, 'name');
echo $form->textFieldRow($contactUs, 'email');
echo $form->textFieldRow($contactUs, 'phone');
echo $form->textFieldRow($contactUs, 'company');
echo $form->textFieldRow($contactUs, 'subject');
echo $form->textAreaRow($contactUs, 'message',array('rows' => 6, 'class' => 'span8'));

echo $form->endModalWrap();
echo '<div class="' . $form->getSubmitRowClass() . '">';
$this->widget('bootstrap.widgets.TbButton', array(
    'buttonType' => 'submit',
    'type' => 'primary',
    'icon' => 'ok white',
    'label' => Yii::t('dressing', 'Send') ,
    'htmlOptions' => array('class' => 'pull-right'),
));
echo '</div>';
$this->endWidget();
