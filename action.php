<?php
    
    error_reporting(E_ALL ^ E_NOTICE);
    
    include 'var/finalvar.php';

	$gfile = $d['action']['path'];
	$old = $d['action']['old'];

	copy($gfile, $old);

	$fdset = array();
	$myfile = fopen($gfile, "r") or die("Unable to open file!");

while (!feof($myfile)) {

	$row = fgets($myfile);
	
	$t = strpos($row, ']');
	$n = strpos($row, '=');
	$s = strpos($row, ';');

	if ($n) {

		$key = substr($row, 0, $n);
	} else {

		$key = $row;
	}

	//$fdset[] = $key;
	$fdset[] = $row;

}

fclose($myfile);

$fp = fopen($gfile, 'w');

$i = 1;
foreach ($fdset as $val) {

	$s = strpos($val, ';');
	$b = strpos($val, ']');
	$e = strpos($val, '=');
	
	if ($s === 0){
		fwrite($fp, $val);
	}else if($b){
		fwrite($fp, $val);
	}else if($e){
		
		$key = substr($val, 0, $e);
		$data = '=' . trim($_REQUEST[$key]);
		fwrite($fp, $key . $data."\n");
		
	}else{
		fwrite($fp, $val);
	}
	
}

fclose($fp);
@chmod($gfile, 0707);

    $line = $d['action']['cmd'];
    $result = exec($line, $out, $status);
    
	//system("am start --user 0 -n com.jrl.jrltest/com.jrl.jrltest.MainActivity");
	//	system($line);


$type = $_REQUEST['type'];
//echo '<script>alert("success"); history.back(-1);</script>';
echo '<script>alert("success"); window.location.href="./?mod=main&type='.$type.'";</script>';

?>