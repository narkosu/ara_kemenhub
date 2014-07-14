<?php
/* @var $this JabatanController */
/* @var $model Jabatan */

$this->breadcrumbs=array(
	'Jabatans'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Jabatan', 'url'=>array('index')),
	array('label'=>'Create Jabatan', 'url'=>array('create')),
	array('label'=>'View Jabatan', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Jabatan', 'url'=>array('admin')),
);
?>
<?php $this->renderPartial('_submenu'); ?>
<div id="subcontainer">
<h1>Update Jabatan <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
</div>