<?php

/**
 * YdAuditTrail
 *
 * --- BEGIN GenerateProperties ---
 *
 * This is the model class for table 'audit_trail'
 *
 * @method YdAuditTrail with() with()
 * @method YdAuditTrail find() find($condition, array $params = array())
 * @method YdAuditTrail[] findAll() findAll($condition = '', array $params = array())
 * @method YdAuditTrail findByPk() findByPk($pk, $condition = '', array $params = array())
 * @method YdAuditTrail[] findAllByPk() findAllByPk($pk, $condition = '', array $params = array())
 * @method YdAuditTrail findByAttributes() findByAttributes(array $attributes, $condition = '', array $params = array())
 * @method YdAuditTrail[] findAllByAttributes() findAllByAttributes(array $attributes, $condition = '', array $params = array())
 * @method YdAuditTrail findBySql() findBySql($sql, array $params = array())
 * @method YdAuditTrail[] findAllBySql() findAllBySql($sql, array $params = array())
 *
 * Properties from relation
 * @property YdUser $user
 * @property YdAudit $audit
 *
 * Properties from table fields
 * @property integer $id
 * @property integer $audit_id
 * @property string $old_value
 * @property string $new_value
 * @property string $action
 * @property string $model
 * @property string $model_id
 * @property string $field
 * @property datetime $created
 * @property integer $user_id
 *
 * --- END GenerateProperties ---
 *
 * @author Brett O'Donnell <cornernote@gmail.com>
 * @author Zain Ul abidin <zainengineer@gmail.com>
 * @copyright 2013 Mr PHP
 * @link https://github.com/cornernote/yii-dressing
 * @license http://www.gnu.org/copyleft/gpl.html
 *
 * @package dressing.models
 */
class YdAuditTrail extends YdActiveRecord
{

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        return array(
            // search fields
            array('id, new_value, old_value, action, model, field, created, user_id, model_id, audit_id', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => Yii::t('dressing', 'ID'),
            'old_value' => Yii::t('dressing', 'Old Value'),
            'new_value' => Yii::t('dressing', 'New Value'),
            'action' => Yii::t('dressing', 'Action'),
            'model' => Yii::t('dressing', 'Model'),
            'field' => Yii::t('dressing', 'Field'),
            'created' => Yii::t('dressing', 'Created'),
            'user_id' => Yii::t('dressing', 'User'),
            'model_id' => Yii::t('dressing', 'Model'),
            'audit_id' => Yii::t('dressing', 'Audit'),
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @param array $options
     * @return YdActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search($options = array())
    {
        $criteria = new CDbCriteria;
        $criteria->compare('id', $this->id);
        $criteria->compare('old_value', $this->old_value);
        $criteria->compare('new_value', $this->new_value);
        $criteria->compare('action', $this->action, true);
        $criteria->compare('model', $this->model);
        $criteria->compare('field', $this->field);
        $criteria->compare('created', $this->created);
        $criteria->compare('user_id', $this->user_id);
        $criteria->compare('model_id', $this->model_id);
        $criteria->compare('audit_id', $this->audit_id);
        $criteria->mergeWith($this->getDbCriteria());

        return new YdActiveDataProvider(get_class($this), CMap::mergeArray(array(
            'criteria' => $criteria,
        ), $options));
    }

    /**
     * @return null|string
     */
    public function getOldValueString()
    {
        return $this->old_value;
    }

    /**
     * @return null|string
     */
    public function getNewValueString()
    {
        return $this->new_value;
    }

}