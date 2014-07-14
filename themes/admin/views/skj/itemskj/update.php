<?php
/* @var $this ItemskjController */
/* @var $model Itemskj */

$this->breadcrumbs=array(
	'Itemskjs'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Itemskj', 'url'=>array('index')),
	array('label'=>'Create Itemskj', 'url'=>array('create')),
	array('label'=>'View Itemskj', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Itemskj', 'url'=>array('admin')),
);
?>
<div class="header-page">
	<div style="float:left;vertical-align: middle;">
		<h2 class="textTitle">Update Item SKJ pada <a href="<?php echo Yii::app()->createUrl('skj/itemskj/index/id/'.$model->skj_id)?>"><?php echo $model->skj->skj_name;?></a> : </h2>
	</div>
	<div style="float:right;">
	<?php $this->renderPartial('_submenu',array('params'=>$params)); ?>
	</div>
	<div style="clear:both;"></div>
</div>

<div class="container-page">
<?php echo $this->renderPartial('_form', array('model'=>$model,'itemkompetensi'=>$itemkompetensi)); ?>
<div style="clear: both"></div>
</div>