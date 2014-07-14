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
		<?php
		$list=CHtml::listData(Departement::model()->findAll(), 'id', 'name');;
		?>
		<?php echo $form->labelEx($model,'id_departemen'); ?>
		<?php echo $form->dropDownList($model, 'id_departemen',$list, array('empty' => 'Departement'));
		?>
		<?php echo $form->error($model,'id_departemen'); ?>
	</div>

	<div class="rowrecord">
		<?php echo $form->labelEx($model,'nip'); ?>
		<?php echo $form->textField($model,'nip',array('size'=>30,'maxlength'=>30)); ?>
		<?php echo $form->error($model,'nip'); ?>
	</div>

	<div class="rowrecord">
		<?php echo $form->labelEx($model,'nama_peserta'); ?>
		<?php echo $form->textField($model,'nama_peserta',array('size'=>30,'maxlength'=>30)); ?>
		<?php echo $form->error($model,'nama_peserta'); ?>
	</div>

	<div class="rowrecord buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array('class'=>'button pill')); ?>
	</div>

</div><!-- form -->
<?php $this->endWidget(); ?>
