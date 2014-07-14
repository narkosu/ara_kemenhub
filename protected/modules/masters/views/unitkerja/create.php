<?php
/* @var $this UnitkerjaController */
/* @var $model Unitkerja */

$this->breadcrumbs=array(
	'Unitkerjas'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Unitkerja', 'url'=>array('index')),
	array('label'=>'Manage Unitkerja', 'url'=>array('admin')),
);
?>
<?php $this->renderPartial('_submenu'); ?>
<div id="subcontainer">
<h1>Create Unitkerja</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
</div>