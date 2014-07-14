<?php
/* @var $this TingkatjabatanController */
/* @var $model Tingkatjabatan */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'tingkatjabatan-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="record">
		<?php echo $form->labelEx($model,'departement_id'); ?>
		<?php
		$list=CHtml::listData(Departement::model()->findAll(), 'id', 'name');;
		?>
		<?php echo $form->dropDownList($model, 'departement_id',$list, array('empty' => 'Departement',
								'ajax' => array(
                                'type'=>'POST',                          
                                'url'=>CController::createUrl('/masters/deputi/listdeputies'),
                                'update'=>'#'.CHtml::activeId($model,'deputi_id'),
								'data'=>array('departement_id'=>'js:this.value'),
                                 )												 
							));
		?>
		<?php echo $form->error($model,'departement_id'); ?>
	</div>

	<div class="record">
		<?php echo $form->labelEx($model,'tingkat_jabatan'); ?>
		<?php echo $form->textField($model,'tingkat_jabatan',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'tingkat_jabatan'); ?>
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