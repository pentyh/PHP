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

$list = parse_ini_file($gfile, true);

?>

<form class="form-horizontal" action="action.php" method="post">
	<input type="hidden" name="mod" value="main">
	<input type="hidden" name="type" value="<?php echo $type ?>">
	
	<?php foreach ($list as $key => $value): ?>
		
		<div class="form-group <?php if($type && $key != $type):?> hide <?php endif;?>">
			<label class="col-sm-3 control-label input-lg "><?php echo $key ?></label>
			<div class="col-sm-9"></div>
		</div>
		
		<?php foreach ($value as $key2 => $value2): ?>
		
			<div class="form-group <?php if($type && $key != $type):?> hide <?php endif;?>">
				<label class="col-sm-3 control-label"><?php echo $key2 ?></label>
				<div class="col-sm-9">
					<input type="text" class="form-control input-info" name="<?php echo $key2 ?>" value="<?php echo $value2 ?>" >
				</div>
			</div>
		<?php endforeach;?>	
	<?php endforeach;?>		

	<nav class="navbar navbar-default navbar-fixed-bottom">
  			<div class="container-fluid">
  				<input type="submit" class="btn btn-primary btn-block navbar-btn" value="SAVE"/>
  			</div>
	</nav>

</form>