<?php
/* @var $this PesertaController */
/* @var $model Peserta */
/* @var $form CActiveForm */
?>
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'peserta-form',
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary($model,'','',array('class'=>'alert-error')); ?>

<div class="form">

	<div class="rowrecord">
		<?php echo $form->labelEx($model,'username'); ?>
		<?php echo $form->textField($model,'username',array('size'=>30,'maxlength'=>30)); ?>
		<?php echo $form->error($model,'username'); ?>
	</div>

	<div class="rowrecord">
		<?php echo $form->labelEx($model,'password'); ?>
		<?php echo $form->passwordField($model,'password',array('size'=>30,'maxlength'=>30)); ?>
		<?php echo $form->error($model,'password'); ?>
	</div>
 <div class="rowrecord">
		
		<?php echo $form->labelEx($model,'accessLevel'); ?>
		<?php echo $form->dropDownList($model, 'accessLevel',User::getAccessLevelList(), array('empty' => 'Access Level'));
		?>
		<?php echo $form->error($model,'accessLevel'); ?>
	</div>
	<div class="rowrecord buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array('class'=>'button pill')); ?>
	</div>

</div><!-- form -->
<?php $this->endWidget(); ?>
