<?php
/* @var $this DepartementController */
/* @var $model Departement */

$this->breadcrumbs=array(
	'Departements'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Departement', 'url'=>array('index')),
	array('label'=>'Create Departement', 'url'=>array('create')),
	array('label'=>'View Departement', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Departement', 'url'=>array('admin')),
);
?>
<?php $this->renderPartial('_submenu'); ?>
<div id="subcontainer">

<h1>Update Departement <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
</div>