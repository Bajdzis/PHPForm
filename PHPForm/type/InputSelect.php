<?php
class InputSelect extends InputType
{
	function __construct()
	{
		$this->type = 'select';
	}
	
	function draw()
	{
		$s0 = '<select name="'.$this->name.'" >';
		foreach($this->additionalInfo as $key => $value)
		{
			$s0 .= '<option value="'.$key.'">'.$value.'</option>';
		}
		$s0 .= '</select>';
		return $s0;
	}
}
?>