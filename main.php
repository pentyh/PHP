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

<style type="text/css">
.file{ position:absolute; top:0; left:0px; filter:alpha(opacity:0);opacity: 0;width:100%; height:34px;  }
</style>

<form class="form-horizontal" action="action.php" method="post">
	<input type="hidden" name="mod" value="main">
	<input type="hidden" name="type" value="<?php echo $type ?>">
	
	<?php foreach ($list as $key => $value): ?>
		
		<div class="form-group <?php if(($type && $key != $type) || $key == 'boot'):?> hide <?php endif;?>">
			<label class="col-sm-3 control-label input-lg "><?php echo $key ?></label>
			<div class="col-sm-9"></div>
		</div>
		
		<?php foreach ($value as $key2 => $value2): ?>
		
			<div class="form-group <?php if(($type && $key != $type) || $key == 'boot'):?> hide <?php endif;?>">
				<label class="col-sm-3 control-label"><?php echo $key2 ?></label>
				<div class="col-sm-9">
					<input type="text" class="form-control input-info" name="<?php echo $key2 ?>" id="<?php echo $key2 ?>" value="<?php echo $value2 ?>" >
				</div>
			</div>
			
			<?php if(strpos($key2, '_back_image') > 0):?>
				
				<div class="form-group <?php if($type && $key != $type):?> hide <?php endif;?>"> 
					<label class="col-sm-3 control-label">ImageFile(RGB)</label>
					<div class="col-sm-9">
						<div class="col-sm-12 input-group">
							
							<span class="input-group-btn">
								<input type="button" class="btn btn-primary" value="Select file" onclick="uploadFile('<?php echo $key2 ?>')">
      						</span>
							<input type='text' style="text-align:center; height:34px; width:100%;" placeholder="No file is selected"  name='textfield' id='textfield<?php echo $key2 ?>' class='txt' /> 
							
							<input type="file" name="fileToUpload" class="file" id="fileToUpload<?php echo $key2 ?>" onchange="fileSelected('<?php echo $key2 ?>'); document.getElementById('textfield<?php echo $key2 ?>').value=this.value" >
							<span class="input-group-btn">
								<input type="button" class="btn btn-primary" value="Upload" onclick="uploadFile('<?php echo $key2 ?>')">
      						</span>
						</div>
					</div>
					
				</div> 

			<?php endif?>
		<?php endforeach;?>	
	<?php endforeach;?>		

	<nav class="navbar navbar-default navbar-fixed-bottom">
		<div class="progress" id="progress" style="display:none;">
  			<div class="progress-bar progress-bar-striped active" id="progressNum" role="progressbar" aria-valuemin="0" aria-valuemax="100" style="width: 0%">
    			<span class="sr-only">45% Complete</span>
  			</div>
		</div>
		
  		<div class="container-fluid">
  			<input type="submit" class="btn btn-primary btn-block navbar-btn" value="SAVE"/>
  		</div>
	</nav>

</form>

<script type="text/javascript">

      function fileSelected(_id) {
      
        var file = document.getElementById('fileToUpload'+_id).files[0];

        if (file) {
        
          //var fileSize = 0;
          //if (file.size > 1024 * 1024)
          //  fileSize = (Math.round(file.size * 100 / (1024 * 1024)) / 100).toString() + 'MB';
          //else
          //  fileSize = (Math.round(file.size * 100 / 1024) / 100).toString() + 'KB';

          //document.getElementById('fileName').innerHTML = 'Name: ' + file.name;
          //document.getElementById('fileSize').innerHTML = 'Size: ' + fileSize;
          //document.getElementById('fileType').innerHTML = 'Type: ' + file.type;
        }
      }

	var id = "";
	var name = ""
    function uploadFile(_id) {
      
    	id = _id;
    	var file = document.getElementById('fileToUpload'+_id).files[0];
    	name = file.name;
    	
        var fd = new FormData();
        fd.append("fileToUpload", file);
        var xhr = new XMLHttpRequest();
        xhr.upload.addEventListener("progress", uploadProgress, false);
        xhr.addEventListener("load", uploadComplete, false);
        xhr.addEventListener("error", uploadFailed, false);
        xhr.addEventListener("abort", uploadCanceled, false);
        xhr.open("POST", "action/a.upload.php");
        xhr.send(fd);
    }

    function uploadProgress(evt) {
      
        if (evt.lengthComputable) {
        
			var percentComplete = Math.round(evt.loaded * 100 / evt.total);	
			document.getElementById('progress').style.display = "block";
			document.getElementById('progressNum').style.width= percentComplete.toString() + '%';
        }
        else {
        	document.getElementById('progress').style.display = "none";
		}
    }

    function uploadComplete(evt) {
    
        alert(evt.target.responseText);
        
        document.getElementById('progress').style.display = "none";
        if(id != "")
	        document.getElementById(id).value = "<?php echo dirname(__FILE__)?>"+"/files/"+name;
    }

    function uploadFailed(evt) {
        alert("There was an error attempting to upload the file.");
        document.getElementById('progress').style.display = "none";
    }

    function uploadCanceled(evt) {
        alert("The upload has been canceled by the user or the browser dropped the connection.");
        document.getElementById('progress').style.display = "none";
    }
</script>