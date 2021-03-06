<?php
Yii::import('zii.behaviors.CTimestampBehavior');

/**
 * YdTimestampBehavior automatically detects the created and updated fields and populates them when the model is saved.
 *
 * @property CActiveRecord $owner
 *
 * @author Brett O'Donnell <cornernote@gmail.com>
 * @author Zain Ul abidin <zainengineer@gmail.com>
 * @copyright 2013 Mr PHP
 * @link https://github.com/cornernote/yii-dressing
 * @license BSD-3-Clause https://raw.github.com/cornernote/yii-dressing/master/license.txt
 *
 * @package dressing.behaviors
 */
class YdTimestampBehavior extends CTimestampBehavior
{

    /**
     * @var bool True to attempt to detect the fields to use for created and updated.
     */
    public $autoColumns = true;

    /**
     * @var bool
     */
    public $setUpdateOnCreate = true;

    /**
     * @var array Contains any fields that may be used to store the created timestamp.
     */
    public $createAttributes = array('created', 'create_time', 'created_at', 'date_added');

    /**
     * @var array Contains any fields that may be used to store the updated timestamp.
     */
    public $updateAttributes = array('updated', 'update_time', 'updated_at', 'date_modified');

    /**
     * Responds to {@link CModel::onBeforeSave} event.
     * Decides if there are created/updated fields then calls parent to update them.
     *
     * @param CModelEvent $event event parameter
     */
    public function beforeSave($event)
    {
        $this->_setAttributes();
        if ($this->owner->getIsNewRecord() && ($this->createAttribute !== null) && $this->owner->{$this->createAttribute} === null) {
            $this->owner->{$this->createAttribute} = $this->getTimestampByAttribute($this->createAttribute);
        }
        if ((!$this->owner->getIsNewRecord() || $this->setUpdateOnCreate) && ($this->updateAttribute !== null)) {
            $this->owner->{$this->updateAttribute} = $this->getTimestampByAttribute($this->updateAttribute);
        }
    }

    /**
     * Decides if there are created/updated fields and sets them to be used
     */
    private function _setAttributes()
    {
        if (!$this->autoColumns)
            return;
        $this->autoColumns = false;
        $this->createAttribute = $this->_getAttribute($this->createAttributes);
        $this->updateAttribute = $this->_getAttribute($this->updateAttributes);
    }

    /**
     * Checks the table to see if a matching field exists
     * @param array $attributes fields to check for
     * @return null|string
     */
    private function _getAttribute($attributes)
    {
        foreach ($attributes as $attribute)
            if (in_array($attribute, $this->owner->tableSchema->columnNames))
                return $attribute;
        return null;
    }

    /**
     * Returns the appropriate timestamp depending on $columnType
     *
     * @param string $columnType $columnType
     * @return mixed timestamp (eg unix timestamp or a mysql function)
     */
    protected function getTimestampByColumnType($columnType)
    {
        if ($columnType == 'datetime')
            return date('Y-m-d H:i:s');
        if ($columnType == 'timestamp')
            return date('Y-m-d H:i:s');
        if ($columnType == 'date')
            return date('Y-m-d');
        return time();
    }

}
