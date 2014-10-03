<?php
require_once 'core/init.php';
if(isset($_POST['timeings'])){
	$timeings = $_POST['timeings'];
	$db=DB::getInstance();
	$db->insert('times',array(
'destination'=>$timeings['destination'],
'times'=>json_encode($timeings['times']),
'startTime'=>$timeings['startTime']
		));
}
else{
	?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
	<?php include 'scripts.php';?>
	<style type="text/css">
		.sumbit{
			display: none;
		}
	</style>
</head>
<body>
	<div class="destinations">
		<button class="btn destination">To Work</button>
		<button class="btn destination">To Home</button>
		
	</div>
	<div class="Next_Stop" style="display:none">
		<p class="stop"></p>
		<button class="arrive btn btn-success">Arrive</button>
		<button class="btn btn-danger submit">Submit</button>
	</div>
	<script type="text/javascript">
		var timeings = {};
		timeings.currentStop=0;
		timeings.times={};
		$(document).ready(function () {
			$('.destination').on('click',function(event) {
				event.preventDefault();
				$('.destinations').hide();
				timeings.destination = $(this).text();
				setCheckPoints();
				timeings.startTime=new Date().getTime();
				$('.Next_Stop').show();
				$('.stop').text(timeings.checkpoints[timeings.currentStop]);
			});
			$('.arrive').on('click',function(event) {
				event.preventDefault();
				timeings.times[timeings.checkpoints[timeings.currentStop]]=new Date().getTime();
				timeings.currentStop++;
				if(timeings.currentStop<timeings.checkpoints.length){
					$('.stop').text(timeings.checkpoints[timeings.currentStop]);
				}else{
					$('.stop , .arrive').hide();
					$('.submit').show();
				}
			});
			$('.submit').on('click',function(event) {
				event.preventDefault();
				$.post('timer.php', {'timeings':timeings}, function(data, textStatus, xhr) {
					/*optional stuff to do after success */
				});
			});
		});
		function setCheckPoints(){
			// switch(timeings.destination)
			// {
			// 	case 'To Home':
			// 	timeings.checkpoints = ['Prepare to leave office','Leave office','Board Bus','Exit Bus','Board Train','Leave Station','Silver Springs','Dunwoody','Medical Center','Buckhead','Lindburge','Arts Center','Arrive at Car','Enter Car','Arrive At home'];
			// 	break;
			// }
			 	timeings.checkpoints = ['Prepare to leave office','Leave office','Board Bus','Exit Bus','Board Train','Leave Station','Silver Springs','Dunwoody','Medical Center','Buckhead','Lindburge','Arts Center','Arrive at Car','Enter Car','Arrive At home'];
			 	if(timeings.destination == 'To Work')
			 		timeings.checkpoints = timeings.checkpoints.reverse();

		}


	</script>
</body>
</html>




<?php } ?>