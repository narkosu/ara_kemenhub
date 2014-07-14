<?php
/* @var $this PesertaasesorController */
/* @var $data Pesertaasesor */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_departemen')); ?>:</b>
	<?php echo CHtml::encode($data->id_departemen); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_peserta')); ?>:</b>
	<?php echo CHtml::encode($data->id_peserta); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_asesor')); ?>:</b>
	<?php echo CHtml::encode($data->id_asesor); ?>
	<br />


</div>