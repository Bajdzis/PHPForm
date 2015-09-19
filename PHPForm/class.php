<?php 
require_once(dirname(__FILE__).'/type.php');

class PHPForm
{
	var $inputTypes;//Global
	var $inputs;
	
	function __construct()
	{
		$inputTypes = array();
		$inputs = array();
		
		$this->addType('text','Input');
		$this->addType('password','Input');
		$this->addType('email','Input');
		$this->addType('select','InputSelect');
	}
	
	function create($inputs, $parent = null)
	{
		reset($inputs);
		if (($parent !== null) && !is_string(key($inputs)))
		{
			$obj = new $this->inputTypes['select'];
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
				$obj = new $this->inputTypes[$type];
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
	
	function addType($name,$class)
	{
		assert (!isset($this->inputTypes[$name]), 'Type '.$name.' is already defined');
		require_once(dirname(__FILE__).'/type/'.$class.'.php');
		$obj = new $class;
		assert (get_parent_class($obj) == 'InputType', $class.' class is not a child InputType');
		$this->inputTypes[$name] = $class;
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