<?php
/**
 * @var $this YdAttachmentController
 * @var $attachment YdAttachment
 *
 * @author Brett O'Donnell <cornernote@gmail.com>
 * @author Zain Ul abidin <zainengineer@gmail.com>
 * @copyright 2013 Mr PHP
 * @link https://github.com/cornernote/yii-dressing
 * @license BSD-3-Clause https://raw.github.com/cornernote/yii-dressing/master/license.txt
 */

echo '<div class="view">';

echo '<b>'.CHtml::encode($data->getAttributeLabel('id')).':</b>';
echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)).'<br />';

echo '<b>' . CHtml::encode($data->getAttributeLabel('model')) . ':</b>';
echo CHtml::encode($data->model) . '<br />';

echo '<b>' . CHtml::encode($data->getAttributeLabel('model_id')) . ':</b>';
echo CHtml::encode($data->model_id) . '<br />';

echo '<b>' . CHtml::encode($data->getAttributeLabel('filename')) . ':</b>';
echo CHtml::encode($data->filename) . '<br />';

echo '<b>' . CHtml::encode($data->getAttributeLabel('extension')) . ':</b>';
echo CHtml::encode($data->extension) . '<br />';

echo '<b>' . CHtml::encode($data->getAttributeLabel('filetype')) . ':</b>';
echo CHtml::encode($data->filetype) . '<br />';

echo '<b>' . CHtml::encode($data->getAttributeLabel('filesize')) . ':</b>';
echo CHtml::encode($data->filesize) . '<br />';

echo '<b>' . CHtml::encode($data->getAttributeLabel('notes')) . ':</b>';
echo CHtml::encode($data->notes) . '<br />';

echo '<b>' . CHtml::encode($data->getAttributeLabel('sort_order')) . ':</b>';
echo CHtml::encode($data->sort_order) . '<br />';

echo '<b>' . CHtml::encode($data->getAttributeLabel('created')) . ':</b>';
echo CHtml::encode($data->created) . '<br />';

echo '<b>' . CHtml::encode($data->getAttributeLabel('deleted')) . ':</b>';
echo CHtml::encode($data->deleted) . '<br />';

echo '</div>';
