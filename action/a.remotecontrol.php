<?php

if (!defined('__ENJ__'))
	exit ;
    
$num = $_REQUEST['num'];
$line = $button[$num];
$result = exec($line, $out, $status);
    
echo "<script> alert('$line');</script>"

?>
