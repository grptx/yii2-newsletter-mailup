<?php

namespace grptx\newsletter\mailup\controllers;

use grptx\newsletter\mailup\models\NewsletterForm;
use grptx\newsletter\mailup\Module;
use grptx\newsletter\mailup\wrapper\MailUpClient;
use stdClass;
use Yii;
use yii\web\Controller;
use yii\web\Response;

/**
 * Default controller for the `newsletter` module
 */
class DefaultController extends Controller
{
	/**
	 * @inheritdoc
	 */
	public function actions()
	{
		return [
			'error' => [
				'class' => 'yii\web\ErrorAction',
			],
			'captcha' => [
				'class' => 'yii\captcha\CaptchaAction',
				'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
			],
		];
	}

	public function actionAjaxCall(){
		/** @var NewsletterForm $model */
		$model = new NewsletterForm();

		Yii::$app->response->format = Response::FORMAT_JSON;
		$data = Yii::$app->request->post();
		$model->email = $data['email'];
		$model->first_name = $data['first_name'];
		$model->last_name = $data['last_name'];

		if (Yii::$app->request->isAjax && $model->validate()) {
			/** @var Module $module */
			$module = Module::getInstance();

			$MAILUP_CLIENT_ID = $module->client_id;
			$MAILUP_CLIENT_SECRET = $module->client_secret;
			$MAILUP_CALLBACK_URI = $module->callback_uri;
			$MAILUP_USERNAME = $module->username;
			$MAILUP_PASSWORD = $module->password;

			// Initializing MailUpClient
			$mailUp = new MailUpClient($MAILUP_CLIENT_ID, $MAILUP_CLIENT_SECRET, $MAILUP_CALLBACK_URI);
			$mailUp->logOnWithPassword($MAILUP_USERNAME, $MAILUP_PASSWORD);

			$data = new stdClass();
			$data->Fields[0] = new stdClass();
			$data->Fields[0]->Id = 1;
			$data->Fields[0]->Value = $model->first_name;

			$data->Fields[1] = new stdClass();
			$data->Fields[1]->Id = 2;
			$data->Fields[1]->Value = $model->last_name;

			$data->Email = $model->email;

			$url = $mailUp->getConsoleEndpoint() . "/Console/Group/" . $module->group . "/Recipient?ConfirmEmail=true";
			$result = $mailUp->callMethod($url, "POST", json_encode($data), "JSON");

			if ($result) {
				return ['result'=>'ok'];
			}
		}
		$result = [
			'result'=>'ko',
			'error'=>'',
		];
		$model_errors = $model->getErrors();
		if(count($model_errors)>0) {
			$result['error']=array_pop($model_errors)[0];
		}
		return $result;
	}

	/**
	 * Renders the index view for the module
	 * @return string
	 */
	public function actionIndex()
	{
		/** @var NewsletterForm $model */
		$model = new NewsletterForm();
		$model->scenario = 'view';

		if ($model->load(Yii::$app->request->post()) && $model->validate()) {
			/** @var Module $module */
			$module = Module::getInstance();

			$MAILUP_CLIENT_ID = $module->client_id;
			$MAILUP_CLIENT_SECRET = $module->client_secret;
			$MAILUP_CALLBACK_URI = $module->callback_uri;
			$MAILUP_USERNAME = $module->username;
			$MAILUP_PASSWORD = $module->password;

			// Initializing MailUpClient
			$mailUp = new MailUpClient($MAILUP_CLIENT_ID, $MAILUP_CLIENT_SECRET, $MAILUP_CALLBACK_URI);
			$mailUp->logOnWithPassword($MAILUP_USERNAME, $MAILUP_PASSWORD);

			$data = new stdClass();
			$data->Fields[0] = new stdClass();
			$data->Fields[0]->Id = 1;
			$data->Fields[0]->Value = $model->first_name;

			$data->Fields[1] = new stdClass();
			$data->Fields[1]->Id = 2;
			$data->Fields[1]->Value = $model->last_name;

			$data->Email = $model->email;


			$url = $mailUp->getConsoleEndpoint() . "/Console/Group/" . $module->group . "/Recipient?ConfirmEmail=true";
			$result = $mailUp->callMethod($url, "POST", json_encode($data), "JSON");

			if ($result) {
				Yii::$app->session->setFlash('success', Yii::t('newsletter-mailup','Thank you for registering. Please check your email and confirm your address.'));
			} else {
				Yii::$app->session->setFlash('error', Yii::t('newsletter-mailup','There was an error in the registration process. try later'));
			}

			return $this->refresh();

		} else {
			return $this->render('index', [
				'model' => $model,
			]);
		}

	}
}
