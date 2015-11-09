<?php
namespace Bajdzis\PHPForm;

abstract class AbstractInput
{
	static $count = 0;

	var $id;
	var $tagClass;
	var $label;
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
		$this->tagClass = '';
		$this->label = '';
		$this->name = 'unnamed';
		$this->type = 'input';
		$this->parent = array();
		$this->sendValue = null;
		$this->errorMessage = array();
		$additionalInfo = array();
	}

	function setName($name, $parent = null)
	{
		$name = $this->splitName($name);

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
			$this->addErrorValidate('NotSend');
			return false;
		}
		return true;
	}

	function addClass($class)
	{
		if($this->tagClass == '')
		{
			$this->tagClass = trim($class,' ');
		}
		else
		{
			$this->tagClass .= ' '.trim($class,' ');;
		}
	}

	function draw()
	{
		return '<label>'.$this->label.'<input id="'.$this->id.'" class="'.$this->tagClass.'" name="'.$this->name.'" type="'.$this->type.'" >'.$this->drawError().'</label>';
	}

	protected function addErrorValidate($nameError)
	{
		$errorMessage[] = Lang\Language::l($nameError);
	}

	private function drawError()
	{
		$msgError = '';
		foreach ($this->errorMessage as $error)
		{
			echo $error;
			$msgError .= $error;
		}
		return $msgError;
	}

	private function splitName($name)
	{
		$NAME	= 0;
		$ID		= 1;
		$CLASS	= 2;
		$LABEL	= 3;

		$current = $NAME;
		$buffer = '';
		$nameReturn = '';

		$chars = str_split($name);

		foreach ($chars as $char)
		{
			if(($char == '#') && ($current !== $LABEL))
			{
				$this->splitNameSave($current,$buffer);
				$buffer = '';
				$current = $ID;
			}
			elseif(($char == '.') && ($current !== $LABEL))
			{
				$this->splitNameSave($current,$buffer);
				$buffer = '';
				$current = $CLASS;
			}
			elseif($char == '{')
			{
				$this->splitNameSave($current,$buffer);
				$buffer = '';
				$current = $LABEL;
			}
			elseif($char == '}')
			{
				$this->splitNameSave($current,$buffer);
				$buffer = '';
				$current = $NAME;
			}
			else
			{
				if($current === $NAME)
				{
					$nameReturn .= $char;
				}
				else
				{
					$buffer .= $char;
				}
			}
		}
		if($buffer !== '')
		{
			$this->splitNameSave($current,$buffer);
		}
		return $nameReturn;

	}
	private function splitNameSave($type, $value)
	{
		$NAME	= 0;
		$ID		= 1;
		$CLASS	= 2;
		$LABEL	= 3;

		if($type == $ID)
		{
			$this->id = $value;
		}
		elseif($type == $CLASS)
		{
			$this->addClass($value);
		}
		elseif($type == $LABEL)
		{
			$this->label = $value;
		}
	}
}
?>
