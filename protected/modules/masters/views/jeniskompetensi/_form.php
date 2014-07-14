<?php
/* @var $this JeniskompetensiController */
/* @var $model Jeniskompetensi */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'jeniskompetensi-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

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
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>145)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="record">
		<?php echo $form->labelEx($model,'keterangan'); ?>
		<?php echo $form->textField($model,'keterangan',array('size'=>60,'maxlength'=>145)); ?>
		<?php echo $form->error($model,'keterangan'); ?>
	</div>

	<div class="record buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->