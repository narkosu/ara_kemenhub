<?php
/* @var $this JeniskompetensiController */
/* @var $model Jeniskompetensi */

$this->breadcrumbs=array(
	'Jeniskompetensis'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Jeniskompetensi', 'url'=>array('index')),
	array('label'=>'Manage Jeniskompetensi', 'url'=>array('admin')),
);
?>
<?php $this->renderPartial('_submenu'); ?>
<div id="subcontainer">
<h1>Create Jeniskompetensi</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
</div>