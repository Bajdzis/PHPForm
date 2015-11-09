<?php
include('../PHPForm/autoload.php');

$form_array = array(
	'name' => 'text',
	'e-mail#IDMail.class{Enter your email address}' => 'email',
	'profession' => 'select{programmer;other}',
	'male' => 'radio{yes;no}',
	'password' => array(
		'first' => 'password',
		'repeat' => 'password'
	)
);

$form = new Bajdzis\PHPForm\Form();

$form->create($form_array);

if($form->isSend($_POST))
{
	echo 'Form send !';
	echo 'Valid - '.(($form->validate($_POST))?'ok':'failure');
	echo $form->draw();
}
else
{
	echo '<form action="" method="post">';
	echo $form->draw();
	echo '<input type="submit">';
	echo '</form>';
}

/*/////////////////////////////////////////////////

OUTPUT :

<label><input id="unnamed6" class="" name="name" type="text" ></label>
<label>Enter your email address<input id="IDMail" class="class" name="e-mail" type="email" ></label>
<select id="unnamed8" name="profession">
	<option value="0">programmer</option>
	<option value="1">other</option>
</select>
<label><input type="radio" id="unnamed9" name="male" value="0" />yes</label>
<label><input type="radio" id="unnamed9" name="male" value="1" />no</label>
<label><input id="unnamed10" class="" name="password[first]" type="password" ></label>
<label><input id="unnamed11" class="" name="password[repeat]" type="password" ></label>

////////////////////////////////////////////////////*/
?>
