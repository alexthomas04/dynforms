<?php
require_once 'core/init.php';
$submit = $_POST['submit'];
if(isset($submit)){
	$db = DB::getInstance();
	$db->insert('form_results',array(
			'result_id'=>$submit['guid'],
			'results'=>json_encode($submit['results']),
			'form_id'=>$submit['form_id']
		));
}