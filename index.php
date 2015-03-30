<?php

    header("Content-type:text/html;charset=utf-8");
    define('__ENJ__',true);
    error_reporting(E_ALL ^ E_NOTICE);
    
    session_save_path('./tmp/session');
    session_start();
    
    include 'var/var.php';
    
    $a = !empty($_REQUEST['a']) ? $_REQUEST['a'] : 0;
    if ($a) require 'action/a.'.$a.'.php';
    
    $mod = !empty($_REQUEST['mod']) ? $_REQUEST['mod'] : 'main';
?>

<!DOCTYPE HTML>
<html>
	<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0 user-scalable=no">

        <title>환경설정</title>

        <link rel="stylesheet" href="bootstrap-3.3.2-dist/css/bootstrap.css">
		<link rel="stylesheet" href="bootstrap-3.3.2-dist/css/bootstrap.min.css">
		<link rel="stylesheet" href="bootstrap-3.3.2-dist/css/bootstrap-theme.min.css">

        <script src="jquery-2.1.3.min.js"></script>
		<script src="bootstrap-3.3.2-dist/js/bootstrap.min.js"></script>
		
	</head>
	<body style="padding: 0 10%">


        <?php
            
            if($_SESSION["pw"] != $PASSWORD){
                $mod = 'login';
            }
            
            include $mod.'.php';
        ?>

	</body>
</html>