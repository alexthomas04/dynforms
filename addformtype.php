<?php
require_once 'core/init.php';
$data = isset($_POST['data'])?$_POST['data']:null;
if(is_null($data)){
	?>
	<head>
		<?php  include 'scripts.php'; ?> 
	</head>
	<body ng-app="formModifcationModule" ng-init="active = 'addForm'">
	<?php include 'navBar.php';?>

		<div ng-controller="addFormCtrl" ng-init="resetOrder()">
			<h1>Create a new Form</h1>
			<form>
				<label for='formName'>Form Name</label>
				<input type="text" id='formName' ng-model='formName' required ng-minlength='4' ng-maxlength='36'><br/>
				<label for='formDescription'>Form Description</label>
				<input type="text" id='formDescription' ng-model='description' required ng-minlength='4' ng-maxlength='100'><br/>

			</form>
			<div ng-repeat="(key, value) in formItems" ng-switch on="value.type" ng-init='value.attributes.order=key;'>
				<span ></span>
				<add-input ng-switch-when="text"></add-input>
				<add-number ng-switch-when="number"></add-number>
				<add-radio ng-switch-when="radio"></add-radio>
				<add-date ng-switch-when="date"></add-date>
				<!-- <add-dependency ng-switch-when='dependency'></add-dependency> -->
			</div>
			<br/>
			<add-form-type></add-form-type>
			<button ng-show="formItems.length>0" ng-click="submit(true)" class='btn btn-primary'> Submit</button>
		</div>
	</body>
	<?php
}
else{
	$guid = $data['guid'];
	$db = DB::getInstance();
	var_dump($data);
	$db->insert('form_types',array(
		'form_id'=>$guid,
		'name'=>$data['name'],
		'description'=>$data['description']
		));
	foreach ($data['formItems'] as $key => $value) {
		$db->insert('form_attributes',array(
			'form_id' =>$guid ,
			'att_id'=>$value['guid'],
			'attributes'=>json_encode($value['attributes']),
			'type'=>$value['type'],
			'validations'=>json_encode($value['validations'])
			));
	}
}

?> 