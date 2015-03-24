<?php
$gfile = '../../movieup.ini';

$fdset = array();

$myfile = fopen($gfile, "r") or die("Unable to open file!");

while (!feof($myfile)) {

	$row = trim(fgets($myfile));
	$t = strpos($row, ']');

	$n = strpos($row, '=');
	$s = strpos($row, ';');

	if ($n) {

		$key = substr($row, 0, $n);

	} else {

		$key = $row;
	}

	$fdset[] = $key;

}

fclose($myfile);

$fp = fopen($gfile, 'w');

$i = 1;
foreach ($fdset as $val) {
	$key = $val;
	$s = strpos($val, ';');

	if ($s === 0)
		$val = substr($val, 1);

	$data = '';
	if (isset($_REQUEST[$val])) {

		$data = '=' . trim($_REQUEST[$val]);
	}

	if ($i === 1) {
		fwrite($fp, $key . $data);
		$i++;
	} else
		fwrite($fp, "\n" . $key . $data);
}

fclose($fp);
@chmod($gfile, 0707);

$cfile = 'line.txt';
$fp = fopen($cfile, "r");
if ($fp) {
	$line = trim(fgets($fp));

	//system("am start --user 0 -n com.jrl.jrltest/com.jrl.jrltest.MainActivity");
	system($line);
}
fclose($fp);

echo '<script>alert("success"); history.back(-1);</script>';
?>