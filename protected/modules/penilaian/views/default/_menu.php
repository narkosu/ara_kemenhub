<div class="box-best">
<div class="box-photo-profile" style="margin-bottom:10px;">
	<div class="mbrIcn" style="float:left;margin-right:10px;">
	<a href="/MemberProfile-cpa-a_uid.A4904A71825EA2C09B6287E749BDEA35" title="Add Photo" rel="nofollow">
	<?php echo CHtml::image(Yii::app()->baseUrl.'/images/no_user_photo.gif'); ?>
	</a>
	</div>
	<div >
		<a href="<?php echo Yii::app()->createUrl('members').'/'.$user_request->username ?>" rel="nofollow" class="mbrName"><?php echo $user_request->username ?></a><br>
		
	</div>
	<div style="clear:both;"></div>
</div>
<div class="box-menu-member">
	<ul>
	<li class="firstItem mark">
	Profile
	<ul>
	<li>
	<a href="<?php echo Yii::app()->createUrl('/members/').'/'.$user_request->username?>" class=" sprite-lhnselected">About Me</a>
	</li>
	<?php if ( Yii::app()->user->name == $user_request->username) { ?>
		<?php /*<li class="viewing">
		<a href="/MemberProfile-cpb-a_uid.A4904A71825EA2C09B6287E749BDEA35" class=" sprite-lhnselected">Edit Photo</a>
			</li>
		*/ ?>
		<li class="viewing">
		<a href="<?php echo Yii::app()->createUrl('site/forgot')?> ">Reset Password</a>
		</li>
	<?php } ?>	
	</ul>
	</li>
	
	<li>
	<div>Contributions</div>
	<ul>
	<li><a href="<?php echo Yii::app()->createUrl('/members/reviews').'/'.$user_request->username?>" class="k_" rel="nofollow">Reviews</a></li>
	<li><a href="<?php echo Yii::app()->createUrl('/members/factories').'/'.$user_request->username?>" class="k_" rel="nofollow">Factories</a></li>
	</ul>
	</li>
	
	</ul>
</div>
</div>