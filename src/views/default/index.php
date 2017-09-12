<?php
/**
 * @var $this \yii\web\View
 * @var $model NewsletterForm
 */

use grptx\newsletter\mailup\models\NewsletterForm;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

$this->title = 'Newsletter';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="newsletter-default-index">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        If you have business inquiries or other questions, please fill out the following form to contact us. Thank you.
    </p>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'newsletter-form']); ?>

            <?= $form->field($model, 'first_name')->textInput(['autofocus' => true]) ?>

            <?= $form->field($model, 'last_name') ?>

            <?= $form->field($model, 'email') ?>

            <?= $form->field($model, 'verifyCode')->widget(Captcha::className(), [
                'captchaAction' => '/site/captcha',
                'template' => '<div class="row"><div class="col-lg-3">{image}</div><div class="col-lg-6">{input}</div></div>',
            ]) ?>

            <div class="form-group">
                <?= Html::submitButton('Submit', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>

</div>