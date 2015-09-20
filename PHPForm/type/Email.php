<?php
namespace PHPForm\Type;

class Email extends \PHPForm\AbstractInput
{
	public function validate($array)
	{
		if(parent::validate($array))
		{
			return filter_var($this->sendValue, FILTER_VALIDATE_EMAIL);
		}
		return false;
	}
}
?>