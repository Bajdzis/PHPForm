<?php
abstract class InputType
{
	var $name;
	var $type;
	var $additionalInfo;
	
	function __construct()
	{
		$this->name = 'unnamed';
		$this->type = 'input';
		$additionalInfo = array();
	}
	
	function setName($name, $parent = null)
	{
		if($parent === null)
		{
			$this->name = $name;
		}
		else
		{
			$this->name = $parent.'['.$name.']';
		}
	}
	
	function setType($name)
	{
		$this->type = $name;
	}
	
	function setAdditionalInfo($additionalInfo, $index = null)
	{
		if($index === null)
		{
			$this->additionalInfo = $additionalInfo;
		}
		else
		{
			$this->additionalInfo[$index] = $additionalInfo;
		}
	}
	
	function draw()
	{
		return '<input name="'.$this->name.'" type="'.$this->type.'" >';
	}
}
?>