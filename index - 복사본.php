<?php

$gfile = 'movieup.ini';
$myfile = fopen($gfile, "r") or die("Unable to open file!");

//$data = fread($myfile,filesize("config.ini"));
//fclose($myfile);
?>



<!DOCTYPE HTML>
<html>
	<head>
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
		
		<!-- Optional theme -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap-theme.min.css">
		
		<!-- Latest compiled and minified JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
	</head>
	<body style="padding: 0 20%">

		<form class="form-horizontal" action="action.php" method="get">
			
			<table class="table-responsive">
				<?php while(!feof($myfile)):
					
					$row = fgets($myfile);
					$n = strpos($row, '=');
                    
                    $s = strpos($row, ';');
					
                    if($n){
                        $key = substr($row, 0, $n);
                        $value = substr($row, $n + 1);
                    }else{
                        $key = $row;
                    }
					
				?>
					<tr>
						<td><?php echo $key ?></td>
                        <?php if($n):?>
							<td><input type="text" class="form-control" name="<?php echo $key ?>" value="<?php echo $value ?>" <?php if($s===0):?> disabled <?php endif ?> ></td>
                        <?php endif ?>
					</tr>
				<?php endwhile ?>
			</table>
			<br />
			
			<div class="form-group">
				<label class="col-sm-2 control-label">asdfasdf</label> 
				<div class="col-sm-10">
					<div class="input-group">
						<input type="text" class="form-control" name="<?php echo $key ?>" value="<?php echo $value ?>" <?php if($s===0):?> disabled <?php endif ?> >
						<span class="input-group-addon">asdf</span>
					</div>
				</div>
			</div>
			
			<div class="form-group">
				<div class="col-md-6">
					<input type="submit" class="btn btn-primary btn-block" value="SAVE"/>
				</div>
				<div class="col-md-6">
					<input type="reset" class="btn btn-primary btn-block" value="RESET"/>
				</div>
			</div>
		</form>

	</body>
</html>

<?php fclose($myfile); ?>