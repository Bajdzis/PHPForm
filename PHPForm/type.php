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
		if($parent === null or count($parent) <= 1)
		{
			$this->name = $name;
		}
		else
		{
			$parent = array_reverse($parent);
			$parent[] = $name;
			$this->name = $parent[0];
			unset($parent[0]);
			foreach($parent as $value)
			{
				$this->name .= '['.$value.']';
			}
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