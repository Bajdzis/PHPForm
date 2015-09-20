<?php
namespace PHPForm\Type;

class InputSelect extends \PHPForm\AbstractInput
{
	function __construct()
	{
		parent::__construct();
		$this->type = 'select';
	}
	
	function draw()
	{
		$s0 = '<select id="'.$this->id.'" name="'.$this->name.'" >';
		foreach($this->additionalInfo as $key => $value)
		{
			$s0 .= '<option value="'.$key.'">'.$value.'</option>';
		}
		$s0 .= '</select>';
		return $s0;
	}
}
?>