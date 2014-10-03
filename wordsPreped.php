<?php
require_once 'core/init.php';
if(isset($_POST['count'])){
	$db=DB::getInstance();
	$rowCount = $db->getCount('words');
	$words=array();
	for ($i=0; $i < $_POST['count']; $i++) { 
		$randNum = rand(0,$rowCount);
		$words[] = $db->get('words',array("id",'=',$randNum))->first()->word;
	}
	echo json_encode($words);
}
else if(isset($_GET['count'])){
	$db=DB::getInstance();
	$rowCount = $db->getCount('words');
	$words=array();
	for ($i=0; $i < $_GET['count']; $i++) { 
		$randNum = rand(0,$rowCount);
		$words[] = $db->get('words',array("id",'=',$randNum))->first()->word;
	}
	echo json_encode($words);
}
else{
	?>
	<!DOCTYPE html>
	<html>
	<head>
		<?php include 'scripts.php';?>
		<link rel="stylesheet" type="text/css" href="bootstrap/bootstrap.css"></link>
		<style type="text/css">
			body{
				color:lime;
				background-color: black;
			}
			button{
				border-color: lime;
				background-color: black;
			}
			#controls{
				right:10px;
				top:20px;
				position: fixed;
			}
		</style>
		<script type="text/javascript" src='jquery-2.0.3.js'></script>
		<title></title>
	</head>
	<body>
			<p><span class='words'></span><span class='changing'></span></p>
		</div>
		<br/><br/><br/><br/>
		<script type="text/javascript">
			//var requestID = window.requestAnimationFrame(getString);
			var intervalId;
			var startTime = new Date();
			var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789\"':;/.,!@#$%^&*(){}[]|\\`~-=_+<> @#$%^&()[]{}<>";
			var noChangeTime= Math.random()*1000+400;
			var code;
			var currentWord=0;
			var loaded=false;
			var loading=false;
			var finished="";
			var cores=8;
			var lines;
			var currentLine=0;
			var speed=40;
			var chance=50;
			var scrollDown ;
			//setInterval(function(){},33);
			$('#options > button').click(function(event) {
				if($(this).prop('id')=="auto")
					useAuto();
				else
					useKeyboard();
			});
			$('#cores-increment').on('click', function(event) {
				event.preventDefault();
				cores++;
				updateCores();
			});
			$('#cores-decrement').on('click', function(event) {
				event.preventDefault();
				if(cores>0)
					cores--;
				updateCores();
			});
			$('#speed-increment').on('click', function(event) {
				event.preventDefault();
				speed+=10;
				updateSpeed();
			});
			$('#speed-decrement').on('click', function(event) {
				event.preventDefault();
				if(speed>10)
					speed-=10;
				updateSpeed();
			});
			$('#chance-increment').on('click', function(event) {
				event.preventDefault();
				chance+=1;
				updateChance();
			});
			$('#chance-decrement').on('click', function(event) {
				event.preventDefault();
				if(chance>1)
					chance-=1;
				updateChance();
			});
			$(document).on('keydown',function(event) {
				getString()
			});

			function updateCores(){
				$('#cores').text(cores);
			}
			function updateChance(){
				$('#chance').text(chance);
			}
			function updateSpeed(){
				clearInterval(intervalId);
				intervalId=setInterval(function(){getString();},speed);
				$('#speed').text(speed);
			}
			function useKeyboard(){
				clearInterval(intervalId);
				clearInterval(scrollDown);
				cores=2;
				chance=2;
				updateCores();
				updateChance();
			}
			function useAuto(){
				intervalId=setInterval(function(){getString();},40);
				cores=8;
				chance=50;
				updateCores();
				updateChance();
				//scrollDown = setInterval(function(){$(document).scrollTop($(document).height());},100);
			}
			updateCores();
			function getString(){
				if(!loaded && !loading)
					getCode();
				else if(loaded && cores>0){
					var operatingCount=0;
					var string = "";
					var line=lines[currentLine];
					var words = line.words;
					var lineFound=true;
					for(var k = 0; k < words.length; k++){
						var word=words[k];
						for (var j = 0; j < word.letters.length; j++) {
							var letter = word.letters[j];
							var prob = Math.random();
							
							if(operatingCount<cores || letter.found==true ){
								if( prob<(1/chance) || letter.found==true){
										string+=letter.finalLetter;
										if(!letter.found)
											operatingCount++;
									letter.found=true;
								}
								else{
									
									string+=possible.charAt(Math.floor(Math.random() * possible.length));
									lineFound=false;
									operatingCount++;
									
								}
							}
							else{
								lineFound=false;
							}
						};
						
						

					}
					string+="&nbsp;";
					if(lineFound){
						finished+=line.line+'</br>';
						currentLine++;
						$('.words').html(finished);
						$('.changing').html('');
						$(document).scrollTop($(document).height());
					}
					else
						$('.changing').html(string);
					if(currentLine==lines.length){
						$('.words').removeClass('words');
						$('.changing').remove();
						$("<p><span class='words'></span><span class='changing'></span></p>").appendTo('.container');
						finished="";
						getWords();
					}
					


				}

			}
			function getWords(){
				loading=true;
				function capitaliseFirstLetter(string)
				{
					return string.charAt(0).toUpperCase() + string.slice(1);
				}
				$.post('words.php', {count:Math.random()*10+1}, function(data, textStatus, xhr) {
					currentLine=0;
					startTime=new Date();
					var words=[];
					var line = data[i];
					var lineData = {};
					lineData.line='';
					lineData.words=words;	
					lines=[];
					lines.push(lineData);
					data=$.parseJSON(data);
					for (var i = data.length - 1; i >= 0; i--) {
						var word = data[i];
						if(Math.random()>.8)
							word = capitaliseFirstLetter(word);
						var wordData = {};
						words.push(wordData);
						wordData.word=word;
						wordData.letters=[];
						for (var j = 0, len = word.length; j < len; j++) {
							var letter = word[j];
							var letterData = {};
							if(letter != '\n'){
								wordData.letters.push(letterData);
								letterData.finalLetter = letter;
							}
						}
					};
					for (var i = 0; i < words.length; i++) {
						var word =words[i];
						lineData.line+=word.word;
					};
					loading=false;
					loaded=true;
		//window.requestAnimationFrame(getString);
	});	

}
function getCode(){
	loading=true;
	$.post('code.txt', {param1: 'value1'}, function(data, textStatus, xhr) {
		startTime=new Date();
		lines=[];
		
		data = $('<div/>').text(data).html();
		data = data.split('\n');
		for (var i = 0; i < data.length; i++) {
			var line = data[i];
			var lineData = {};
			lineData.line=line;
			lines.push(lineData);
			lineData.words=[];
			var words=line.split(' ');
			for (var k = 0; k < words.length; k++) {
				var word = words[k]+' ';
				var wordData={};
				lineData.words.push(wordData);
				wordData.word=word;
				wordData.letters=[];
				for (var j = 0, len = word.length; j < len; j++) {
					var letter = word[j];
					var letterData = {};
					letterData.found=false;
					wordData.letters.push(letterData);
					if(letter=='\t')
						letterData.finalLetter='&nbsp;&nbsp;&nbsp;&nbsp;';
					else if(letter==' ')
						letterData.finalLetter='&nbsp;';
					else
						letterData.finalLetter = letter;
				}
				wordData.word=word;
			};
			lineData.line =lineData.line.replace(new RegExp(' ', 'g'), '&nbsp;').replace(new RegExp('\t', 'g'), '&nbsp;&nbsp;&nbsp;&nbsp;');
			console.log(lineData.line);


		};
		loading=false;
		loaded=true;
	});
}
useKeyboard();
</script>
</body>
</html>


<?php } ?> 