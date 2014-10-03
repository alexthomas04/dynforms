<?php
require_once 'core/init.php';
include 'scripts.php'; ?>
<body ng-app="FormModule" ng-controller="FormController as formCtrl" ng-init="active = 'viewForm'">
<?php include 'navBar.php';?>
	<h1 class='col-md-12'>Select Form</h1>
	<div id='selection' class='col-md-6 col-xs-12 col-lg-4'>
<div class="btn-group btn-group-vertical" data-toggle='buttons'>
				<label ng-repeat="(key, value) in formCtrl.forms " ng-click="formCtrl.getForm(value.form_id)" class='btn btn-link' tooltip='{{value.description}}'><input type='radio'>{{value.name}} </label>
			</div>
		
	</div>
	<div id='result' class='col-md-6 col-xs-12 col-lg-8'>
		<form>
			<div ng-repeat="formItem in formCtrl.form | orderBy : 'attributes.order'" ng-switch on="formItem.type" class='form' repeat-directive>
				<form-input ng-switch-when="text"></form-input>
				<form-number ng-switch-when="number"></form-number>
				<form-radio ng-switch-when="radio"></form-radio>
				<form-date ng-switch-when="date"></form-date>
			</div>
		</form>
		<button class='btn btn-primary' ng-click="submit()" ng-show='formCtrl.form'>Submit</button>
	</div>
</body>