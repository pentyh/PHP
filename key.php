<?php

$gfile = 'movieup.ini';
$myfile = fopen($gfile, "r") or die("Unable to open file!");

   
    $fdset = array();
    while(!feof($myfile)){
        
        $row = trim(fgets($myfile));
        $t = strpos($row, ']');
        
        $n = strpos($row, '=');
        $s = strpos($row, ';');
        
        if($n){
            
            $key = substr($row, 0, $n);
            
        }else{
            
            $key = $row;
        }
        
        
        $fdset[] = $key;
    }
    
    

    echo json_encode($fdset);
    
fclose($myfile);
    
?>
