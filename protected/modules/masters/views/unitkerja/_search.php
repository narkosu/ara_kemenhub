<?php
/* @var $this UnitkerjaController */
/* @var $model Unitkerja */
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
		<?php echo $form->label($model,'unitkerja_name'); ?>
		<?php echo $form->textField($model,'unitkerja_name',array('size'=>60,'maxlength'=>145)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->