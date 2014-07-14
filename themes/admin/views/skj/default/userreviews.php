<div style="padding:10px 0px;font-weight:bold;">
My Recent Reviews
</div>
<div id="rewiews-list-header" style="border-top:1px solid #eee;border-bottom:1px solid #eee;padding:5px 0px;">
	<div style="float:left;"><?php echo Yii::t('Reviews','{num} Reviews',array('{num}'=>$total_reviews));?></div>
	<div style="float:right;font-weight:bold;"><?php echo ($pages->offset+1).' - '.(($pages->offset)+count($reviews));?> Reviews</div>
	<div style="clear:both"></div>
</div>

<table width="100%" cellspacing="0" cellpadding="0" border="0" style="margin-bottom: 60px;">
<tbody><tr bgcolor="#f3f3f3">
<td nowrap="nowrap">
<b>
Date Posted </b>
</td>
<td width="10">&nbsp;</td>
<td width="300"><b>Title</b></td> <td width="10">&nbsp;</td>
<td align="right" style="padding: 3px 20px 3px 0;">
<b>Rating</b> </td>
<td width="10">&nbsp;</td>

<td width="10">&nbsp;</td>
<td><b>Photos</b></td>
<?php if ( Yii::app()->user->id  ) { ?>
<td><b>--</b></td>
<?php } ?>
</tr>
<?php 
foreach ($reviews as $k=>$review){
?>
	<tr>
	<td nowrap="nowrap">
	<span>
	<?php echo date('M d, Y',$review->create_date) ?> </span>
	</td>
	<td width="10">&nbsp;</td>
	<td width="300">
	<a href="<?php echo Yii::app()->createUrl('advisor/factory/view/id/'.$review->getFactory()->relfactory->id)?>"><?php echo $review->getFactory()->relfactory->company_name;?></a>: <?php echo $review->title?>
	</td>
	<td width="10">&nbsp;</td>
	<td align="right" style="padding: 3px 20px 3px 0;width:200px;">
		<span class="rate rate_s s30"><?php $this->widget('CStarRating',array('name'=>'AdvisorReview'.$review->id,'maxRating'=>5,'minRating'=>1,'readOnly'=>true,'value'=>$review->rating));?>
	</span>
	</td>
	<td width="10">&nbsp;</td>
	<td width="10">&nbsp;</td>
	<td>
	<?php 
	$a = $review->getPhotos();
	if ( !empty($a) ){ ?>
	<div class="photos">
		<img src="<?php echo Yii::app()->baseUrl.'/photos/review_'.$a[0]->review_id.'/'.$a[0]->filename?>" width="50">
	</div>
	<?php } ?>
	</td>
	<?php if ( Yii::app()->user->id == $review->user_id ) { ?>
	<td>
		
		<a href="<?php echo Yii::app()->createUrl('/advisor/review/delete/id/'.$review->id)?>" onclick="return confirm ('Are you sure to delete ?');">Delete</a>
		
	</td>
	<?php } ?>
	</tr>
<?php } ?>
</tbody>
</table>

<div>
	<?php $this->widget('CLinkPager', array('pages' => $pages)); ?>
</div>


