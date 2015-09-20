<?php
namespace PHPForm;

abstract class AbstractInput
{
	static $count = 0;	

	var $id;
	var $name;
	var $type;
	var $parent;
	var $sendValue;
	var $errorMessage;
	var $additionalInfo;

	function __construct()
	{
		self::$count++;
		
		$this->id = 'unnamed'.self::$count;
		$this->name = 'unnamed';
		$this->type = 'input';
		$this->parent = array();
		$this->sendValue = null;
		$this->errorMessage = array();
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
	
	function isSend($array)
	{
		if(count($this->parent) == 0 && isset($array[$this->name]))
		{
			$this->sendValue = $array[$this->name];
			return true;
		}
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
		$this->sendValue = $array;
		return true;
	}
	
	function validate($array)
	{
		if(!$this->isSend($array))
		{
			$this->addErrorValidate('NotSend',$this->name);
			return false;
		}
		return true;
	}
	
	function draw()
	{
		return '<input id="'.$this->id.'" name="'.$this->name.'" type="'.$this->type.'" >';
	}
	
	private function addErrorValidate($name, $value)
	{
		
		
	}
}
?>