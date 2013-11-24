<?php
/**
 * @var $this AttachmentController
 * @var $attachment YdAttachment
 *
 * @author Brett O'Donnell <cornernote@gmail.com>
 * @author Zain Ul abidin <zainengineer@gmail.com>
 * @copyright 2013 Mr PHP
 * @link https://github.com/cornernote/yii-dressing
 * @license http://www.gnu.org/copyleft/gpl.html
 */

$this->pageTitle = $this->pageHeading = $attachment->getName() . ' - ' . $this->getName() . ' ' . Yii::t('dressing', 'Log');

$this->breadcrumbs[Yii::t('dressing', 'Tools')] = array('/tool/index');
$this->breadcrumbs[Yii::t('dressing', 'Attachments')] = Yii::app()->user->getState('index.attachment', array('/attachment/index'));
$this->breadcrumbs[$attachment->getName()] = $attachment->getLink();
$this->breadcrumbs[] = Yii::t('dressing', 'Log');

$this->renderPartial('dressing.views.attachment._menu', array(
    'attachment' => $attachment,
));
$this->renderPartial('dressing.views.auditTrail._log', array(
    'model' => $attachment,
));