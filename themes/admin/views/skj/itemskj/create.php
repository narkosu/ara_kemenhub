<?php
/* @var $this ItemskjController */
/* @var $model Itemskj */

$this->breadcrumbs=array(
	'Itemskjs'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Itemskj', 'url'=>array('index')),
	array('label'=>'Manage Itemskj', 'url'=>array('admin')),
);
?>
<div class="header-page">
	<div style="float:left;vertical-align: middle;">
		<h2 class="textTitle">Item SKJ <a href="<?php echo Yii::app()->createUrl('skj/itemskj/index/id/'.$params['skjid'])?>"><?php echo $masterskj->skj_name;?></a> Baru : </h2>
	</div>
	<div style="float:right;">
	<?php $this->renderPartial('_submenu',array('params'=>$params)); ?>
	</div>
	<div style="clear:both;"></div>
</div>


<div class="container-page">
<?php echo $this->renderPartial('_form', array('model'=>$model,'params'=>$params)); ?>
<div style="clear:both"></div>
</div>