var app = angular.module('SessionModule',[]);

app.controller('sessionCtrl', ['$scope','$http','$log', function ($scope,$http,$log) {
	$scope.sessionVars = [];
	$scope.submit=function(){
		var submission = {};
		submission.name=$scope.sv;
		submission.value=$scope.vv;
		$.post('sessionTestApi.php',submission, function(data, textStatus, xhr) {
			data = $.parseJSON(data);
			$scope.sessionVars = data;
			
			$scope.$apply();
		});
	};
	$scope.submit();
	$scope.reset =  function(){
		$.post('sessionTestApi.php',{reset:true}, function(data, textStatus, xhr) {$scope.sessionVars = [];});
	};
}]);