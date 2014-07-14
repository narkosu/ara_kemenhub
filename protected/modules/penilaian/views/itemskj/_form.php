<?php
/* @var $this ItemskjController */
/* @var $model Itemskj */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'itemskj-form',
	'enableAjaxValidation'=>false,
)); ?>
<?php /*
	<p class="note">Fields with <span class="required">*</span> are required.</p>
*/?>
	<div style="clear:both;padding:10px;text-align:right;border-bottom:1px solid #aaa;" class="record buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>
	<div style="clear:both;float:left;width:30%;border-right:1px solid #aaa;padding:0px 10px;">
		<?php echo $form->errorSummary($model); ?>
		<?php echo $form->hiddenField($model,'skj_id'); ?>
		<?php /*
		<div class="record">
			<?php echo $form->labelEx($model,'skj_id'); ?>
			<?php echo $form->hiddenField($model,'skj_id'); ?>
			<?php echo $form->error($model,'skj_id'); ?>
		</div>
		*/?>
	
		<div class="record">
			<?php
			$list=CHtml::listData(Departement::model()->findAll(), 'id', 'name');;
			?>
			<?php echo $form->labelEx($model,'departement_id'); ?>
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
			$deputilist = (($model->isNewRecord && empty($model->departement_id)) ?  
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
			<?php echo $form->dropDownList($model,'unitkerja_id',$uklist,
								array('empty' => 'Unit Kerja',
									'ajax' => array(
									'type'=>'POST',                          
									'url'=>CController::createUrl('/masters/jabatan/listjabatan'),
									'update'=>'#'.CHtml::activeId($model,'jabatan_id'),
									'data'=>array('unitkerja_id'=>'js:this.value','deputi_id'=>'js:$("#Itemskj_deputi_id").val()'),
									 )												 
								)
							);
			?>
			<?php echo $form->error($model,'unitkerja_id'); ?>
		</div>
	
		<div class="record">
			<?php echo $form->labelEx($model,'jabatan_id'); ?>
			<?php
			$ujlist = (($model->isNewRecord) ?  
							array() : CHtml::listData(Jabatan::model()->findAll('deputi_id=:dputid and unitkerja_id=:ukid', 
							array(':dputid'=>(int) $model->deputi_id,':ukid'=>(int) $model->unitkerja_id)), 'id', 'jabatan_name'));
			?>
			<?php echo $form->dropDownList($model,'jabatan_id',$ujlist);
			?>
			<?php echo $form->error($model,'jabatan_id'); ?>
		</div>
		
		<div class="record">
			<?php echo $form->labelEx($model,'tingkatjabatan_id'); ?>
			<?php
			$tkj = (CHtml::listData(Tingkatjabatan::model()->findAll('departement_id = "'.$model->departement_id.'"'), 'id', 'tingkat_jabatan'));
			?>
			<?php echo $form->dropDownList($model,'tingkatjabatan_id',$tkj,array('empty'=>'Tingkat Jabatan'));
			?>
			<?php echo $form->error($model,'tingkatjabatan_id'); ?>
		</div>
	
		<div class="record">
			<?php echo $form->labelEx($model,'rumpunjabatan_id'); ?>
			<?php
			$rpj = (CHtml::listData(Rumpunjabatan::model()->findAll('departement_id = "'.$model->departement_id.'"'), 'id', 'alias'));
			?>
			<?php echo $form->dropDownList($model,'rumpunjabatan_id',$rpj,array('empty'=>'Rumpun Jabatan'));
			?>
			<?php echo $form->error($model,'rumpunjabatan_id'); ?>
		</div>
		
		<?php /*
		<div class="record">
			<?php echo $form->labelEx($model,'status'); ?>
			<?php echo $form->textField($model,'status',array('size'=>45,'maxlength'=>45)); ?>
			<?php echo $form->error($model,'status'); ?>
		</div>
		*/?>
	</div>
	<div style="float:left;width:50%;padding:0px 10px;">
		<?php if ( !$model->isNewRecord ) { 
			$kompetensi = Kompetensi::model()->findAll('departement_id = "'.$this->module->current_departement_id.'"');
		?>
		<table>
		<?php
			$nowjkom = '';
			foreach ($kompetensi as $ko=>$value_komp) {
				$jkom = $value_komp->jeniskompetensi_id;
				if ( $jkom != $nowjkom ){
					$nowjkom = $jkom;
			?>
				<tr>
					<td class="rotatex" colspan="2" style="background:#aaa;font-weight:bold;width:250px;border-bottom:1px solid #eee;padding:5px 10px;"><?php echo $value_komp->jenkom->name?></td>
					
				</tr>
			<?php	
				}
			?>
				<tr>
				<td class="rotatex" style="width:250px;border-bottom:1px solid #eee;padding:5px 0px;"><?php echo $value_komp->name?></td>
				<td class="rotatex" style="border-bottom:1px solid #eee;padding:5px 0px;">
					<input type="text" name="Kompetensiskj[<?php echo $jkom?>][<?php echo $value_komp->id?>]" value="<?php echo $itemkompetensi[$jkom][$value_komp->id]?>">
				</td>
				</tr>
			<?php
			} ?>
		</table>	
		<?php } ?>
	</div>	
	

<?php $this->endWidget(); ?>

</div><!-- form -->