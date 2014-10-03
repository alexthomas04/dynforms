var app = angular.module('FormModule', ['ui.bootstrap']);

app.controller('FormController', ['$scope','$http','$log', function ($scope,$http,$log) {
	this.forms=[];

	$scope.results={};
	this.getForms=function(){
		var temp =this;
		$http({
			method:'GET',
			url:'getForm.php'
		}).success(function(data){
			temp.forms=data;
		});
	};
	this.getForms();
	this.getForm=function(guid){
		var temp =this;
		$scope.currentForm=guid;
		jQuery.post('getForm.php',{form_id:guid}).success(function(data){
			temp.form=jQuery.parseJSON(data);
			$scope.$apply();
		});

	};
	$scope.getValidationPattern = function(validations){
		if(validations == null)
			return new RegExp("(.{"+"0,"+'})','i');
		if(validations.pattern){
			return validations.pattern;
		}
		else{
			var min="",max="";
			if(validations.minChar)
				min=validations.minChar;
			if(validations.maxChar)
				max=validations.maxChar;
			return new RegExp("(.{"+min+","+max+'})','i');
		}
	};
	$scope.submit = function(){
		var invalids = $('.ng-invalid');
		if(invalids.length>0){
			invalids.addClass('ng-dirty');
		}
		else{
			var results = {};
			for (var key in this.formCtrl.form) {
				var form = this.formCtrl.form[key];
				results[form.att_id] = form.result;
			};
			$('.btn-group-vertical > div.active > input').each(function(index, el) {
				var id = $(el).attr('data-id');
				var value = $(el).attr('value');
				results[id] = value;
			});
			$log.log(results);
			var submit = {};
			submit.results = results;
			submit.form_id = $scope.currentForm;
			submit.guid = guid();
			jQuery.post('submitForm.php',{submit:submit});
			this.formCtrl.form=null;
			$scope.$apply();
		}
	};
}])

app.directive('repeatDirective', function() {
	return function(scope, element, attrs) {
		if (scope.$last){
			jQuery('.btn-group').button();
		}
	};
})

app.directive('formInput', [function () {
	return {
		restrict: 'E',
		templateUrl:'templates/FormInputTemplate.html'
	};
}]);

app.directive('formNumber', [function () {
	return {
		restrict: 'E',
		templateUrl:'templates/FormNumberTemplate.html'
	};
}]);

app.directive('formRadio', [function () {
	return {
		restrict: 'E',
		templateUrl:'templates/FormRadioTemplate.html'
	};
}]);

app.directive('formDate', [function () {
	return {
		restrict: 'E',
		templateUrl:'templates/FormDateTemplate.html'
	};
}]);