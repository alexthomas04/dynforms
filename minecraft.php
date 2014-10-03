<?php
require_once 'core/init.php';
?>
<html>
<head>
	<?php include 'scripts.php';?>
</head>
<body ng-app='minecraftModule' ng-init="active = 'minecraft'">
<?php include 'navBar.php';?>
	<div ng-controller='minecraftController' >
		<div class="col-md-6">
			<h2>Add Item</h2>
			<div class='form-group'>
				<label for='name'>Item name</label>
				<input type='text' name='name' id='name' ng-model='addedItem.ItemName' autocomplete="off"><br/>
				<label >Addtional Info</label>
				<textarea ng-model='addedItem.addtional_info'></textarea><br/>
				<label for='isBlock'>Is Block?</label>
				<input type='checkbox' name='isBlock' id='isBlock' ng-model='addedItem.IsBlock'><br/>
				<label for='isItem'>Is Item?</label>
				<input type='checkbox' name='isItem' id='isItem' ng-model='addedItem.IsItem'><br/>
				<label for='isRaw'>Is Raw?</label>
				<input type='checkbox' name='isRaw' id='isRaw' ng-model='addedItem.IsRaw'><br/>
				<label for='isCraftable'>Is Craftable?</label>
				<input type='checkbox' name='isCraftable' id='isCraftable' ng-model='addedItem.IsCraftable'><br/>
				<div class='craftingSelector' ng-show='addedItem.IsCraftable'>
				<label>Filter:</label> <input type="text" id='craftFilter'>
					<table class='footable table table-bordered' data-filter='#craftFilter'>
						<thead>
							<th data-sort-ignore="true" ></th>
							<th data-sort-initial="true">Item Name</th>
							<th data-sort-ignore="true" >Number of Item</th>
						</thead>
						<tbody>
							<tr ng-repeat='item in items'>
								<td><input type='checkbox' class='' ng-click="" ng-model='checkbox' ng-class="{SelectedForCrafting:checkbox}"></td>
								<td class='itemName'>{{item.name}}</td>
								<td><input type='number'  class='requiredAmount' ng-show='checkbox' value="1"></td>
							</tr>
						</tbody>
						<tfoot class="">
						<tr>
							<td colspan="5">
								<div >
									<ul class="pagination pagination-centered"></ul>
								</div>
							</td>
						</tr>
					</tfoot>
					</table>
					<label>Yeild:</label><input type='number' class='yeild' value="1">
				</div>
				<button ng-click='submit()' class='btn btn-primary'>Submit</button>
			</div>
		</div>
		<div class="col-md-6">
		<h2>View Item</h2>
		Filter : <input type="text" id='filter'>
			<table data-filter='#filter' class="table table-hover footable" data-page-navigation=".pagination" data-limit-navigation='10'>
				<thead>
				<tr>
					<th data-sort-initial="true">Name</th>
					<th data-hide='phone'>Is Block</th>
					<th data-hide='phone'>Is Item</th>
					<th data-hide='phone'>Is Raw Material</th>
					<th data-hide='phone'>Is Craftable</th>
					<th data-sort-ignore="true">Show Crafting</th>
					<th data-hide='all' data-sort-ignore="true">Crafting</th>
					</tr>
				</thead>
				<tbody>
					<tr ng-repeat="item in items" ng-init='' tooltip='{{item.addtional_info}}'>
					<td>{{item.name}}</td>
					<td>{{(item.is_block==1)?'True':'False'}}</td>
					<td>{{(item.is_item==1)?'True':'False'}}</td>
					<td>{{(item.is_raw==1)?'True':'False'}}</td>
					<td>{{(item.is_craftable==1)?'True':'False'}}</td>
					<td><button ng-show="item.is_craftable" ng-click="showCrafting(item);" class="btn btn-success">Show</button></td>
					<td ng-show="item.is_craftable"><span ng-repeat="(key, value) in item.crafting.recipe">{{value.item}}:{{value.required}} <br/>   </span><span class='text-primary'>Yeilds:{{item.crafting.yeild}} </span></td>
					</tr>
				</tbody>
				<tfoot class="">
						<tr>
							<td colspan="5">
								<div >
									<ul class="pagination pagination-centered"></ul>
								</div>
							</td>
						</tr>
					</tfoot>
			</table>
			<img src="loading.gif"  ng-hide=""class='row text-center'>
		</div>
		<hr class="col-md-12">
		<div>
			Amount: <input ng-model='amount' type="number" ng-init="amount=1">
			<table class='table table-border col-md-4'>
				<thead>
					<tr>
						<th>Item Name</th>
						<th>Required Count</th>
					</tr>
				</thead>
				<tbody>
					<tr ng-repeat="(key, value) in craftingItems">
						<td>{{key}}</td>
						<td>{{Math.ceil(value*amount)}}</td>
					</tr>
				</tbody>
				
			</table>
		</div>
	</div>
	<script type="text/javascript">
		function prepareTable(){
					$('.footable').footable();
		}
		</script>
</body>
</html>