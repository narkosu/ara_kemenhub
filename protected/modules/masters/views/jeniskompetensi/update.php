<?php
/* @var $this JeniskompetensiController */
/* @var $model Jeniskompetensi */

$this->breadcrumbs=array(
	'Jeniskompetensis'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Jeniskompetensi', 'url'=>array('index')),
	array('label'=>'Create Jeniskompetensi', 'url'=>array('create')),
	array('label'=>'View Jeniskompetensi', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Jeniskompetensi', 'url'=>array('admin')),
);
?>

<h1>Update Jeniskompetensi <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>