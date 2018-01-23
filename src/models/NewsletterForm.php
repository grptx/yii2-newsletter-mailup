<?php

namespace grptx\newsletter\mailup\models;

use stdClass;
use Yii;
use yii\base\Model;

/**
 * Created by PhpStorm.
 * User: gx
 * Date: 12/09/17
 * Time: 16.44
 */
class NewsletterForm extends Model implements INewsletterForm {
	public $first_name;
	public $last_name;
	public $email;
	public $repeatemail;
	public $verifyCode;

	public $city;
	public $phone;
	public $title;
	public $state;
	public $country;
	public $birth_day;
	public $birth_month;
	public $birth_year;


	/**
	 * @inheritdoc
	 */
	public function rules() {
		return [
			[ [ 'first_name', 'email', 'last_name' ], 'required' ],
			[ 'email', 'email' ],
			[ 'verifyCode', 'captcha', 'on' => 'view' ],
			[ [ 'city', 'phone', 'title', 'state', 'country' ], 'string' ],
			[ [ 'birth_day', 'birth_month', 'birth_year' ], 'number', 'required' ],

			[
				'repeatemail',
				'compare',
				'compareAttribute' => 'email',
				'message'          => Yii::t( 'newsletter-mailup', "Emails don't match" )
			]
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels() {
		return [
			'verifyCode'  => Yii::t( 'newsletter-mailup', 'Verification Code' ),
			'first_name'  => Yii::t( 'newsletter-mailup', 'First Name' ),
			'last_name'   => Yii::t( 'newsletter-mailup', 'Last Name' ),
			'city'        => Yii::t( 'newsletter-mailup', 'City' ),
			'phone'       => Yii::t( 'newsletter-mailup', 'Phone' ),
			'title'       => Yii::t( 'newsletter-mailup', 'Title' ),
			'state'       => Yii::t( 'newsletter-mailup', 'State' ),
			'country'     => Yii::t( 'newsletter-mailup', 'Country' ),
			'repeatemail' => Yii::t( 'newsletter-mailup', 'Repeat Email' ),
		];
	}

	public function getExtraFields() {
		$extra = [];
		if($this->city) {
			$field = new stdClass();
			$field->Id = 4;
			$field->Value = $this->city;
			$extra[] = $field;
		}

		if($this->phone) {
			$field = new stdClass();
			$field->Id = 11;
			$field->Value = $this->phone;
			$extra[] = $field;
		}

		if($this->state) {
			$field = new stdClass();
			$field->Id = 5;
			$field->Value = $this->state;
			$extra[] = $field;
		}

		if($this->country) {
			$field = new stdClass();
			$field->Id = 8;
			$field->Value = $this->country;
			$extra[] = $field;
		}

		if($this->title) {
			$field = new stdClass();
			$field->Id = 31;
			$field->Value = $this->title;
			$extra[] = $field;
		}
		
		return $extra;
	}


}