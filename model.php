<?
	$val1 = $_POST['data1']*1;
	$val2 = $_POST['data2']*1;
	$action = $_POST['data3'];
	switch ($action){
		case "/":
			if($val1 == 0){
				$result = "error";
				break;
			}else{
				$result = $val2/$val1;
				break;
			}
		case "*":
			$result = $val2*$val1;
			break;
		case "-":
			$result = $val2-$val1;
			break;
		case "+":
			$result = $val2+$val1;
			break;
	}
	echo $result;
?>