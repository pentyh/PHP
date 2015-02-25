<?php

$fdset = array('1', '2', '3', '4', '5');

$gfile = 'config.ini';
$fp = fopen($gfile,'w');

foreach ($fdset as $val)
{
	fwrite($fp, $val."=".trim(${$val})."\n");
}

fclose($fp);
@chmod($gfile,0707);


?>