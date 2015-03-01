<?php
    empty($_REQUEST['type']) && $_REQUEST['type'] = 'all';
    $type = $_REQUEST['type'];// ? $_REQUEST['type'] : 'all';

$gfile = 'movieup.ini';
$myfile = fopen($gfile, "r") or die("Unable to open file!");

$hide = FALSE;
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

		<header class="navbar">
			<nav class="navbar navbar-inverse navbar-fixed-top" >
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="index.php">전체</a>
				</div>

				<!-- Collect the nav links, forms, and other content for toggling -->
				<div class="collapse navbar-collapse">
					<ul class="nav navbar-nav">
						<li <?php if($type == '[boot]'):?>class="active"<?php endif ?> >
							<a href="index.php?type=[boot]">[boot]</a>
						</li>
						<li <?php if($type == '[server]'):?>class="active"<?php endif ?> >
							<a href="index.php?type=[server]">[server]</a>
						</li>
						<li <?php if($type == '[quality]'):?>class="active"<?php endif ?> >
							<a href="index.php?type=[quality]">[quality]</a>
						</li>
						<li <?php if($type == '[image]'):?>class="active"<?php endif ?> >
							<a href="index.php?type=[image]">[image]</a>
						</li>
						<li <?php if($type == '[menu]'):?>class="active"<?php endif ?> >
							<a href="index.php?type=[menu]">[menu]</a>
						</li>
						<li <?php if($type == '[video]'):?>class="active"<?php endif ?> >
							<a href="index.php?type=[video]">[video]</a>
						</li>
                        <li <?php if($type == ';[video]'):?>class="active"<?php endif ?> >
                            <a href="index.php?type=;[video]">;[video]</a>
                        </li>
					</ul>
				</div><!-- /.navbar-collapse -->
			</nav>
		</header>

		<form class="form-horizontal" action="action.php" method="post">

			<?php while(!feof($myfile)):

				$row = trim(fgets($myfile));
				$t = strpos($row, ']');
				
				if($type && $row == $type){
					
					$hide = FALSE;
				}else if($t){
					$hide = TRUE;
				}
				
				if($type=='all') $hide = FALSE;
				
				$n = strpos($row, '=');
				$s = strpos($row, ';');
	
				if($n){
                    if($s===0){
                        $key = substr($row, 1, $n-1);
                    }else{
                        $key = substr($row, 0, $n);
                    }
					$value = substr($row, $n + 1);
				}else{
					$key = $row;
				}

			?>

			
			<div class="form-group <?php if($hide || $s===0):?> hide <?php endif?>">
				<label class="col-sm-3 control-label"><?php echo $key ?></label>
				<?php if($n):?>
					<div class="col-sm-9">
						<div class="input-group">
							<input type="text" class="form-control input-info" name="<?php echo $key ?>" value="<?php echo $value ?>" <?php if($s===0):?> readonly <?php endif ?> >
							<span class="input-group-addon">asdf</span>
						</div>
					</div>
				<?php endif ?>
			</div>

			<?php endwhile ?>

			<div class="form-group hide">
				<div class="col-xs-6">
					<input type="submit" class="btn btn-primary btn-block" value="SAVE"/>
				</div>
				<div class="col-xs-6">
					<input type="reset" class="btn btn-primary btn-block" value="RESET"/>
				</div>
			</div>

            <div class="form-group">
                <div class="btn-group col-xs-12">
                    <input type="reset" class="btn btn-primary col-xs-6" value="RESET"/>
                    <input type="submit" class="btn btn-primary col-xs-6" value="SAVE"/>
                </div>
            </div>

		</form>

	</body>
</html>

<?php fclose($myfile); ?>