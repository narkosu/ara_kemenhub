<?php
/* @var $this MasterasesorController */
/* @var $data Masterasesor */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('kode_asesor')); ?>:</b>
	<?php echo CHtml::encode($data->kode_asesor); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nama_asesor')); ?>:</b>
	<?php echo CHtml::encode($data->nama_asesor); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('telpon_asesor')); ?>:</b>
	<?php echo CHtml::encode($data->telpon_asesor); ?>
	<br />


</div>