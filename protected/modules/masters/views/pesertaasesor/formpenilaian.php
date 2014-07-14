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
	array('label'=>'View Pesertaasesor', 'url'=>array('view', 'id'=>$peserta->id)),
	array('label'=>'Manage Pesertaasesor', 'url'=>array('admin')),
);
?>

<?php $this->renderPartial('_submenu_penilaian',array('model'=>$model)); ?>
<div id="subcontainer">

<h1 style="text-transform:uppercase">Assessment Kompetensi <?php echo $peserta->nama_peserta; ?></h1>

<?php echo $this->renderPartial('_form_penilaian', array('model'=>$model,'peserta'=>$peserta,'output'=>$output)); ?>
</div>