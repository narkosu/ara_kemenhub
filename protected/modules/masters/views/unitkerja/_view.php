<?php
/* @var $this UnitkerjaController */
/* @var $data Unitkerja */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('departement_id')); ?>:</b>
	<?php echo CHtml::encode($data->departement_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('deputi_id')); ?>:</b>
	<?php echo CHtml::encode($data->deputi_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('unitkerja_name')); ?>:</b>
	<?php echo CHtml::encode($data->unitkerja_name); ?>
	<br />


</div>