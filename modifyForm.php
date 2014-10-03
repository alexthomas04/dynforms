<?php
require_once 'core/init.php';
$data = isset($_POST['data'])?$_POST['data']:null;
if(is_null($data)){
	?>
	<head>
		<?php  include 'scripts.php'; ?> 
	</head>
	<body ng-app="formModifcationModule" ng-init="active = 'modifyForm'">
		<?php include 'navBar.php';?>

		<div ng-controller="addFormCtrl" >
			<div class='col-md-2 col-xs-12'>
				<h1>Modify a Form</h1>
				<div id='selection' class='col-md-3 col-xs-12 col-lg-1'>
					<div class="btn-group btn-group-vertical" data-toggle='buttons'>
						<label ng-repeat="(key, value) in forms " ng-click="getForm(value)" class='btn btn-link' tooltip='{{value.description}}'><input type='radio'>{{value.name}} </label>
					</div>
				</div>
			</div>



			
			<form ng-show='formName' class='col-md-2 col-xs-12'>
				<label for='formName'>Form Name</label>
				<input type="text" id='formName' ng-model='formName' required ng-minlength='4' ng-maxlength='36'><br/>
				<label for='formDescription'>Form Description</label>
				<input type="text" id='formDescription' ng-model='description' required ng-minlength='4' ng-maxlength='100'><br/>
				<button class='btn btn-danger' ng-click="deleteForm()" style='' >Delete Form<span class='glyphicon glyphicon-remove'  ></span> </button>

			</form>
			
			<div ng-repeat="(key, value) in formItems" ng-switch on="value.type" ng-init='value.attributes.order=key;'>
				<span ></span>
				<add-input ng-switch-when="text"></add-input>
				<add-number ng-switch-when="number"></add-number>
				<add-radio ng-switch-when="radio"></add-radio>
				<add-date ng-switch-when="date"></add-date>
			</div>
			<br/>
			<add-form-type ng-show='formName'></add-form-type>
			<button ng-show="formItems.length>0" ng-click="submit(false)" class='btn btn-primary'> Submit</button>
		</div>
	</body>
	<?php
}
else{
	$guid = $data['guid'];
	$db = DB::getInstance();
	$db->update('form_types',
		array(
			'id_name'=>'form_id',
			'id'=>$guid
			)
		,array(
			'name'=>$data['name'],
			'description'=>$data['description']
			));
	foreach ($data['formItems'] as $key => $value) {
		if($value['new']){
			$db->insert('form_attributes',array(
				'form_id' =>$guid ,
				'att_id'=>$value['guid'],
				'attributes'=>json_encode($value['attributes']),
				'type'=>$value['type'],
				'validations'=>json_encode($value['validations'])
				));
		}
		else
			{$db->update('form_attributes',
				array(
					'id_name'=>'att_id',
					'id'=>$value['att_id']
					)
				,array(
					'attributes'=>json_encode($value['attributes']),
					'type'=>$value['type'],
					'validations'=>json_encode($value['validations'])
					));
	}	
}
foreach ($data['removed'] as $key => $value) {
	$db->delete('form_attributes',array('att_id','=',$value['att_id']));
}
}

?> 