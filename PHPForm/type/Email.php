<?php
namespace Bajdzis\PHPForm\Type;

class Email extends \Bajdzis\PHPForm\AbstractInput
{
	public function validate($array)
	{
		if(!parent::validate($array))
		{
			return false;
		}
		if(!filter_var($this->sendValue, FILTER_VALIDATE_EMAIL))
		{
			$this->addErrorValidate('NoValidMail');
			return false;
		}
		return true;
		
	}
}
?>