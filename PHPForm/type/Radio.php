<?php
namespace Bajdzis\PHPForm\Type;

class Radio extends \Bajdzis\PHPForm\AbstractInput
{
	function __construct()
	{
		parent::__construct();
		$this->type = 'radio';
	}

	function draw()
	{
		$s0 = '';
		foreach($this->additionalInfo as $key => $value)
		{
			$s0 .= '<label><input type="radio" id="'.$this->id.'" name="'.$this->name.'" value="'.$key.'" />'.$value.'</label>';
		}
		return $s0;
	}
}
?>
