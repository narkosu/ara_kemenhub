<?php
/* @var $this TingkatjabatanController */
/* @var $model Tingkatjabatan */

$this->breadcrumbs=array(
	'Tingkatjabatans'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Tingkatjabatan', 'url'=>array('index')),
	array('label'=>'Manage Tingkatjabatan', 'url'=>array('admin')),
);
?>
<?php $this->renderPartial('_submenu'); ?>
<div id="subcontainer">
<h1>Create Tingkatjabatan</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
</div>