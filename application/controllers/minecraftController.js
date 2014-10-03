var app= angular.module('minecraftModule',[]);

app.controller('minecraftController',['$scope',function($scope){
	$scope.items = [];
	$scope.Math=window.Math;
	$scope.addedItem={IsBlock:false,IsItem:false,IsRaw:false,IsCraftable:false,crafting:{}};
	var getCraftingItems = function(crafting){
		if(!crafting.recipe)
			return null;
		var componets={};
		for (var i = 0; i < crafting.recipe.length; i++) {
			var componet = crafting.recipe[i];
			var item = getItem(componet.item);
			var yeild = crafting.yeild;
			if(!item.is_craftable || item.is_raw==1 || item.crafting==undefined)
			{
				if(componets[item.name]==undefined)
					componets[item.name]=0;
				componets[item.name]+=componet.required/yeild;
			}
			else if(item.is_craftable && item.crafting!=undefined){
				var temp = getCraftingItems(item.crafting);
				$.each(temp, function(index, val) {
					if(componets[index]==undefined)
						componets[index]=0;
					componets[index]+=val*componet.required/yeild;
				});
			}
		};
		return componets;
	};
	$scope.getCraftingItems=getCraftingItems;
	var getItem = function(itemName){
		for (var i = 0; i < $scope.items.length; i++) {
			var item =$scope.items[i];
			if(item.name == itemName)
				return item;
		};
	};

	$scope.submit=function(){
		var crafting = [];
		$('.SelectedForCrafting').each(function(index, el) {
			var item = $(this).closest('tr');
			var craftingItem = {};
			craftingItem.item = item.children('.itemName').text();
			craftingItem.required = item.children('td').children('.requiredAmount').val();
			
			crafting.push(craftingItem);

		});
		var addedItem = $scope.addedItem;
		addedItem.crafting={};
		addedItem.crafting.recipe = crafting;
		addedItem.crafting.yeild =$('.yeild').val();
		resetInputs();
		$.post('minecraftItems.php', {item:addedItem}, function(data, textStatus, xhr) {
			$scope.items=$.parseJSON(data);
			for (var i = 0; i < $scope.items.length; i++) {
				var item =$scope.items[i];
				item.crafting = $.parseJSON(item.crafting);
				
			};
			$scope.$apply();
			$('.footable').data('footable').reset();
				prepareTable();
		});
	}
	$scope.getItems = function(){
		$.post('minecraftItems.php', {}, function(data, textStatus, xhr) {
			$scope.items=$.parseJSON(data);
			for (var i = 0; i < $scope.items.length; i++) {
				var item =$scope.items[i];
				item.crafting = $.parseJSON(item.crafting);
				
			};
			$scope.$apply();
				prepareTable();
			
		});
	};
	$scope.getItems();

	$scope.showCrafting = function(item){
		var crafting = item.crafting;
		var craftingItems = getCraftingItems(crafting);
		$scope.craftingItems = craftingItems;
	};
	function resetInputs(){
		$('input[type=number]').val('1');
		$('input[type=text]').val('');
		//$('input[type=checkbox]').prop('checked', false);
	}

}]);