<?php
/* @var $this KompetensiController */
/* @var $model Kompetensi */

$this->breadcrumbs=array(
	'Kompetensis'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Kompetensi', 'url'=>array('index')),
	array('label'=>'Create Kompetensi', 'url'=>array('create')),
	array('label'=>'View Kompetensi', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Kompetensi', 'url'=>array('admin')),
);
?>

<h1>Update Kompetensi <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>