var app = angular.module('viewFormModule', ['ui.bootstrap']);

app.controller('viewController', ['$scope','$http','$log', function ($scope,$http,$log) {
	$scope.getResults = function(guid){
		var temp =$scope;
		$scope.currentForm=guid;
		jQuery.post('getResults.php',{form_id:guid}).success(function(data){
			temp.formResponses=jQuery.parseJSON(data);
			$scope.$apply();

		});
		jQuery.post('getForm.php',{form_id:guid}).success(function(data){
			temp.form=jQuery.parseJSON(data);
			$scope.$apply();
			prepareTable();
		});
	};
	$scope.getForms=function(){
		var temp =$scope;
		$http({
			method:'GET',
			url:'getForm.php'
		}).success(function(data){
			temp.forms=data;
		});

		
	};

	$scope.delete=function(item){
		$.post('deleteResult.php', {result: item}, function(data, textStatus, xhr) {
			$scope.getResults($scope.currentForm);	
		});
	}

	$scope.getForms();
}]);