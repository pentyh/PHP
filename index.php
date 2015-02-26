<?php

$gfile = 'movieup.ini';
$myfile = fopen($gfile, "r") or die("Unable to open file!");

//$data = fread($myfile,filesize("config.ini"));
//fclose($myfile);
?>

<!DOCTYPE HTML>
<html>
	<body>

		<form action="action.php" method="get">
			<table>
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
<td><input type="text" name="<?php echo $key ?>" value="<?php echo $value ?>" <?php if($s===0):?> disabled <?php endif?> ></td>
                        <?php endif?>
					</tr>
				<?php endwhile ?>
			</table>
			<br />
			<input type="submit" value="SAVE"/>
			<input type="reset" value="RESET"/>
		</form>

	</body>
</html>

<?php fclose($myfile); ?>