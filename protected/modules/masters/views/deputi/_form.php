<?php
/* @var $this DeputiController */
/* @var $model Deputi */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'deputi-form',
	'enableAjaxValidation'=>false,
)); ?>
	<?php /*
	<p class="note">Fields with <span class="required">*</span> are required.</p>
	*/?>
	<?php echo $form->errorSummary($model); ?>

	<div class="record">
		<?php
		$list=CHtml::listData(Departement::model()->findAll(), 'id', 'name');;
		?>
		<?php echo $form->labelEx($model,'departement_id'); ?>
		<?php echo $form->dropDownList($model, 'departement_id',$list, array('empty' => 'Departement'));
		?>
		<?php echo $form->error($model,'departement_id'); ?>
	</div>

	<div class="record">
		<?php echo $form->labelEx($model,'deputi_name'); ?>
		<?php echo $form->textField($model,'deputi_name',array('size'=>60,'maxlength'=>145)); ?>
		<?php echo $form->error($model,'deputi_name'); ?>
	</div>

	<div class="record">
		<?php echo $form->labelEx($model,'status'); ?>
		<?php echo $form->textField($model,'status',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'status'); ?>
	</div>

	<div class="record buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->