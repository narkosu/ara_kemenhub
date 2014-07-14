		<?php 
			$Jeniskompetensi = Jeniskompetensi::model()->findAll('departement_id = "'.$this->module->current_departement_id.'"');
		?>
		<?php
			$nowjkom = '';
			foreach ((array)$Jeniskompetensi as $ko=>$value_komp) {
				
			?>
        <h2 style="font-family: 'arial narrow';font-size:11pt;font-weight:bold;color:blue;"><?php echo strtoupper($value_komp->name)?></h2>
        <div style="text-align:justify;font-family: 'arial narrow';line-height: 150%;font-size:11pt;"><?php echo nl2br($uraian[$value_komp->id])?></div>
			<?php	
				}
			?>
				
		
		<?php /*<div><span class="button" style="border:1px solid #eee;">Simpan Uraian</span></div> */?>
	