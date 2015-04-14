<?php
    
    if (!defined('__ENJ__'))
    exit ;
    
?>

<style>

.rc { width:100px; height:100px; border-radius:50px; outline:none; outline-style:none; font-size:30px;}
</style>

<form class="form-horizontal" id="form1" action="./" method="post">
<input type="hidden" name="a" value="remotecontrol">
<input type="hidden" name="mod" value="remotecontrol">
<input type="hidden" name="num" id="num" value=""/>


<div class="well">

<div class="form-group ">
<div class="col-xs-6 ">
<input type="button" value="1" class="rc btn btn-primary center-block" onclick="subForm(this)"/>
</div>
<div class="col-xs-6">
<input type="button" value="2" class="rc btn btn-primary center-block" onclick="subForm(this)"/>
</div>
</div>

<div class="form-group ">
<div class="col-xs-6 ">
<input type="button" value="3" class="rc btn btn-primary center-block" onclick="subForm(this)"/>
</div>
<div class="col-xs-6">
<input type="button" value="4" class="rc btn btn-primary center-block" onclick="subForm(this)"/>
</div>
</div>

<div class="form-group ">
<div class="col-xs-6 ">
<input type="button" value="5" class="rc btn btn-primary center-block" onclick="subForm(this)"/>
</div>
<div class="col-xs-6">
<input type="button" value="6" class="rc btn btn-primary center-block" onclick="subForm(this)"/>
</div>
</div>

</div>

</form>

<script>

function subForm(type){
    
    
    
    //alert(type.value);//弹出点击按钮的value值
    
    document.getElementById("num").value = type.value;
    document.getElementById("form1").submit();
    
}
</script>
