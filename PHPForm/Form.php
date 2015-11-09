<?php
namespace Bajdzis\PHPForm;

use Bajdzis\PHPForm\Type;
use Bajdzis\PHPForm\Lang;

class Form
{
	static $inputTypes = array();

	var $inputs;

	function __construct($language = 'English')
	{
		$inputs = array();
		Lang\Language::setLanguage($language);
	}

	function create($inputs, $parent = null)
	{
		foreach($inputs as $name => $type)
		{
			if(is_array($type))
			{
				$this->create($type, $this->addParent($parent, $name));
			}
			else
			{
				$typeArray = Helper::splitType($type);
				$className = self::$inputTypes[$typeArray["name"]];
				$obj = new $className;
				$obj->setName($name,$parent);
				$obj->setType($typeArray["name"]);
				$obj->setAdditionalInfo($typeArray["option"]);
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
		$class = '\\Bajdzis\\PHPForm\\Type\\'.$class;
		$obj = new $class;
		assert (get_parent_class($obj) == 'Bajdzis\\PHPForm\\AbstractInput', $class.' class is not a child PHPForm\\AbstractInput');
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
