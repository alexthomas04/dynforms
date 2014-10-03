<?php
require_once 'core/init.php';
$_SESSION['name']='test1';
?>
<head>
<?php  include 'scripts.php'; ?> 
</head>
<body ng-app="SessionModule" ng-controller="sessionCtrl" ng-init="active = 'sessionTest'">
<?php include 'navBar.php';?>
	<div class="form" >
		<label for='sv'>Session Variable</label>
		<input type='text' name="sv" id='sv' ng-model='sv'><br/>
		<label for='vv'>Variable Value</label>
		<input type='text' name="vv" id='vv' ng-model='vv'><br/>
		<button class="btn btn-primary" ng-click="submit()">Submit</button>
		<button class="btn btn-danger" ng-click="reset()">Reset</button>
	
	<table class="table table-hover">
	<thead>
		<th>key</th>
		<th>value</th>
	</thead>
	<tbody>
		<tr ng-repeat="(key, value) in sessionVars">
			<td>{{value.key}}</td>
			<td>{{value.value}}</td>
		</tr>
</tbody>
	</table>
	</div>
</body>

