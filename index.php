<?php

$gfile = 'config.ini';
$myfile = fopen($gfile, "r") or die("Unable to open file!");

//$data = fread($myfile,filesize("config.ini"));
//fclose($myfile);
?>

<!DOCTYPE HTML>
<html>
	<body>

		<form action="action.php" method="get">
			<table style="width:100%">
				<?php while(!feof($myfile)):
				?>
				<?php
				$row = fgets($myfile);
				$n = strpos($row, '=');
				$key = substr($row, 0, $n);
				$value = substr($row, $n + 1);
				?>
					<tr>
						<td><?php echo $key ?></td>
						<td><input type="text" name="<?php echo $key ?>" value="<?php echo $value ?>"></td>
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