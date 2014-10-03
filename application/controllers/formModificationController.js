var app = angular.module('formModifcationModule',['ui.bootstrap']);

app.controller('addFormCtrl', ['$scope','$http','$log', function ($scope,$http,$log) {
	$scope.formats = ['dd-MMMM-yyyy', 'yyyy/MM/dd', 'dd.MM.yyyy', 'shortDate'];
	$scope.removed=[];
	$scope.addFormItem=function(type){
		var formItem ={};
		formItem.type=type;
		formItem.guid = guid();
		formItem.validations={};
		formItem.attributes={};
		formItem.new=true;
		$scope.formItems.push(formItem);
	};
	$scope.formItems = [];
	$scope.submit = function(isNew){
		var invalids = $('.ng-invalid');
		if(invalids.length>0){
			invalids.addClass('ng-dirty');
		}
		else{
			for (var i = 0; i < $scope.formItems.length; i++) {
				var item = $scope.formItems[i];
				item.attributes.order=i;
			};
			if(isNew)
			jQuery.post('addformtype.php',{data:{formItems:$scope.formItems,guid:guid(),name:$scope.formName,description:$scope.description}})
			.success(function(){
				$scope.formItems=[]; 
				$scope.formName="";
				$scope.description="";
				$scope.$apply();});
			else{
				jQuery.post('modifyForm.php',{data:{formItems:$scope.formItems,guid:$scope.currentForm,name:$scope.formName,description:$scope.description,removed:$scope.removed}})
			.success(function(){
				$scope.formItems=[]; 
				$scope.removed=[];
				$scope.formName="";
				$scope.description="";
				$scope.$apply();});
		}
			}
		
	};
	$scope.open = function(){
		$scope.opened=true;
	};
	$scope.moveDown=function(key){
		var temp = $scope.formItems[key];
		$scope.formItems[key] = $scope.formItems[key+1];
		$scope.formItems[key+1]=temp;
	};
	$scope.moveUp=function(key){
	var temp = $scope.formItems[key];
		$scope.formItems[key] = $scope.formItems[key-1];
		$scope.formItems[key-1]=temp;
	};
	$scope.getForm=function(form){
		$scope.formName=form.name;
		$scope.description = form.description;
		var temp =$scope;
		$scope.currentForm=form.form_id;
		jQuery.post('getForm.php',{form_id:form.form_id}).success(function(data){
			$scope.formItems=jQuery.parseJSON(data);
			$scope.$apply();
		});

	};
	$scope.getForms=function(){
		var temp =$scope;
		$http({
			method:'GET',
			url:'getForm.php'
		}).success(function(data){
			$scope.forms=data;
		});
	};
	$scope.getForms();

	$scope.removeItem=function(index){
		$scope.removed.push($scope.formItems[index]);
		$scope.formItems.splice(index,1);
	};

	$scope.deleteForm = function(){
		jQuery.post('deleteForm.php',{form_id:$scope.currentForm}).success(function(data){
			$scope.formItems=[];
			$scope.removed=[];
			$scope.formName="";
			$scope.description="";
			$scope.$apply();
			$scope.getForms();
		});
	};
	

}]);

app.directive('addFormType', [function () {
	return {
		restrict: 'E',
		templateUrl:'/templates/addFormTypeTemplate.html'
	};
}]);

app.directive('addInput', [function () {
	return {
		restrict: 'E',
		templateUrl:'/templates/addFormInputTemplate.html'	};
	}]);

app.directive('addNumber', [function () {
	return {
		restrict: 'E',
		templateUrl:'/templates/addFromNumberTemplate.html'	};
	}]);

app.directive('addRadio', [function () {
	return {
		restrict: 'E',
		templateUrl:'/templates/addFromRadioTemplate.html'	};
	}]);
app.directive('addDate', [function () {
	return {
		restrict: 'E',
		templateUrl:'/templates/addFormDateTemplate.html'	};
	}]);
app.directive('addDependency', [function () {
	return {
		restrict:'E',
		templateUrl:'/templates/addDependencyItemTemplate.html'
	};
}])