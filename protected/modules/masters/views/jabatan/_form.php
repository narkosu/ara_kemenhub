<?php
/* @var $this JabatanController */
/* @var $model Jabatan */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'jabatan-form',
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
		<?php echo $form->dropDownList($model,'deputi_id',$deputilist,
					array('empty' => 'Deputi',
								'ajax' => array(
                                'type'=>'POST',                          
                                'url'=>CController::createUrl('/masters/unitkerja/listunitkerja'),
                                'update'=>'#'.CHtml::activeId($model,'unitkerja_id'),
								'data'=>array('deputi_id'=>'js:this.value'),
                                 )												 
							)				   
					);
		?>
		<?php echo $form->error($model,'deputi_id'); ?>
	</div>

	<div class="record">
		<?php echo $form->labelEx($model,'unitkerja_id'); ?>
		<?php
		$uklist = (($model->isNewRecord) ?  
						array() : CHtml::listData(Unitkerja::model()->findAll('deputi_id=:dputid', 
						array(':dputid'=>(int) $model->deputi_id)), 'id', 'unitkerja_name'));
		?>
		<?php echo $form->dropDownList($model,'unitkerja_id',$uklist);
		?>
		<?php echo $form->error($model,'unitkerja_id'); ?>
	</div>

	<div class="record">
		<?php echo $form->labelEx($model,'jabatan_name'); ?>
		<?php echo $form->textField($model,'jabatan_name',array('size'=>60,'maxlength'=>145)); ?>
		<?php echo $form->error($model,'jabatan_name'); ?>
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