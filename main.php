<?php

if (!defined('__ENJ__'))
	exit ;

empty($_REQUEST['type']) && $_REQUEST['type'] = 'all';
$type = $_REQUEST['type'];
// ? $_REQUEST['type'] : 'all';

//$gfile = $path['ini'];
$gfile = $d['action']['path'];
$myfile = fopen($gfile, "r") or die("Unable to open file!");

$hide = FALSE;
?>


		<header class="navbar hide">
			<nav class="navbar navbar-inverse navbar-fixed-top" >
				
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="./?mod=main">전체</a>
				</div>

				<!-- Collect the nav links, forms, and other content for toggling -->
				<div class="collapse navbar-collapse">
					<ul class="nav navbar-nav">
						<li <?php if($type == '[boot]'):?>class="active"<?php endif ?> >
							<a href="./?mod=main&type=[boot]">[boot]</a>
						</li>
						<li <?php if($type == '[server]'):?>class="active"<?php endif ?> >
							<a href="./?mod=main&type=[server]">[server]</a>
						</li>
						<li <?php if($type == '[quality]'):?>class="active"<?php endif ?> >
							<a href="./?mod=main&type=[quality]">[quality]</a>
						</li>
						<li <?php if($type == '[image]'):?>class="active"<?php endif ?> >
							<a href="./?mod=main&type=[image]">[image]</a>
						</li>
						<li <?php if($type == '[menu]'):?>class="active"<?php endif ?> >
							<a href="./?mod=main&type=[menu]">[menu]</a>
						</li>
						<li <?php if($type == '[video]'):?>class="active"<?php endif ?> >
							<a href="./?mod=main&type=[video]">[video]</a>
						</li>
                        <li <?php if($type == ';[video]'):?>class="active"<?php endif ?> >
                            <a href="./?mod=main&type=;[video]">;[video]</a>
                        </li>
					</ul>
					
					<form class="navbar-form navbar-right" role="search">
                        <input type="text" value="main">
                        <input type="text" value="remotecontrol">
			        	<button type="submit" class="btn btn-primary btn-block">리모콘</button>
			      	</form>
			      	
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

			
			<div class="form-group <?php if($hide || ( $s===0 && $row != $type)):?> hide <?php endif ?>">
				<label class="col-sm-3 control-label"><?php echo $key ?></label>
				<?php if($n):?>
					<div class="col-sm-9">
						<input type="text" class="form-control input-info" name="<?php echo $key ?>" value="<?php echo $value ?>" <?php if($s===0):?> readonly <?php endif ?> >
						<!-- <div class="input-group">
							<input type="text" class="form-control input-info" name="<?php echo $key ?>" value="<?php echo $value ?>" <?php if($s===0):?> readonly <?php endif ?> >
							<span class="input-group-addon">asdf</span>
						</div> -->
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


<?php fclose($myfile); ?>