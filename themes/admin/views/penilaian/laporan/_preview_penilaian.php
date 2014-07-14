<?php
/* @var $this PesertaasesorController */
/* @var $model Pesertaasesor */
/* @var $form CActiveForm */
$depid = $departement_id;
?>

<?php $this->renderPartial('_submenu_penilaian',array('model'=>$model)); ?>
<div id="subcontainer">
	
	<div class="form" >
	<h1 style="text-align: center;">LAPORAN INDIVIDUAL
	ASSESSMENT KOMPETENSI
	</h1>
	<?php $form=$this->beginWidget('CActiveForm', array(
		'id'=>'pesertaasesor-form',
		'enableAjaxValidation'=>false,
	)); ?>
	
		<?php /*<p class="note">Fields with <span class="required">*</span> are required.</p>*/?>
	
		<?php echo $form->errorSummary($model); ?>
		<input type="hidden" name="peserta_id" value="<?php echo $peserta->id?>">
		<input type="hidden" name="penilaian_id" value="<?php echo $model->id?>">
		<div style="width:1000px;margin:0 auto;">
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
				
			</table>
		<h3 style="text-align: center;">HASIL ASSESSMENT KOMPETENSI</h3>
		<div id="headerloadKompetensi" style="font-weight:bold;">I. PROFIL KOMPETENSI</div>
		<div id="loadKompetensi">
			<?php 
				echo $output['loadkompetensi'];
			 ?>
		</div>
		<div style="clear:both;"></div>
		<div id="headeruraianKompetensi" style="font-weight:bold;">II. URAIAN PROFIL KOMPETENSI</div>
		<div id="uraianKompetensi">
			
			<?php
				echo $output['uraianKompetensi'];
			?>
			
		</div>
		<div style="clear:both;"></div>
		<div id="headerringkasanKompetensi" style="font-weight:bold;">III. RINGKASAN PROFIL KOMPETENSI</div>
		<div id="ringkasanprofile">
		<table>
			<Tr>
				<th>Area Kekuatan</th>
				<th>Area Kelemahan</th>
			</Tr>
			<Tr>
				<td id="strongarea" style="vertical-align: top;"><ul><?php echo $output['ringkasan']['strong']?></ul></td>
				<td id="weaknessarea"  style="vertical-align: top;"><ul><?php echo  $output['ringkasan']['weak']?></ul></td>
			</Tr>
		</table>	
		</div>
		<div style="clear:both;"></div>
		<div id="headerkesimpulan" style="font-weight:bold;">IV. KESIMPULAN UMUM</div>
		<div>
			<?php echo nl2br($model->kesimpulan_umum);?>
		</div>
		<div style="clear:both;margin-top:10px;"></div>
		<div id="headerkesimpulan" style="font-weight:bold;">V. REKOMENDASI</div>
    <?php
    $rekomendasi = Assessment::model()->rekomendasi($depid,$model->persentase_pemenuhan);
    $model->matrix = Assessment::model()->matrix($depid,$rekomendasi['result']['id'],$model->data_kinerja);
    //print_r($rekomendasi);

    $result[$rekomendasi['result']['id']] =  'background:#3D5D8A';
    /*if ( $model->persentase_pemenuhan > 90 ) {
      $saran = 'background:#3D5D8A';
    } else if ( $model->persentase_pemenuhan <= 90  && $model->persentase_pemenuhan > 70  ) {
      $timbang = 'background:#3D5D8A';
    } else if ( $model->persentase_pemenuhan <= 70 && !empty($model->persentase_pemenuhan) ) {
      $belum = 'background:#3D5D8A';
    }else{

    }*/
    ?>
		
		<div style="padding:10px 10px 20px 150px;font-size:12px;">
      <div style="padding:10px;">
        <div style="width:20px;height:20px;float:left;border:1px solid #aaa;margin-right:10px;<?php echo $result['P']?>"></div>
        <div style="float:left;width:700px;">
          <?php /*<b>"<?php echo $rekomendasi['data']['P']['caption'] ?>"</b> untuk menduduki <?php echo $output['jabatan']->jabatan_name?>. Sebagian besar kompetensi yang dipersyaratkan telah dipenuhi.*/?>
          "Fit in" dalam posisi saat ini. Sebagian besar kompetensi yang dipersyaratkan telah dipenuhi. POTENSIAL untuk dikembangkan ke posisi yang lebih tinggi.
        </div>
        <div style="clear:both;"></div>
      </div>
      <div style="padding:10px;">
        <div style="width:20px;height:20px;float:left;border:1px solid #aaa;margin-right:10px;<?php echo $result['PC']?>"></div>
        <div style="float:left;width:700px;">
          <?php /*<b>"<?php echo $rekomendasi['data']['PC']['caption'] ?>"</b> untuk menduduki Posisi <?php echo $output['jabatan']->jabatan_name?>, dengan catatan masih memerlukan peningkatan pada beberapa kompetensi yang dipersyaratkan.*/?>
          Masih memerlukan peningkatan pada beberapa kompetensi yang dipersyaratkan pada posisi saat ini. POTENSIAL dengan CATATAN untuk dikembangkan ke posisi yang lebih tinggi.
        </div>
        <div style="clear:both;"></div>
      </div>
      <div style="padding:10px;">
        <div style="width:20px;height:20px;float:left;border:1px solid #aaa;margin-right:10px;<?php echo $result['KP']?>"></div>
        <div style="float:left;width:700px;">
          <?php /*<b>"<?php echo $rekomendasi['data']['KP']['caption'] ?>"</b> untuk menduduki Posisi <?php echo $output['jabatan']->jabatan_name?>. Sejumlah besar kompetensi yang dipersyaratkan belum dipenuhi.*/?>
          Memerlukan pembinaan untuk dapat optimal berkontribusi pada posisi saat ini. Saat ini, KURANG POTENSIAL untuk dikembangkan ke posisi yang lebih tinggi
        </div>
        <div style="clear:both;"></div>
      </div>

    </div>
		<div style="clear:both;"></div>
		<div id="headersaranpengembangan"  style="font-weight:bold;">VI. SARAN PENGEMBANGAN</div>
		<div style="clear:both;"></div>
		<div id="saranpengembangan">
		<?php 
			echo $output['saranpengembangan'];
		?>
		</div>
		<div style="clear:both;"></div>
		
	</div>
	<?php $this->endWidget(); ?>
	
	</div><!-- form -->
</div>