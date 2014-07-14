<?php
/* @var $this PesertaasesorController */
/* @var $model Pesertaasesor */

$this->breadcrumbs=array(
	'Pesertaasesors'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Pesertaasesor', 'url'=>array('index')),
	array('label'=>'Create Pesertaasesor', 'url'=>array('create')),
	array('label'=>'View Pesertaasesor', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Pesertaasesor', 'url'=>array('admin')),
);
?>

<h1>Update Pesertaasesor <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>