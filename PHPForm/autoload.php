<?php

require_once(dirname(dirname(__FILE__)).'/vendor/autoload.php');

Bajdzis\PHPForm\Form::addType('text','Input');
Bajdzis\PHPForm\Form::addType('password','Input');
Bajdzis\PHPForm\Form::addType('email','Email');
Bajdzis\PHPForm\Form::addType('select','InputSelect');
Bajdzis\PHPForm\Form::addType('radio','Radio');

?>
