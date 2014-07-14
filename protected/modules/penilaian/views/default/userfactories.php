<?php
Yii::app()->clientScript->registerScript('factory', '
	jQuery(".deletefactory").click(function(){
		if ( confirm("Are you sure to delete this factory ? All reviews will be deleted too.") ) {
			return true;
		}else{
			return false;
		}
	});

');

?>
<div style="padding:10px 0px;font-weight:bold;">
My Recent Included Factories 
</div>
<div id="rewiews-list-header" style="border-top:1px solid #eee;border-bottom:1px solid #eee;padding:5px 0px;">
	<div style="float:left;"><?php echo Yii::t('Factories','{num} Factories',array('{num}'=>$total_reviews));?></div>
	<div style="float:right;font-weight:bold;"><?php echo ($pages->offset+1).' - '.(($pages->offset)+count($reviews));?> Factories</div>
	<div style="clear:both"></div>
</div>

<table width="100%" cellspacing="0" cellpadding="0" border="0" style="margin-bottom: 60px;">
<tbody><tr bgcolor="#f3f3f3">

<td width="300"><b>Company Name</b></td> <td width="10">&nbsp;</td>
<td align="right" style="">
<b>Rating</b></td>
<td width="10">&nbsp;</td>
<td >Reviews</td>

<td width="10">&nbsp;</td>
<td><b>Photos</b></td>
<?php if ( Yii::app()->user->id  ) { ?>
<td><b>--</b></td>
<?php } ?>
</tr>
<?php 
foreach ( $reviews as $k=>$factory){
?>
	<tr>
	<td width="300">
	<a href="<?php echo Yii::app()->createUrl('advisor/factory/view/id/'.$factory->id)?>"><?php echo $factory->company_name;?></a>: <?php echo $factory->address?>
	</td>
	<td width="10">&nbsp;</td>
	<td align="right" style="width:300px;">
		<span class="rate rate_s s30">
		<?php $this->widget('CStarRating',array('name'=>'AdvisorReview'.$factory->id,
				'maxRating'=>5,'minRating'=>1,'readOnly'=>true,
				'value'=> ( $factory->FactoryReview() ? $factory->FactoryReview()->averageRating() : 0 )));?>
	</span>
	</td>
	<td width="10">&nbsp;</td>
	<td style="width:100px;"><?php echo ($factory->FactoryReview() ? $factory->FactoryReview()->num_reviews : 0 ) ?> reviews</td>
	<td width="10">&nbsp;</td>
	<td style="width:100px;">
	<?php echo $factory->getNumPhotos()?> photos
	</td>
	<?php if ( Yii::app()->user->id == $factory->user_created  ) { ?>
	<td><span class="label success"><a href="<?php echo Yii::app()->createUrl('advisor/factory/update/id/'.$factory->id);?>">edit</a></span><br>
	<span class="label important deletefactory" data-id="<?php echo $factory->id?>" ><a href="<?php echo Yii::app()->createUrl('advisor/factory/delete/id/'.$factory->id);?>" >Delete</a></span></td>
	<?php } ?>
	</tr>
<?php } ?>
</tbody>
</table>

<div>
	<?php $this->widget('CLinkPager', array('pages' => $pages)); ?>
</div>