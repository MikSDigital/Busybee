<?php
namespace App\Core\Validator;

use App\Core\Validator\Constraints\SettingChoiceValidator;
use Symfony\Component\Validator\Constraint;

class SettingChoice extends Constraint
{
	public $name;
	public $strict = true;
	public $extra_choices = [];  // Add additional choices not found in the setting.
	public $message = 'setting.choice.invalid';
	public $valueIn = null;  //  use this key in a layered array

	/**
	 * @return string
	 */
	public function validatedBy()
	{
		return SettingChoiceValidator::class;
	}

	/**
	 * @return array
	 */
	public function getRequiredOptions()
	{
		return [
			'name',
		];
	}
}