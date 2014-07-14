<?php
/* @var $this KompetensiController */
/* @var $model Kompetensi */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'kompetensi-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="record">
		<?php
		$list=CHtml::listData(Departement::model()->findAll(), 'id', 'name');;
		?>
		<?php echo $form->labelEx($model,'departement_id'); ?>
		<?php echo $form->dropDownList($model, 'departement_id',$list, array('empty' => 'Departement',
							'ajax'=>array(
                                'type'=>'POST',                          
                                'url'=>CController::createUrl('/masters/jeniskompetensi/listjeniskompetensi'),
                                'update'=>'#'.CHtml::activeId($model,'jeniskompetensi_id'),
								'data'=>array('departement_id'=>'js:this.value'),
                                 )));
		?>
		<?php echo $form->error($model,'departement_id'); ?>
	</div>

	<div class="record">
		
		<?php echo $form->labelEx($model,'jeniskompetensi_id'); ?>
		<?php
		$listjk = (($model->isNewRecord) ?  
						array() : CHtml::listData(Jeniskompetensi::model()->findAll('departement_id=:dptid', 
						array(':dptid'=>(int) $model->departement_id)), 'id', 'jeniskompetensi_name'));
		?>
		<?php echo $form->dropDownList($model, 'jeniskompetensi_id',$listjk);?>
		<?php echo $form->error($model,'jeniskompetensi_id'); ?>
	</div>

	<div class="record">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>145)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="record">
		<?php echo $form->labelEx($model,'alias'); ?>
		<?php echo $form->textField($model,'alias',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'alias'); ?>
	</div>

	<div class="record">
		<?php echo $form->labelEx($model,'nilai'); ?>
		<?php echo $form->textField($model,'nilai'); ?>
		<?php echo $form->error($model,'nilai'); ?>
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