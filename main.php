<?php

if (!defined('__ENJ__'))
	exit ;

$gfile = $d['action']['path'];
$old = $d['action']['old'];

if(!file_exists($gfile)){

	echo "<script> alert('설정 파일이 존재하지 않습니다, 백업파일을 로딩하시겠습니까?'); </script>";
	
	if(!file_exists($old)){
	
		echo "<script> alert('백업 파일이 존재하지 않습니다.'); </script>";
		exit ;
	}else if(filesize($old) == 0){
		
		echo "<script> alert('백업 파일에 데이타(0byte)가 없습니다.'); </script>";
		exit ;
	}else{
		
		copy($old, $gfile);
	}
	
}else if(filesize($gfile) == 0){

	echo "<script> alert('설정 파일에 데이타(0byte)가 없습니다, 백업파일을 로딩하시겠습니까?'); </script>";
	
	if(!file_exists($old)){
	
		echo "<script> alert('백업 파일이 존재하지 않습니다.'); </script>";
		exit ;
	}else if(filesize($old) == 0){
		
		echo "<script> alert('백업 파일에 데이타(0byte)가 없습니다.'); </script>";
		exit ;
	}else{
		
		copy($old, $gfile);
	}

}

$myfile = fopen($gfile, "r") or die("Unable to open file!");

$hide = FALSE;
?>

		<form class="form-horizontal" action="action.php" method="post">

			<?php while(!feof($myfile)):

				$row = trim(fgets($myfile));
				$t = strpos($row, ']');
				$n = strpos($row, '=');
				$s = strpos($row, ';');
				
				if($type && $row == $type){
					
					$hide = FALSE;
				}else if($t && $s !== 0){
				
					$hide = TRUE;
				}
				
				if(!$type) $hide = FALSE;
	
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

            <div class="form-group">
                <div class="btn-group col-xs-12">
                    <input type="reset" class="btn btn-primary col-xs-6" value="RESET"/>
                    <input type="submit" class="btn btn-primary col-xs-6" value="SAVE"/>
                </div>
            </div>

		</form>


<?php fclose($myfile); ?>