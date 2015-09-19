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
		foreach($inputs as $name => $type)
		{
			if(is_array($type)){
				reset($type);
				if(is_string(key($type)))
				{
					$this->create($type, $name);
				}
				else
				{
					$obj = new $this->inputTypes['select'];
					$obj->setName($name,$parent);
					$obj->setAdditionalInfo($type);
					$this->inputs[] = $obj;
				}
	
			}
			else
			{
				$obj = new $this->inputTypes[$type];
				$obj->setName($name,$parent);
				$this->inputs[] = $obj;
			}
			
		}
		
	}
	
	function draw()
	{
		$s0 = '<form action="" method="post">';
		foreach($this->inputs as $input)
		{
			$s0 .= $input->draw();
		}
		return $s0.'<input type="submit" value="send" /></form>';
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
}
?>