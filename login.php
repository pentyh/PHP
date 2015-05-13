<?php
    
    if(!defined('__ENJ__')) exit;
    include 'var/var.php';
    
?>

<form class="form-horizontal" action="./" method="post" onsubmit="return checked()">
    <input type="hidden" name="a" value="login">
    <input type="hidden" name="mod" value="main">

    <div class="form-group">
    	<div class="col-sm-12">
            <div class="input-group">
            	<span class="input-group-addon">PassWord</span>
            	<input type="text" class="form-control input-info" id="pw" name="pw" value="" >
            </div>
        </div>
    </div>
    
    <div class="form-group hide">
    	<div class="col-sm-12">
            <div class="input-group">
            	<span class="input-group-addon">New PassWord</span>
            	<input type="text" class="form-control input-info" id="npw" name="npw" value="" >
            </div>
        </div>
    </div>
    
    <div class="form-group hide">
    	<div class="col-sm-12">
            <div class="input-group">
            	<span class="input-group-addon">Confirm PassWord</span>
            	<input type="text" class="form-control input-info" id="cpw" name="cpw" value="" >
            </div>
        </div>
    </div>
            
    <div class="form-group">
        <div class="col-xs-12">
            <input type="button" class="btn btn-primary col-xs-6 hide" value="Change PassWord" onclick="changepw()"/>
            <input type="submit" class="btn btn-primary col-xs-12" value="Login"/>
        </div>
    </div>

</form>

<script>

function changepw(){
    
    alert('<?php echo $PASSWORD?>');
}

function checked(){
    
    var result = false;
    
    if(pw.valuw != "" && pw.value == <?php echo $PASSWORD?>){
  
        result = true;
    }else{
        
        alert("비밀번호가 정확하지 않습니다!");
    }
    
    return result;
}
</script>