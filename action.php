<?php

$fdset = array('a', 'b', 'c', 'd', 'e');

$gfile = 'movieup.ini';
$fp = fopen($gfile,'w');


foreach ($fdset as $val)
{
	
	fwrite($fp, $val."=".trim($_REQUEST[$val])."\n");
}

fclose($fp);
@chmod($gfile,0707);

echo '<script>alert("success"); location.href("index.php");</script>';
?>