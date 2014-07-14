<?php
/* @var $this ItemskjController */
/* @var $data Itemskj */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('skj_id')); ?>:</b>
	<?php echo CHtml::encode($data->skj_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('departement_id')); ?>:</b>
	<?php echo CHtml::encode($data->departement_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('deputi_id')); ?>:</b>
	<?php echo CHtml::encode($data->deputi_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('unitkerja_id')); ?>:</b>
	<?php echo CHtml::encode($data->unitkerja_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('jabatan_id')); ?>:</b>
	<?php echo CHtml::encode($data->jabatan_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tingkatjabatan_id')); ?>:</b>
	<?php echo CHtml::encode($data->tingkatjabatan_id); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('rumpunjabatan_id')); ?>:</b>
	<?php echo CHtml::encode($data->rumpunjabatan_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('status')); ?>:</b>
	<?php echo CHtml::encode($data->status); ?>
	<br />

	*/ ?>

</div>