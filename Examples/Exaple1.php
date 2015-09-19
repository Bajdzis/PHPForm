<?php
include('../PHPForm/class.php');

$form_array = array(
	'name' => 'text',
	'e-mail' => 'email',
	'profession' => array('programmer','other'),
	'password' => array(
		'first' => 'password',
		'repeat' => 'password'
	)
);

$form = new PHPForm();

$form->create($form_array);

echo $form->draw();

?>