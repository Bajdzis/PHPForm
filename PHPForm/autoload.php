<?php

require_once(dirname(dirname(__FILE__)).'/vendor/autoload.php');

PHPForm\Form::addType('text','Input');
PHPForm\Form::addType('password','Input');
PHPForm\Form::addType('email','Email');
PHPForm\Form::addType('select','InputSelect');

?>