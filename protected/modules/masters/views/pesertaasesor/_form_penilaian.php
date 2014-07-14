<?php
/* @var $this PesertaasesorController */
/* @var $model Pesertaasesor */
/* @var $form CActiveForm */
?>
<style>
	.header_sub_title{
		padding:10px 0px; border-bottom:1px solid #eee;
	}
</style>
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'pesertaasesor-form',
	'enableAjaxValidation'=>false,
)); ?>

	<?php /*<p class="note">Fields with <span class="required">*</span> are required.</p>*/?>

	<?php echo $form->errorSummary($model); ?>
	<input type="hidden" name="peserta_id" value="<?php echo $peserta->id?>">
	<input type="hidden" name="penilaian_id" value="<?php echo $model->id?>">
	<div>
		<table>
			<Tr>
				<td width="100"><?php echo CHtml::label("Nomor Test",''); ?></td>
				<td width="10">:</td>
				<td><?php echo $peserta->nip; ?></td>
			</Tr>
			<Tr>
				<td width="100"><?php echo CHtml::label("Nama",''); ?></td>
				<td width="10">:</td>
				<td><?php echo $peserta->nama_peserta; ?></td>
			</Tr>
			<Tr>
				<td width="100"><?php echo CHtml::label("SKJ",''); ?></td>
				<td width="10">:</td>
				<td>
					<?php
					$list=CHtml::listData(Masterskj::model()->findAll('departement_id = :dept',array(':dept'=>$this->module->current_departement_id)), 'id', 'skj_name');
					?>
					<?php echo $form->dropDownList($model,'skj_id',$list, array('empty' => 'SKJ',
							'ajax' => array(
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
							 )												 
						));
					?>
				</td>
			</Tr>
			<Tr>
				<td width="100"><?php echo CHtml::label("ITEM SKJ",''); ?></td>
				<td width="10">:</td>
				<td>
					<?php
					/*$listItem= Itemskj::model()->findAll('departement_id = :dept AND skj_id = :skjid',
							array(':dept'=>$this->module->current_departement_id,
								  ':skjid'=>$model->skj_id
								  ));*/
					?>
					<?php
					$listItems=CHtml::encodeArray(CHtml::listData(Itemskj::model()->findAll('departement_id = :dept AND skj_id = :skjid',
							array(':dept'=>$this->module->current_departement_id,
								  ':skjid'=>$model->skj_id
								  )), 'id', 'fullField'));
					?>
					<div>
						<?php echo $form->dropDownList($model,'itemskj_id',$listItems, array('empty' => 'ITEM SKJ',
									'ajax' => array(
									'type'=>'POST',                          
									'url'=>CController::createUrl('/masters/pesertaasesor/loadkompetensi'),
									'dataType'=>'json',
									'success'=>'js:function(res){
										jQuery("#loadKompetensi").html(res.loadkompetensi);
										jQuery("#uraianKompetensi").html(res.uraianKompetensi);
									}',
									//'update'=>'#loadKompetensi',
									//'data'=>array('itemskj_id'=>'js:this.value','skj_id'=>'js:jQuery("#Penilaian_skj_id").value()'),
									 )												 
								));
						?>
					</div>
				</td>
			</Tr>
		</table>
	</div>
	<div id="headertestpotensi" class="header_sub_title">TEST POTENSI</div>
	<div id="areatestpotensi">
		<table>
			<tr>
				<td style="width:100px;border-bottom:1px solid #000;font-weight:bold;">Test</td>
				<td style="width:100px;border-bottom:1px solid #000;font-weight:bold;" >Nilai</td>
				<td style="border-bottom:1px solid #000;font-weight:bold;">Form</td>
			</tr>
			<tr>
				<td>CFIT</td>
				<td><?php echo $form->textField($model,'CFIT',array('size'=>45,'maxlength'=>45)); ?></td>
				<td>Form</td>
			</tr>
			<tr>
				<td>GATB</td>
				<td><?php echo $form->textField($model,'GATB',array('size'=>45,'maxlength'=>45)); ?></td>
				<td>Form</td>
			</tr>
			<tr>
				<td>PAULI</td>
				<td><?php echo $form->textField($model,'PAULI',array('size'=>45,'maxlength'=>45)); ?></td>
				<td>Form</td>
			</tr>
		</table>
		
	</div>
	<div id="headerloadKompetensi" class="header_sub_title">PROFIL KOMPETENSI</div>
	<div id="loadKompetensi">
		<?php if ( !$model->isNewRecord ) {
			echo $output['loadkompetensi'];
		} ?>
	</div>
	<div style="clear:both;"></div>
	<div id="headeruraianKompetensi" class="header_sub_title">URAIAN PROFIL KOMPETENSI</div>
	<div id="uraianKompetensi">
		
		<?php if ( !$model->isNewRecord ) {
			echo $output['uraianKompetensi'];
		} ?>
		
	</div>
	<div style="clear:both;"></div>
	<div id="headerringkasanKompetensi" class="header_sub_title">RINGKASAN PROFIL KOMPETENSI</div>
	<div id="ringkasanprofile">
	<?php if ( !$model->isNewRecord ) {
			echo $output['ringkasanKompetensi'];
	} ?>
	</div>
	<div style="clear:both;"></div>
	<div id="headerkesimpulan" class="header_sub_title">KESIMPULAN UMUM</div>
	<div>
		<?php echo $form->textArea($model,'kesimpulan_umum')?>
	</div>
	<div style="clear:both;"></div>
	<div id="headerkesimpulan" class="header_sub_title">REKOMENDASI</div>
	<div style="clear:both;"></div>
	<?php
	
	if ( $model->persentase_pemenuhan > 90 ) {
		$saran = 'background:#3D5D8A';
	} else if ( $model->persentase_pemenuhan <= 90  && $model->persentase_pemenuhan > 70  ) {
		$timbang = 'background:#3D5D8A';
	} else if ( $model->persentase_pemenuhan <= 70 && !empty($model->persentase_pemenuhan) ) {
		$belum = 'background:#3D5D8A';
	}else{
	
	}?>
	<div style="padding:10px 10px 20px 150px;font-size:12px;">
		<div style="padding:10px;">
			<div style="width:20px;height:20px;float:left;border:1px solid #aaa;margin-right:10px;<?php echo $saran?>"></div>
			<div style="float:left;width:700px;">
				<b>"DAPAT DISARANKAN"</b> untuk menduduki <?php echo $output['jabatan']->jabatan_name?>. Sebagian besar kompetensi yang dipersyaratkan telah dipenuhi.
			</div>
			<div style="clear:both;"></div>
		</div>
		<div style="padding:10px;">
			<div style="width:20px;height:20px;float:left;border:1px solid #aaa;margin-right:10px;<?php echo $timbang?>"></div>
			<div style="float:left;width:700px;">
				<b>"DAPAT DIPERTIMBANGKAN"</b> untuk menduduki Posisi <?php echo $output['jabatan']->jabatan_name?>, dengan catatan masih memerlukan peningkatan pada beberapa kompetensi yang dipersyaratkan.
			</div>
			<div style="clear:both;"></div>
		</div>
		<div style="padding:10px;">
			<div style="width:20px;height:20px;float:left;border:1px solid #aaa;margin-right:10px;<?php echo $belum?>"></div>
			<div style="float:left;width:700px;"><b>"BELUM DISARANKAN"</b> untuk menduduki Posisi <?php echo $output['jabatan']->jabatan_name?>. Sejumlah besar kompetensi yang dipersyaratkan belum dipenuhi.
			</div>
			<div style="clear:both;"></div>
		</div>
		
	</div>
	<div style="clear:both;"></div>
	<div id="headersaranpengembangan">SARAN PENGEMBANGAN</div>
	<div style="clear:both;"></div>
	<div id="saranpengembangan">
	<?php if ( !$model->isNewRecord ) {
		echo $output['saranpengembangan'];
	} ?>
	</div>
	<div style="clear:both;"></div>
	<div class="record buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
<?php 
Yii::app()->clientScript->registerScript('formnilai_s', "
$(document).delegate('.tulisnilai','click',function(){
	var thisparent = $(this).parents('tr');
	var id_komp = thisparent.attr('data-id') ;
	var nilai = $(this).val();
	var defaultNilai = $('#default_'+id_komp).val();
	var datapersentase = thisparent.attr('data-persentase')/100;
	var total;
	var persentase_item;
	if ( nilai <= defaultNilai ){
		total =  nilai - defaultNilai;
	}
	if ( nilai > defaultNilai ){
		total =  nilai - defaultNilai;
	}
	
	persentase_item = (datapersentase * (nilai/defaultNilai));
	
	$('#total_'+id_komp).val(total); // gap
	$('#total_'+id_komp).attr('persentase-item',persentase_item); // persentase
	$('#total_'+id_komp).attr('datanilai',nilai); // persentase
	
	var sum = 0;
	
	$('#strongarea ul').html('');
	$('#weaknessarea ul').html('');
	
	var hasil_assessment = 0;
	var hasil_gap = 0;
	$('.jeniskompetensi').each(function() {
		var rowid = $(this).attr('dataid');
		var persentase = $(this).attr('data-persentase')/100;
		var sumdfault = 0;
		var sumnilai = 0;
		$('input[groupdata=\"jeniskompetensi_'+rowid+'\"]').each(function() {
			var nildfult = parseInt($(this).attr('datadefault'));
			var nil = parseInt($(this).attr('datanilai'));
			var nilai_gap = (nil - nildfult);
			sumdfault = sumdfault+nildfult;
			sumnilai = sumnilai + nil;
			
			hasil_gap += nilai_gap;
			console.log('jkon + '+rowid + ' =  nilai gap : '+nilai_gap + ' = ' + hasil_gap);
		});
		var hasilgroup = persentase*(sumnilai/sumdfault);
		console.log(' -- def + '+rowid + ' = '+sumnilai + '/ ' + sumdfault + ' = '+ hasilgroup );
		hasil_assessment = hasil_assessment + hasilgroup;
		
    });
	
	console.log('Hasil assessment  =  '+ hasil_assessment + ' : '+(hasil_assessment * 100));
	hasil_assessment = Math.round(hasil_assessment * 100);
	$('#persentase_kompetensi').val(hasil_assessment);
	$('#total_final').val(hasil_gap);	
	
});

",CClientScript::POS_READY);
?>