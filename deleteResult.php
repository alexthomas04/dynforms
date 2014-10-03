<?php
require_once 'core/init.php';
$result = $_POST['result'];
if(isset($result)){
	$db = DB::getInstance();
	$db->delete('form_results',array('result_id','=',$result['result_id']));
}