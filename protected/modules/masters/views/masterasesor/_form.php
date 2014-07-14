<?php
/* @var $this MasterasesorController */
/* @var $model Masterasesor */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'masterasesor-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'kode_asesor'); ?>
		<?php echo $form->textField($model,'kode_asesor',array('size'=>6,'maxlength'=>6)); ?>
		<?php echo $form->error($model,'kode_asesor'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'nama_asesor'); ?>
		<?php echo $form->textField($model,'nama_asesor',array('size'=>30,'maxlength'=>30)); ?>
		<?php echo $form->error($model,'nama_asesor'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'telpon_asesor'); ?>
		<?php echo $form->textField($model,'telpon_asesor'); ?>
		<?php echo $form->error($model,'telpon_asesor'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->