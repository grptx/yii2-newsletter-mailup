<?php

namespace grptx\newsletter\mailup;

use Yii;

/**
 * newsletter module definition class
 */
class Module extends \yii\base\Module
{

    public $client_id;
    public $client_secret;
    public $callback_uri;
    public $username;
    public $password;
    public $group;

    public $formModelClass;

    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'grptx\newsletter\mailup\controllers';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        // custom initialization code goes here
        // set up i8n
        if (empty(Yii::$app->i18n->translations['newsletter-mailup'])) {
            Yii::$app->i18n->translations['newsletter-mailup'] = [
                'class' => 'yii\i18n\PhpMessageSource',
                'basePath' => __DIR__ . '/messages',
            ];
        }

        if(!$this->formModelClass) {
        	$this->formModelClass = 'grptx\newsletter\mailup\models\NewsletterForm';
        }
    }
}
