<?php
/* @var $this PesertaasesorController */
/* @var $model Pesertaasesor */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'pesertaasesor-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'id_departemen'); ?>
		<?php echo $form->textField($model,'id_departemen'); ?>
		<?php echo $form->error($model,'id_departemen'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'id_peserta'); ?>
		<?php echo $form->textField($model,'id_peserta'); ?>
		<?php echo $form->error($model,'id_peserta'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'id_asesor'); ?>
		<?php echo $form->textField($model,'id_asesor'); ?>
		<?php echo $form->error($model,'id_asesor'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->