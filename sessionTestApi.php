<?php
require_once 'core/init.php';

if(isset($_POST['name'])){
	$_SESSION[$_POST['name']]=$_POST['value'];
}
if(isset($_POST['reset']) && $_POST['reset']){
	session_unset();
}
$variables = array();
foreach ($_SESSION as $key => $value) {
	$variable=new StdClass;;
	$variable->key = $key;
	$variable->value = $value;
	$variables[] = $variable;
}
echo json_encode($variables);