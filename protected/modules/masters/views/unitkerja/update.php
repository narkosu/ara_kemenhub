<?php
/* @var $this UnitkerjaController */
/* @var $model Unitkerja */

$this->breadcrumbs=array(
	'Unitkerjas'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Unitkerja', 'url'=>array('index')),
	array('label'=>'Create Unitkerja', 'url'=>array('create')),
	array('label'=>'View Unitkerja', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Unitkerja', 'url'=>array('admin')),
);
?>
<?php $this->renderPartial('_submenu'); ?>
<div id="subcontainer">
<h1>Update Unitkerja <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
</div>