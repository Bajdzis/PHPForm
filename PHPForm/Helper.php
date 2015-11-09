<?php
namespace Bajdzis\PHPForm;

class Helper
{

	static function splitType($typePram = "")
	{
		$NAME	= 0;
		$OPTION	= 1;

		$temp = array();
		$current = $NAME;
		$buffor = "";

		foreach (str_split($typePram) as $char)
		{
			if(($current == $OPTION) && ($char == ';'))
			{
				$temp["option"][] = $buffor;
				$buffor = "";
			}
			elseif($char == '{')
			{
				$temp["name"] = $buffor;
				$temp["option"] = array();
				$current = $OPTION;
				$buffor = "";
			}
			elseif(($current == $OPTION) && ($char == '}'))
			{
				$temp["option"][] = $buffor;
				return $temp;
			}
			else
			{
				$buffor .= $char;
			}

		}

		if($current != $OPTION)
		{
				$temp["name"] = $buffor;
				$temp["option"] = array();
		}else{
				$temp["option"][] = $buffor;

		}

		return $temp;
	}
}
?>
