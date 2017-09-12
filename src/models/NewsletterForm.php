<?php

namespace grptx\newsletter\mailup\models;

use Yii;
use yii\base\Model;

/**
 * Created by PhpStorm.
 * User: gx
 * Date: 12/09/17
 * Time: 16.44
 */

class NewsletterForm extends Model
{
    public $first_name;
    public $last_name;
    public $email;
    public $verifyCode;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['first_name', 'email', 'last_name'], 'required'],
            ['email', 'email'],
            ['verifyCode', 'captcha'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'verifyCode' => Yii::t('newsletter-mailup', 'Verification Code'),
            'first_name'=>Yii::t('newsletter-mailup', 'First Name'),
            'last_name'=>Yii::t('newsletter-mailup', 'Last Name'),
        ];
    }
}