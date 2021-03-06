<?php

/**
 * YdUser
 *
 * --- BEGIN GenerateProperties ---
 *
 * This is the model class for table 'user'
 *
 * @method YdUser with() with()
 * @method YdUser find() find($condition, array $params = array())
 * @method YdUser[] findAll() findAll($condition = '', array $params = array())
 * @method YdUser findByPk() findByPk($pk, $condition = '', array $params = array())
 * @method YdUser[] findAllByPk() findAllByPk($pk, $condition = '', array $params = array())
 * @method YdUser findByAttributes() findByAttributes(array $attributes, $condition = '', array $params = array())
 * @method YdUser[] findAllByAttributes() findAllByAttributes(array $attributes, $condition = '', array $params = array())
 * @method YdUser findBySql() findBySql($sql, array $params = array())
 * @method YdUser[] findAllBySql() findAllBySql($sql, array $params = array())
 *
 * Methods from behavior SoftDeleteBehavior
 * @method undelete() undelete()
 * @method deleteds() deleteds()
 * @method notdeleteds() notdeleteds()
 *
 * Methods from behavior EavBehavior
 * @method CActiveRecord loadEavAttributes() loadEavAttributes(array $attributes)
 * @method setModelTableFk() setModelTableFk($modelTableFk)
 * @method setSafeAttributes() setSafeAttributes($safeAttributes)
 * @method CActiveRecord saveEavAttributes() saveEavAttributes($attributes)
 * @method CActiveRecord deleteEavAttributes() deleteEavAttributes($attributes = array(), $save = false)
 * @method CActiveRecord setEavAttributes() setEavAttributes($attributes, $save = false)
 * @method CActiveRecord setEavAttribute() setEavAttribute($attribute, $value, $save = false)
 * @method array getEavAttributes() getEavAttributes($attributes = array())
 * @method getEavAttribute() getEavAttribute($attribute)
 * @method CActiveRecord withEavAttributes() withEavAttributes($attributes = array())
 *
 * Properties from relation
 * @property YdRole[] $role
 * @property YdUserToRole[] $userToRole
 *
 * Properties from table fields
 * @property string $id
 * @property string $email
 * @property string $username
 * @property string $password
 * @property string $first_name
 * @property string $last_name
 * @property string $phone
 * @property string $fax
 * @property integer $web_status
 * @property integer $api_status
 * @property string $api_key
 * @property datetime $created
 * @property datetime $deleted
 *
 * --- END GenerateProperties ---
 *
 * @author Brett O'Donnell <cornernote@gmail.com>
 * @author Zain Ul abidin <zainengineer@gmail.com>
 * @copyright 2013 Mr PHP
 * @link https://github.com/cornernote/yii-dressing
 * @license BSD-3-Clause https://raw.github.com/cornernote/yii-dressing/master/license.txt
 *
 * @package dressing.models
 */
class YdUser extends YdActiveRecord
{

    /**
     * @var integer search by role_id
     */
    public $role_id;

    /**
     * Returns the static model of the specified AR class.
     * @param string $className
     * @return YdUser the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => Yii::t('dressing', 'ID'),
            'email' => Yii::t('dressing', 'Email'),
            'username' => Yii::t('dressing', 'Username'),
            'password' => Yii::t('dressing', 'Password'),
            'first_name' => Yii::t('dressing', 'First Name'),
            'last_name' => Yii::t('dressing', 'Last Name'),
            'role_id' => Yii::t('dressing', 'Roles'),
            'web_status' => Yii::t('dressing', 'Web Login'),
        );
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        $rules = array();

        // search
        if ($this->scenario == 'search') {
            $rules[] = array('id, role_id, username, email, first_name, last_name, web_status, api_status, created, deleted', 'safe', 'on' => 'search');
        }

        // create/update/account
        if (in_array($this->scenario, array('create', 'update', 'account'))) {

            // email
            $rules[] = array('email', 'length', 'max' => 255);
            $rules[] = array('email', 'email');
            $rules[] = array('email', 'unique', 'criteria' => array('condition' => 't.deleted IS NULL'));
            $rules[] = array('email', 'validateEmail');

            // username
            $rules[] = array('username', 'length', 'max' => 255);
            $rules[] = array('username', 'unique', 'criteria' => array('condition' => 'deleted IS NULL'));

            // first_name
            $rules[] = array('first_name', 'length', 'max' => 255);

            // last_name
            $rules[] = array('last_name', 'length', 'max' => 255);

            // phone
            $rules[] = array('phone', 'length', 'max' => 255);
        }

        // create/update
        if (in_array($this->scenario, array('create', 'update'))) {
            // web_status
            $rules[] = array('web_status', 'numerical', 'integerOnly' => true, 'on' => 'create, update');

            // api_status
            $rules[] = array('api_status', 'numerical', 'integerOnly' => true, 'on' => 'create, update');
        }

        return $rules;
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @param array $options
     * @return YdActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search($options = array())
    {
        $criteria = new CDbCriteria;
        $criteria->compare('t.id', $this->id);
        $criteria->compare('t.email', $this->email, true);
        $criteria->compare('t.username', $this->username, true);
        $criteria->compare('t.first_name', $this->first_name, true);
        $criteria->compare('t.last_name', $this->last_name, true);
        $criteria->compare('t.created', $this->created);

        if ($this->web_status === 0 || $this->web_status === '0') {
            $criteria->addCondition('t.web_status=0');
        }
        else {
            $criteria->compare('t.web_status', $this->web_status);
        }
        if ($this->api_status === 0 || $this->api_status === '0') {
            $criteria->addCondition('t.api_status=0');
        }
        else {
            $criteria->compare('t.api_status', $this->api_status);
        }

        if ($this->role_id) {
            $criteria->compare('u2r.role_id', $this->role_id, true);
            $criteria->join .= ' LEFT JOIN user_to_role u2r ON u2r.user_id=t.id AND u2r.role_id=:role_id';
            $criteria->params[':role_id'] = $this->role_id;
        }

        if ($this->deleted == 'deleted') {
            $criteria->addCondition('t.deleted IS NOT NULL');
        }
        else {
            $criteria->addCondition('t.deleted IS NULL');
        }

        return new YdActiveDataProvider($this, CMap::mergeArray(array(
            'criteria' => $criteria,
        ), $options));
    }

    /**
     * @param $plain
     * @param null $encrypted
     * @return boolean validates a password
     */
    public function validatePassword($plain, $encrypted = null)
    {
        $encrypted = $encrypted ? $encrypted : $this->password;
        if (!$plain || !$encrypted) {
            return false;
        }
        $ph = new YdPasswordHash(8, false);
        return $ph->CheckPassword($plain, $encrypted);
    }

    /**
     * @param $plain
     * @return string creates a password hash
     */
    public function hashPassword($plain)
    {
        $ph = new YdPasswordHash(8, false);
        return $ph->HashPassword($plain);
    }

    /**
     *
     */
    public function beforeSave()
    {
        if (!parent::beforeSave()) {
            return false;
        }

        // generate an api key
        if ($this->api_status && empty($this->dbAttributes['api_status'])) {
            $plainApiKey = $this->getApiKey();
            if ($plainApiKey) {
                $this->api_key = $this->hashPassword($plainApiKey);
            }
        }
        if (!$this->api_status) {
            $this->api_key = null;
        }

        // if they have no password - assign password so that forgot password links work
        if ($this->isNewRecord && !$this->password) {
            $this->password = $this->hashPassword(md5(uniqid('', true)));
        }

        return true;
    }

    /**
     * @return string
     */
    public function getApiKey()
    {
        if (!$this->api_status) {
            return '';
        }
        $password = $this->password;
        if (!$password && isset($this->dbAttributes['password'])) {
            $password = $this->dbAttributes['password'];
        }
        if (!$password) {
            return '';
        }
        return md5($password . YII_DRESSING_HASH);
    }

    /**
     * @param $attribute
     * @param $params
     */
    public function validateEmail($attribute, $params)
    {
        if (!$this->web_status) {
            return;
        }
        if (!$this->$attribute) {
            $this->addError($attribute, Yii::t('dressing', 'You must enter an email when Web Login is enabled'));
        }
    }

    /**
     * @param int $user_id
     * @param null $type
     * @return bool
     */
    public function checkUserAccess($user_id, $type = null)
    {
        $user = User::model()->findByPk($user_id);
        if (!$user) {
            return false;
        }
        if ($user->checkAccess('admin')) {
            return true;
        }
        return false;
    }

    /**
     * Performs access check for this user.
     * @param string $roles comma separated list of roles, any role allows access
     * @return boolean whether the operations can be performed by this user.
     */
    public function checkAccess($roles)
    {
        $needRoles = explode(',', $roles);
        $hasRoles = CHtml::listData($this->role, 'id', 'name');
        foreach ($needRoles as $needRole) {
            if (in_array(trim($needRole), $hasRoles)) {
                return true;
            }
        }
        return false;
    }

    /**
     * Retrieves a list of links to be used in grid and menus.
     * @param bool $extra
     * @return array
     */
    public function getMenuLinks($extra = false)
    {
        $links = array();
        $links[] = array('label' => Yii::t('dressing', 'Update'), 'url' => $this->getUrl('update'));
        if ($extra) {
            $more = array();
            $more[] = array('label' => Yii::t('dressing', 'Log'), 'url' => $this->getUrl('log'));
            if (!$this->deleted)
                $more[] = array('label' => Yii::t('dressing', 'Delete'), 'url' => $this->getUrl('delete', array('returnUrl' => Yii::app()->returnUrl->getLinkValue(true))), 'linkOptions' => array('data-toggle' => 'modal-remote'));
            else
                $more[] = array('label' => Yii::t('dressing', 'Undelete'), 'url' => $this->getUrl('delete', array('task' => 'undelete', 'returnUrl' => Yii::app()->returnUrl->getLinkValue(true))), 'linkOptions' => array('data-toggle' => 'modal-remote'));
            $links[] = array(
                'label' => Yii::t('dressing', 'More'),
                'items' => $more,
            );
        }
        return $links;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

}