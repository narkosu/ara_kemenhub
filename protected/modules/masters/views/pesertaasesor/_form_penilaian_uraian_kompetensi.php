<style>
	#tblkompetensi td.nilaikompetensi{
		text-align:center;
		
	}
</style>
<div style="float:left;width:50%;padding:0px 10px;">
		<?php 
			$Jeniskompetensi = Jeniskompetensi::model()->findAll('departement_id = "'.$this->module->current_departement_id.'"');
		?>
		<table id="tbljeniskompetensi" style="font-size:12px;">
			
		<?php
			$nowjkom = '';
			foreach ((array) $Jeniskompetensi as $ko=>$value_komp) {
				
			?>
			<tr style="font-weight:bold;">
				<?php if ( $preview ) { ?>
					<td style="font-weight:bold;">
					<?php echo $value_komp->name?>
					</td>
				<?php } else { ?>
					<td style="font-weight:bold;">
					<?php echo $value_komp->name?>
					</td>
				<?php } ?>
				</tr>
				<tr style="font-weight:bold;">
					<td >
						<?php if ( $preview ) { ?>
							<?php echo $uraian[$value_komp->id]?>
						<?php } else { ?>
							<textarea name="uraian[<?php echo $value_komp->id?>]"><?php echo $uraian[$value_komp->id]?></textarea>
						<?php } ?>
					</td>
				</tr>
			<?php	
				}
			?>
				
		</table>	
		<?php /*<div><span class="button" style="border:1px solid #eee;">Simpan Uraian</span></div> */?>
</div>		