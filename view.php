<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="stylesheet" href="style.css">
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
		<title>Калькулятор</title>
	</head>
	<body>
		<div class="conteiner">
			<div class="edit_class">
				<div class="right_position">
					<p style="margin:3px 0 0 0; text-align: right;">0</p>
					<h2 style="margin:0 5px 0 0; text-align: right;">0</h2>
				</div>
			</div>
			<div class="figures_class">
				<input type="submit" name="figures" value="7">
				<input type="submit" name="figures" value="8">
				<input type="submit" name="figures" value="9">
				<input type="submit" name="figures" value="4">
				<input type="submit" name="figures" value="5">
				<input type="submit" name="figures" value="6">
				<input type="submit" name="figures" value="1">
				<input type="submit" name="figures" value="2">
				<input type="submit" name="figures" value="3">
				<input class="null" type="submit" name="figures" value="0">
				<input type="submit" name="figures" value=".">
			</div>
			<div class="action_class">
				<input type="submit" name="actionMath" value="/">
				<input type="submit" name="refresh" value="c">
				<input type="submit" name="actionMath" value="*">
				<input type="submit" name="backspase" value=&larr;>
				<input type="submit" name="actionMath" value="-">
				<div class="ravno">
					<input type="submit" name="actionOUT" value="=">
				</div>
				<input type="submit" name="actionMath" value="+">
			</div>
		</div>
		
		<script>
			var action;
			var value1;
			var value2 ;
			var fl;
			var OutSub = 0;
			var error;
			function clear(){
				value1 = "0";
				value2 = "0";
				$('p').css("visibility", "hidden");
				fl = 1;
				action = undefined;
			}
			function uotput(data){
				if(data == "error"){
					clear();
					$('h2').text("error");
				}else{
					value1 = data;
					value2 = data;
					$('h2').text(value2);
				}
			}
			$(document).ready(function(){
				clear();
				$('input[name=figures]').click(function(){
					if(fl === 0){
						fl = 1;
						value1 = "0";
					}						
					if((value1 == "0")&&($(this).val()!=".")){
						value1 = $(this).val();
					}else{
						value1 = value1+$(this).val();
					}
					$('h2').text(value1);
					if($(this).val()==".")
						$('input[value="."]').attr("disabled", "disabled");
				});
				$('input[name=actionMath]').click(function(){
					fl = 0;
					$('input[value="."]').removeAttr("disabled");
					if(value2!="0"){
						ajaxFunction();
						action = $(this).val();
						$('p').append(value1+" "+action+" ");
						$('p').css("visibility","visible");
					}
					else{
						value2 = value1;
						action = $(this).val();
						$('p').text(value1+" "+action+" ");
						$('p').css("visibility","visible");
					}
				});
				$('input[name=actionOUT]').click(function(){
					OutSub = 1;
					if(action != undefined){
						ajaxFunction();
						clear();
					}
				});
					
				function ajaxFunction(){
					$.ajax({
						url: "model.php",
						type: "POST",
						data: ({data1: value1, data2: value2, data3: action}),
						dataType: "html",
						//beforeSend: loading,
						success: uotput
					});
				}
			});

			$('input[name=refresh]').click(function(){
				clear();
				$('h2').text("0");
			});
			$('input[name=backspase]').click(function(){
				if((fl === 1) && (OutSub != 1)){
					value1 = value1.slice(0, -1);
					//value1.charAt(value1.length-1)="";
					$('h2').text(value1);
					if(value1 == ""){
						$('h2').text(value1="0");
					}
				}			
			});
		</script>
	</body>
</html>