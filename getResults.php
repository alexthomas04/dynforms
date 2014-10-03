<?php
require_once 'core/init.php';
if(isset($_POST['form_id'])){
	$form_id = $_POST['form_id'];
	$db = DB::getInstance();
	$results = $db->get('form_results',array('form_id','=',$form_id))->results();
	foreach ($results as $key => $value) {
		$results[$key]->results = json_decode($value->results);
	}
	echo json_encode($results);
}
else{
	include 'scripts.php';
	?>
	<body ng-app="viewFormModule" ng-init="active = 'viewResult'">
		<?php include 'navBar.php';?>
		<h1>Select Form</h1>
		<div ng-controller="viewController" >
			<div class="col-md-2 col-xs-8">
				<div class="btn-group btn-group-vertical" data-toggle='buttons'>
					<label ng-repeat="(key, value) in forms " ng-click="getResults(value.form_id)" class='btn btn-link' tooltip='{{value.description}}'><input type='radio'>{{value.name}} </label>
				</div>
			</div>
			<div class="col-md-10 col-xs-12 col-lg-10">
				<table class="table table-hover footable" ng-show='form.length>0' data-page-navigation=".pagination" data-limit-navigation='5'>
					<thead>
						<th ng-repeat="(key, formAttr) in form | orderBy:'attributes.order'" >{{formAttr.attributes.name}}<br/></th>
						<!-- <th>Submission Time</th> -->
					</thead>
					<tbody>
						<tr ng-repeat="(key, response) in formResponses">
							<td ng-repeat="(key, formAttr) in form | orderBy:'attributes.order'">{{$parent.response.results[formAttr.att_id]}}</td>
							<!-- <td>{{response.submission_time}}</td> -->
							 <td><span class='glyphicon glyphicon-trash' ng-click='delete(response)'></span></td>
						</tr>
					</tbody>
					<tfoot class="hide-if-no-paging">
						<tr>
							<td colspan="5">
								<div >
									<ul class="pagination pagination-centered"></ul>
								</div>
							</td>
						</tr>
					</tfoot>
				</table>
			</div>
		</div>

		<script type="text/javascript">$('.btn-group').button();
			function prepareTable(){
				if($('table').data('footable'))
					$('table').data('footable').reset();
				$('th').each(function(index, el) {
					if(index >= 7)
						$(el).attr('data-hide', 'all');
					else if (index >= 5)
						$(el).attr('data-hide', 'phone,tablet');
					else if(index >= 2)
						$(el).attr('data-hide', 'phone');
			});//.last().attr('data-hide', '');
				$('table').footable();
			}
		</script>
	</body>


	<?php } ?>
