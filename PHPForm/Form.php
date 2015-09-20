<?php 
namespace PHPForm;

use PHPForm\Type;

class Form
{
	static $inputTypes = array();
	var $inputs;
	
	function __construct()
	{
		$inputs = array();
	}
	
	function create($inputs, $parent = null)
	{
		reset($inputs);
		if (($parent !== null) && !is_string(key($inputs)))
		{
			$className = self::$inputTypes['select'];
			$obj = new $className;
			$obj->setName($parent[count($parent)-1],$parent);
			$obj->setAdditionalInfo($inputs);
			$this->inputs[] = $obj;
			return 0;
		}
			
		foreach($inputs as $name => $type)
		{
			if(is_array($type))
			{
				$this->create($type, $this->addParent($parent, $name));
			}
			else
			{
				$className = self::$inputTypes[$type];
				$obj = new $className;
				$obj->setName($name,$parent);
				$obj->setType($type);
				$this->inputs[] = $obj;
			}
			
		}
		
	}
	
	function draw()
	{
		$s0 = '';
		foreach($this->inputs as $input)
		{
			$s0 .= $input->draw();
		}
		return $s0;
	}
	
	function isSend($array)
	{
		foreach($this->inputs as $input)
		{
			if(!$input->isSend($array))
			{
				return false;
			}
		}
		return true;
	}
	
	function validate($array)
	{
		foreach($this->inputs as $input)
		{
			if(!$input->validate($array))
			{
				return false;
			}
		}
		return true;
	}
	
	static function addType($name,$class)
	{
		assert (!isset(self::$inputTypes[$name]), 'Type '.$name.' is already defined');
		$class = '\PHPForm\\Type\\'.$class;
		$obj = new $class;
		assert (get_parent_class($obj) == 'PHPForm\\AbstractInput', $class.' class is not a child PHPForm\\AbstractInput');
		self::$inputTypes[$name] = $class;
		unset($obj);
		return true;
	}
	
	function addParent($currentParent, $addParent)
	{
		if($currentParent === null)
		{
			$currentParent = array();
		}
		$currentParent[] = $addParent;
		return $currentParent;
		
	}
}
?>