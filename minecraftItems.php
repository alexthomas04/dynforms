<?php
require_once 'core/init.php';
$db=DB::getInstance();
//var_dump($_POST);
if(isset($_POST['item'])){
	$item = $_POST['item'];
	if(!isset($item['addtional_info']))
		$item['addtional_info']='';
	$db->insert('minecraft_items',array(
		'name'=>$item['ItemName'],
		'is_block'=>filter_var($item['IsBlock'], FILTER_VALIDATE_BOOLEAN),
		'is_item'=>filter_var($item['IsItem'], FILTER_VALIDATE_BOOLEAN),
		'is_raw'=>filter_var($item['IsRaw'], FILTER_VALIDATE_BOOLEAN),
		'is_craftable'=>filter_var($item['IsCraftable'], FILTER_VALIDATE_BOOLEAN),
		'crafting'=>json_encode($item['crafting']),
		'addtional_info'=>$item['addtional_info']
		));
}
echo json_encode($db->get('minecraft_items',array('1','=','1'))->results());