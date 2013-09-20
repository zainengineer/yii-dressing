<?php
/**
 * @var $this ContactUsController
 * @var $contactUs ContactUs
 */

/** @var ActiveForm $form */
$form = $this->beginWidget('widgets.ActiveForm', array(
    'id' => 'contactUs-form',
    'type' => 'vertical',
    //'enableAjaxValidation' => true,
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
    'label' => t('Send') ,
    'htmlOptions' => array('class' => 'pull-right'),
));
echo '</div>';
$this->endWidget();
