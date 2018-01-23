<?php
namespace grptx\newsletter\mailup\models;

interface INewsletterForm {
	public function rules();

	public function getExtraFields();
}