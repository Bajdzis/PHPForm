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

/*/////////////////////////////////////////////////

OUTPUT :

<input name="name" type="text" >
<input name="e-mail" type="email" >
<select name="profession[profession]" >
	<option value="0">programmer</option>
	<option value="1">other</option>
</select>
<input name="password[first]" type="password" >
<input name="password[repeat]" type="password" >

////////////////////////////////////////////////////*/
?>