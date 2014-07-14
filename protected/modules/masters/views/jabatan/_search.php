<?php
/* @var $this JabatanController */
/* @var $model Jabatan */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'departement_id'); ?>
		<?php echo $form->textField($model,'departement_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'deputi_id'); ?>
		<?php echo $form->textField($model,'deputi_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'unitkerja_id'); ?>
		<?php echo $form->textField($model,'unitkerja_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'jabatan_name'); ?>
		<?php echo $form->textField($model,'jabatan_name',array('size'=>60,'maxlength'=>145)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'status'); ?>
		<?php echo $form->textField($model,'status',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->