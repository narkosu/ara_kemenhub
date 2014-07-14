		<?php 
			$Jeniskompetensi = Jeniskompetensi::model()->findAll('departement_id = "'.$this->module->current_departement_id.'"');
		?>
		<?php
			$nowjkom = '';
			foreach ($Jeniskompetensi as $ko=>$value_komp) {
				
			?>
			<h2><?php echo $value_komp->name?></h2>
			
			<?php echo nl2br($uraian[$value_komp->id])?>
			
			<?php	
				}
			?>
				
		
		<?php /*<div><span class="button" style="border:1px solid #eee;">Simpan Uraian</span></div> */?>
	