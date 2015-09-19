<?php 
require_once(dirname(__FILE__).'/type.php');

class PHPForm
{
	$inputTypes;
	
	function __construct()
	{
		$inputTypes = array();
	}
	
	function addType($name,$class)
	{
		assert (isset($this->inputTypes[$name]), 'Type '.$name.' is already defined');
		require_once(dirname(__FILE__).'/type/'.$class.'.php');
		$obj = new $class;
		assert (get_parent_class($obj) == 'InputType', $class.' class is not a child InputType');
		$this->inputTypes[$name] = $class;
		unset($obj);
		return true;
	}
}
?>