<?php
/* @var $this PesertaasesorController */
/* @var $model Pesertaasesor */
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
		<?php echo $form->label($model,'id_departemen'); ?>
		<?php echo $form->textField($model,'id_departemen'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'id_peserta'); ?>
		<?php echo $form->textField($model,'id_peserta'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'id_asesor'); ?>
		<?php echo $form->textField($model,'id_asesor'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->