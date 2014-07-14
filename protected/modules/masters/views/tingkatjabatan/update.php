<?php
/* @var $this TingkatjabatanController */
/* @var $model Tingkatjabatan */

$this->breadcrumbs=array(
	'Tingkatjabatans'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Tingkatjabatan', 'url'=>array('index')),
	array('label'=>'Create Tingkatjabatan', 'url'=>array('create')),
	array('label'=>'View Tingkatjabatan', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Tingkatjabatan', 'url'=>array('admin')),
);
?>
<?php $this->renderPartial('_submenu'); ?>
<div id="subcontainer">
<h1>Update Tingkatjabatan <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
</div>