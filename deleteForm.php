<?php
require_once 'core/init.php';
if(isset($_POST['form_id'])){
	$form_id = $_POST['form_id'];
	$db=DB::getInstance();
	$db->delete('form_types',array('form_id','=',$form_id));
	$db->delete('form_attributes',array('form_','=',$form_id));
	$db->delete('form_results',array('form_id','=',$form_id));
}