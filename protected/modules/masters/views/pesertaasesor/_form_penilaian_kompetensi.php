
<style>
	#tblkompetensi td.nilaikompetensi{
		text-align:center;
		
	}
	<?php if ($preview ) { ?>
		#tblkompetensi{
		border: 1px solid #aaa;		
		}
		#tblkompetensi td.nilaikompetensi{
			text-align:center;
			border:1px solid #aaa;
		}
		
		#tblkompetensi tr td:first-child{
			padding-left:10px;
		}
		
		#tblkompetensi th{
			text-align:center;
			background: #eee;
			border:1px solid #aaa;
		}
		#tblkompetensi tr.jeniskompetensi td{
			text-align:center;
			border:1px solid #aaa;
			background: #fff;
			
		}
	<?php } ?>
	
</style>
<div style="float:left;width:90%;padding:0px 10px;">
		<?php 
			$kompetensi = Kompetensi::model()->findAll('departement_id = "'.$this->module->current_departement_id.'"');
		?>
		<table id="tblkompetensi" style="width:100%;font-size:12px;">
			<tr>
				<th>KOMPETENSI</th>
				<th colspan="7">TINGKAT KEMAHIRAN</th>
			</tr>
		<?php
			$nowjkom = '';
			
			foreach ( (array) $kompetensi as $ko=>$value_komp) {
				$jkom 			= $value_komp->jeniskompetensi_id;
				unset($nilaiDefault);
				$nilaiDefault 	= $itemkompetensi[$jkom][$value_komp->id];
				unset($style);
				unset($selected);
				$nilaiselected 				= $nilai[$jkom][$value_komp->id]['nilai'];
				$nilaiakhir 				= $nilai[$jkom][$value_komp->id]['nilai_akhir'];
				$total_akhir				+= $nilaiakhir;
				$selected[$nilaiselected] 	= 'checked';
				$style[$nilaiDefault] 		= "background:#e1e1e1;";
				
				if ( $jkom != $nowjkom ){
					$nowjkom = $jkom;
			?>
				<tr style="font-weight:bold;" class="jeniskompetensi" dataid="<?php echo $jkom?>" data-persentase="<?php echo $value_komp->jenkom->nilai_persentase?>">
					<td style="border-top:1px solid #aaa;font-weight:bold;width:250px;border-bottom:1px solid #aaa;"><?php echo $value_komp->jenkom->name?></td>
					<td style="border-top:1px solid #aaa;border-bottom:1px solid #aaa;font-weight:bold;text-align: center;">1</td>
					<td style="border-top:1px solid #aaa;border-bottom:1px solid #aaa;font-weight:bold;text-align: center;">2</td>
					<td style="border-top:1px solid #aaa;border-bottom:1px solid #aaa;font-weight:bold;text-align: center;">3</td>
					<td style="border-top:1px solid #aaa;border-bottom:1px solid #aaa;font-weight:bold;text-align: center;">4</td>
					<td style="border-top:1px solid #aaa;border-bottom:1px solid #aaa;font-weight:bold;text-align: center;">5</td>
					<td style="border-top:1px solid #aaa;border-bottom:1px solid #aaa;font-weight:bold;text-align: center;">6</td>
					<td style="border-top:1px solid #aaa;border-bottom:1px solid #aaa;font-weight:bold;text-align: center;">GAP</td>
				</tr>
			<?php	
				}
			?>
				<?php if (!empty($nilaiDefault) ) { ?>
				<tr id="row_<?php echo $jkom?>_<?php echo $value_komp->id?>" data-id="<?php echo $jkom?>_<?php echo $value_komp->id?>" data-title="<?php echo $value_komp->name?>">
				<td  style="width:250px;border-bottom:1px solid #eee;padding:5px 0px;"><?php echo $value_komp->name?></td>
				<td  class= "nilaikompetensi" style="border-bottom:1px solid #eee;padding:5px 0px;<?php echo $style[1]?>">
					<?php if ($preview ) { ?>
						<?php echo (isset($selected[1]) ? 'X' :'')?>
					<?php } else { ?>
						<input style="width:20px;" class="tulisnilai" type="radio" name="Kompetensiskj[<?php echo $jkom?>][<?php echo $value_komp->id?>][nilai]" value="1" <?php echo $selected[1]?>  >
					<?php } ?>
				</td>
				<td  class= "nilaikompetensi" style="border-bottom:1px solid #eee;padding:5px 0px;<?php echo $style[2]?>">
					<?php if ($preview ) { ?>
						<?php echo (isset($selected[2]) ? 'X' :'')?>
					<?php } else { ?>
					<input style="width:20px;"  class="tulisnilai" type="radio" name="Kompetensiskj[<?php echo $jkom?>][<?php echo $value_komp->id?>][nilai]"  value="2" <?php echo $selected[2]?>  >
					<?php } ?>
				</td>
				<td  class= "nilaikompetensi" style="border-bottom:1px solid #eee;padding:5px 0px;<?php echo $style[3]?>">
				<?php if ($preview ) { ?>
						<?php echo (isset($selected[3]) ? 'X' :'')?>
					<?php } else { ?>
					<input style="width:20px;"  class="tulisnilai" type="radio" name="Kompetensiskj[<?php echo $jkom?>][<?php echo $value_komp->id?>][nilai]"  value="3" <?php echo $selected[3]?>  >
					<?php } ?>
				</td>
				<td  class= "nilaikompetensi" style="border-bottom:1px solid #eee;padding:5px 0px;<?php echo $style[4]?>">
				<?php if ($preview ) { ?>
						<?php echo (isset($selected[4]) ? 'X' :'')?>
					<?php } else { ?>
					<input style="width:20px;"  class="tulisnilai" type="radio" name="Kompetensiskj[<?php echo $jkom?>][<?php echo $value_komp->id?>][nilai]"  value="4" <?php echo $selected[4]?>  >
					<?php } ?>
				</td>
				<td  class= "nilaikompetensi" style="border-bottom:1px solid #eee;padding:5px 0px;<?php echo $style[5]?>">
					<?php if ($preview ) { ?>
						<?php echo (isset($selected[5]) ? 'X' :'')?>
					<?php } else { ?>
						<input style="width:20px;"  class="tulisnilai" type="radio" name="Kompetensiskj[<?php echo $jkom?>][<?php echo $value_komp->id?>][nilai]"  value="5" <?php echo $selected[5]?>  >
						<?php } ?>
				</td>
				<td  class= "nilaikompetensi" style="border-bottom:1px solid #eee;padding:5px 0px;<?php echo $style[6]?>">
					<?php if ($preview ) { ?>
						<?php echo (isset($selected[6]) ? 'X' :'')?>
					<?php } else { ?>
					<input style="width:20px;"  class="tulisnilai" type="radio" name="Kompetensiskj[<?php echo $jkom?>][<?php echo $value_komp->id?>][nilai]"  value="6" <?php echo $selected[6]?>  >
					<?php } ?>
				</td>
				<td class= "nilaikompetensi" style="border-bottom:1px solid #eee;padding:5px 0px;">
				<?php if ($preview ) { ?>
				<?php echo $nilaiakhir?>
				<?php }else{ ?>
					<input style="width:20px;" class="nilaifinal" groupdata="jeniskompetensi_<?php echo $jkom?>" datajkomp = "<?php echo $jkom?>" datakomp = "<?php echo $value_komp->id?>" datadefault="<?php echo $nilaiDefault?>" datanilai = "<?php echo empty($nilaiselected) ? 0 : $nilaiselected ?>" id="total_<?php echo $jkom?>_<?php echo $value_komp->id?>" type="text" name="Kompetensiskj[<?php echo $jkom?>][<?php echo $value_komp->id?>][total]" value="<?php echo $nilaiakhir?>" readonly>	
				<?php } ?>
					<input style="width:20px;"  id="default_<?php echo $jkom?>_<?php echo $value_komp->id?>" type="hidden" name="Kompetensiskj[<?php echo $jkom?>][<?php echo $value_komp->id?>][default]" value="<?php echo $nilaiDefault?>">
				</td>

				</tr>
			<?php
				}
			} ?>
			<tr class="row_gap">
				<Td colspan="7">
					Gap Kompetensi
				</Td>
				<td style="text-align:center;">
				<?php if ($preview ) { ?>
					<?php echo $total_akhir?>
				<?php }else{ ?>
					<input style="width:20px;" id="total_final" type="text" name="Kompetensiskj_final" value="<?php echo $total_akhir?>" readonly>
					<?php } ?>
				</td>
			</tr>
			<tr class="row_persentase">
				<Td colspan="7">
					% PEMENUHAN KOMPETENSI
				</Td>
				<td style="text-align:center;">
				<?php if ($preview ) { ?>
					<?php echo $model->persentase_pemenuhan?>%
				<?php }else{ ?>
					<input style="width:20px;" id="persentase_kompetensi" type="text" name="persentase_kompetensi" value="<?php echo $model->persentase_pemenuhan?>" readonly>
					<?php } ?>
				</td>
			</tr>
		</table>	
</div>		