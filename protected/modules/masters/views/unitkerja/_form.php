<?php
/* @var $this UnitkerjaController */
/* @var $model Unitkerja */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'unitkerja-form',
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
		<?php echo $form->labelEx($model,'deputi_id'); ?>
		<?php
		$deputilist = (($model->isNewRecord) ?  
						array() : CHtml::listData(Deputi::model()->findAll('departement_id=:dptid', 
						array(':dptid'=>(int) $model->departement_id)), 'id', 'deputi_name'));
		?>
		<?php echo $form->dropDownList($model,'deputi_id',$deputilist);
		?>
		<?php echo $form->error($model,'deputi_id'); ?>
	</div>

	<div class="record">
		<?php echo $form->labelEx($model,'unitkerja_name'); ?>
		<?php echo $form->textField($model,'unitkerja_name',array('size'=>60,'maxlength'=>145)); ?>
		<?php echo $form->error($model,'unitkerja_name'); ?>
	</div>

	<div class="record buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->