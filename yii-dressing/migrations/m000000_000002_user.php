<?php
/**
 * Class m000000_000002_user
 *
 * @author Brett O'Donnell <cornernote@gmail.com>
 * @author Zain Ul abidin <zainengineer@gmail.com>
 * @copyright 2013 Mr PHP
 * @link https://github.com/cornernote/yii-dressing
 * @license http://www.gnu.org/copyleft/gpl.html
 */
class m000000_000002_user extends YdDbMigration
{
    /**
     *
     */
    function safeUp()
    {
        $this->import('m000000_000002_user.sql');
    }
}