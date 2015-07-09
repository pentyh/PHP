<?php

    header("Content-type:text/html;charset=utf-8");
    define('__ENJ__',true);
    error_reporting(E_ALL ^ E_NOTICE);

    session_start();
    
    include 'var/var.php';
    include 'var/buttonvar.php';
    include 'var/finalvar.php';
    
    $mod = $_REQUEST['mod'] ? $_REQUEST['mod'] : 'main';
    $type = $_REQUEST['type'];
    
    $a = $_REQUEST['a'];
    if ($a) require 'action/a.'.$a.'.php';
    
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
	<body style="padding: 70px 10%">


<nav class="navbar navbar-inverse navbar-fixed-top" >

<div class="container-fluid">

<div class="navbar-header">
<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
<span class="sr-only">Toggle navigation</span>
<span class="icon-bar"></span>
<span class="icon-bar"></span>
<span class="icon-bar"></span>
</button>
<a class="navbar-brand" href="./?mod=main">All</a>
</div>

<!-- Collect the nav links, forms, and other content for toggling -->
<div class="collapse navbar-collapse">
<ul class="nav navbar-nav">
<li class="hide <?php if($type == 'boot'):?>active<?php endif ?>" >
<a href="./?mod=main&type=boot">boot</a>
</li>
<li <?php if($type == 'server'):?>class="active"<?php endif ?> >
<a href="./?mod=main&type=server">server</a>
</li>
<li <?php if($type == 'quality'):?>class="active"<?php endif ?> >
<a href="./?mod=main&type=quality">quality</a>
</li>
<li <?php if($type == 'image'):?>class="active"<?php endif ?> >
<a href="./?mod=main&type=image">image</a>
</li>
<li <?php if($type == 'menu'):?>class="active"<?php endif ?> >
<a href="./?mod=main&type=menu">menu</a>
</li>
<li <?php if($type == 'video'):?>class="active"<?php endif ?> >
<a href="./?mod=main&type=video">video</a>
</li>
</ul>

<form class="navbar-form navbar-right" role="search">
	<input type="hidden" name="mod" value="remotecontrol">
	<button type="submit" class="btn btn-primary btn-block"> RemoteControl </button>
</form>

</div><!-- /.navbar-collapse -->
</div>

</nav>

	<?php
            
		if($_SESSION["pw"] != $PASSWORD){
            $mod = 'login';
        }
            
        include $mod.'.php';
    ?>

	</body>
</html>