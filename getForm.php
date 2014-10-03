<?php
require_once 'core/init.php';

$db = DB::getInstance();
//var_dump($_POST);
if(isset($_POST['form_id'])){
	$guid = $_POST['form_id'];
	$formItems = $db->get('form_attributes',array('form_id','=',$guid))->results();
	foreach ($formItems as $key => $formItem) {
		if(isset($formItem->attributes))
			$formItem->attributes = json_decode($formItem->attributes);
		if(isset($formItem->validations))
			$formItem->validations = json_decode($formItem->validations);
	}
	echo json_encode($formItems);
}
else{
	$forms = $db->get('form_types',array('1','=','1'))->results();
	echo json_encode($forms);
}