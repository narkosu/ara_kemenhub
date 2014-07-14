<?php
/* @var $this DeputiController */
/* @var $model Deputi */

$this->breadcrumbs=array(
	'Deputis'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Deputi', 'url'=>array('index')),
	array('label'=>'Create Deputi', 'url'=>array('create')),
	array('label'=>'View Deputi', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Deputi', 'url'=>array('admin')),
);
?>
<?php $this->renderPartial('_submenu'); ?>
<div id="subcontainer">
<h1>Update Deputi <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
</div>