<?php
/**
 * @var $this YdAccountController
 * @var $user YdAccountLogin
 * @var $recaptcha string
 *
 * @author Brett O'Donnell <cornernote@gmail.com>
 * @author Zain Ul abidin <zainengineer@gmail.com>
 * @copyright 2013 Mr PHP
 * @link https://github.com/cornernote/yii-dressing
 * @license BSD-3-Clause https://raw.github.com/cornernote/yii-dressing/master/license.txt
 */

$this->pageTitle = Yii::t('dressing', 'Login');

/** @var YdActiveForm $form */
$form = $this->beginWidget('dressing.widgets.YdActiveForm', array(
    'id' => 'login-form',
    'type' => 'horizontal',
));
echo $form->beginModalWrap();
echo $form->errorSummary($user);
echo $form->textFieldRow($user, 'email');
echo $form->passwordFieldRow($user, 'password');
echo $form->checkBoxRow($user, 'remember_me');

if ($recaptcha) {
    echo CHtml::activeLabel($user, 'recaptcha');
    $this->widget('dressing.widgets.YdReCaptchaInput', array('model' => $user));
    echo CHtml::error($user, 'recaptcha');
}
echo $form->endModalWrap();
echo '<div class="' . $form->getSubmitRowClass() . '">';
$this->widget('bootstrap.widgets.TbButton', array(
    'label' => Yii::t('dressing', 'Login'),
    'type' => 'primary',
    'buttonType' => 'submit',
));
echo ' ';
$this->widget('bootstrap.widgets.TbButton', array(
    'label' => Yii::t('dressing', 'Lost Password'),
    'url' => array('/account/recover'),
));
echo ' ';
$this->widget('bootstrap.widgets.TbButton', array(
    'label' => Yii::t('dressing', 'Sign Up'),
    'url' => array('/account/signup'),
));
echo '</div>';
$this->endWidget();