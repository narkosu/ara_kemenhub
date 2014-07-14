<?php
/* @var $this MasterasesorController */
/* @var $model Masterasesor */
/* @var $form CActiveForm */
?>
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'masterasesor-form',
	'enableAjaxValidation'=>false,
)); ?>
<?php echo $form->errorSummary($model,'','',array('class'=>'alert-error')); ?>
<?php
	if ( Yii::app()->user->hasFlash('asessor_success')) {
		echo '<div class="alert-success">' . Yii::app()->user->getFlash('asessor_success') . "</div>\n";
    }
?>
<div class="form">

	

	<div class="rowrecord">
		<?php echo $form->labelEx($model,'kode_asesor'); ?>
		<?php echo $form->textField($model,'kode_asesor',array('size'=>6,'maxlength'=>6)); ?>
		<?php echo $form->error($model,'kode_asesor'); ?>
	</div>

	<div class="rowrecord">
		<?php echo $form->labelEx($model,'nama_asesor'); ?>
		<?php echo $form->textField($model,'nama_asesor',array('size'=>30,'maxlength'=>30)); ?>
		<?php echo $form->error($model,'nama_asesor'); ?>
	</div>

	<div class="rowrecord">
		<?php echo $form->labelEx($model,'telpon_asesor'); ?>
		<?php echo $form->textField($model,'telpon_asesor'); ?>
		<?php echo $form->error($model,'telpon_asesor'); ?>
	</div>

	<div class="rowrecord buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array('class'=>'button pill')); ?>
	</div>
</div><!-- form -->
<?php $this->endWidget(); ?>