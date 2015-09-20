<?php
spl_autoload_register(function ($class)
{
	if(strpos($class, 'PHPForm\\') !== 0)
	{
		return false;
	}
	require(dirname(__FILE__).'\\'.substr($class,8).'.php');
	return true;
});

PHPForm\Form::addType('text','Input');
PHPForm\Form::addType('password','Input');
PHPForm\Form::addType('email','Input');
PHPForm\Form::addType('select','InputSelect');

?>