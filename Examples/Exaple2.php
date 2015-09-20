<?php
include('../PHPForm/autoload.php');

$form_array = array(
	'name' => 'text',
	'e-mail' => 'email',
	'profession' => array('programmer','other'),
	'password' => array(
		'first' => 'password',
		'repeat' => 'password'
	)
);

$form = new PHPForm\Form();

$form->create($form_array);

if($form->isSend($_POST))
{
	echo 'Form send !';
	echo 'Valid - '.(($form->validate($_POST))?'ok':'failure');
}
else
{
	echo '<form action="" method="post">';
	echo $form->draw();
	echo '<input type="submit">';
	echo '</form>';
}
?>