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
<div class="header-page">
	<div style="float:left;vertical-align: middle;">
		<h2 class="textTitle">Assessment Kompetensi <?php echo $peserta->nama_peserta; ?></h2>
	</div>
	
	<div style="float:right;">
		<?php $this->renderPartial('_submenu_penilaian',array('params'=>$params,'model'=>$model)); ?>
	</div>
	<div style="clear:both;"></div>
	
</div>

<div class="container-page">

<?php echo $this->renderPartial('_form_penilaian', array('model'=>$model,'peserta'=>$peserta,'output'=>$output)); ?>
</div>