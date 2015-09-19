<?php
abstract class InputType
{
	var $name;
	var $type;
	var $parent;
	var $additionalInfo;
	
	function __construct()
	{
		$this->name = 'unnamed';
		$this->type = 'input';
		$this->parent = array();
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
			$parent = array_reverse($parent);
			$parent[] = $name;
			$this->parent = $parent;
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
	
	function validate($array)
	{
		foreach($this->parent as $value)
		{
			if(isset($array[$value]))
			{
				$array = $array[$value];
			}
			else
			{
				return false;
			}
		}
		return true;
	}
	
	function draw()
	{
		return '<input name="'.$this->name.'" type="'.$this->type.'" >';
	}
}
?>