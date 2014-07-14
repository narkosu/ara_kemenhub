<?php
/* @var $this PesertaasesorController */
/* @var $model Pesertaasesor */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'pesertaasesor-form',
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary($model); ?>

	<div class="recordrow">
   <?php echo $form->labelEx($model,'id_departemen'); ?> 
    <?php echo $model->dept->name; ?>
		<?php /* echo $form->labelEx($model,'id_departemen'); ?>
		<?php echo $form->textField($model,'id_departemen'); ?>
		<?php echo $form->error($model,'id_departemen'); 
     * 
     * 
     */?>
	</div>

	<div class="recordrow">
		<?php echo $form->labelEx($model,'id_peserta'); ?>
		<?php echo $model->peserta->nama_peserta; ?>
		
	</div>

	<div class="recordrow">
    <?php echo $form->labelEx($model,'id_asesor'); ?>
    <?php
					$list=CHtml::listData(Masterasesor::model()->findAll(), 'id', 'nama_asesor');
					?>
					<?php echo $form->dropDownList($model,'id_asesor',$list, array('empty' => 'Asesor',
							/*'ajax' => array(
							'type'=>'POST',                          
							'url'=>CController::createUrl('/masters/pesertaasesor/loadkompetensi'),
							'dataType'=>'json',
							'success'=>'js:function(res){
								if ( res.itemskj != "" ) {
									jQuery("#Penilaian_itemskj_id").html(res.itemskj);
								}
								
								jQuery("#loadKompetensi").html(res.loadkompetensi);
								jQuery("#uraianKompetensi").html(res.uraianKompetensi);
							}',
							//'update'=>'#loadKompetensi',
							//'data'=>array('skj_id'=>'js:this.value'),
							 )	*/											 
						));
					?>
    
    <?php /*
		<?php echo $form->labelEx($model,'id_asesor'); ?>
		<?php echo $form->textField($model,'id_asesor'); ?>
		<?php echo $form->error($model,'id_asesor'); ?>
     * 
     */
    ?>
	</div>

	<div class="recordrow buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array('class'=>'button')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->