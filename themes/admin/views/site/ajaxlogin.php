<?php 
	$js=Yii::app()->clientScript;
	$js->registerScript('ajaxlogin', '
		jQuery("#login").click(function(){
			var datas = jQuery("#formlogin").serialize();
			jQuery.ajax({
				url: "'.Yii::app()->createUrl('site/AjaxLogin').'",
				  data : datas,
				  type : "post",
				  success: function(data) {
					//alert(data);
					if (data == "success") {
						jQuery("'.$element.'").'.$action.'();
					}else{
						jQuery(".error").html("Your username is not valid");
					}
				  }
				
			});
			
		});	
	
	');
?>	
<div style="">
	<h3>or sign in to your Bangladvisor account </h3>
	<form name="form" method="post" id="formlogin" action="<?php echo Yii::app()->createUrl('site/login')?>">
	<div class="error">
	
	</div>
	<div style="padding:0px 10px;"><label>Username:</label></div>
	<div>
	<input type="text" name="LoginForm[username]" value="<?php echo (!empty($_POST['LoginForm']['username']) ? $_POST['LoginForm']['username'] : '' ); ?>" />
	</div>
	<div id="error-username"></div>
	<div>
	<label>Password</label><input type="password" name="LoginForm[password]"/>
	</div>
	<div><input type="button" id="login" value="LOGIN" class="btnlogin" /><a href="#">Forgot your password?</a>
	</div>
	<div id="error-password"></div>
	</form>
</div>
<div >
 Don't have a TripAdvisor account?
 join
</div>
<div style="clear:both;"></div>