<?php
/**
 * YdReCaptcha
 *
 * @author Brett O'Donnell <cornernote@gmail.com>
 * @author Zain Ul abidin <zainengineer@gmail.com>
 * @copyright 2013 Mr PHP
 * @link https://github.com/cornernote/yii-dressing
 * @license BSD-3-Clause https://raw.github.com/cornernote/yii-dressing/master/license.txt
 *
 * @package dressing.components
 */
class YdReCaptcha extends CApplicationComponent
{

    /**
     * @var string
     */
    public $publicKey = '6LeBItQSAAAAAG_umhiD0vyxXbDFbVMPA0kxZUF6';
    /**
     * @var string
     */
    public $privateKey = '6LeBItQSAAAAALA4_G05e_-fG5yH_-xqQIN8AfTD';

    /**
     * @var string
     */
    public $server = 'http://www.google.com/recaptcha/api';

    /**
     * @var string
     */
    public $secureServer = 'https://www.google.com/recaptcha/api';

    /**
     * @var string
     */
    public $verifyServer = 'www.google.com';


}